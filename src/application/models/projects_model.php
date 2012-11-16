<?php




class Projects_model extends CI_Model {



	private $project_thumbnail = 'screen_name,user_id,project_id,project_name,project_image,project_image_thumb,project_tagline,project_description,
			project_start,project_end';


	/**
	* Creates a new project and automatically calls addMemeberToProject() to add the 
	* user into the project as a memeber/owner.
	* @param [Array] $project_info - An array containing the project information to be stored
	* @return [Bool] True on success, false on failure
	*/
	public function createNewProject($project_info) 
	{
			
		if (!is_array($project_info)) return false;

		// Create the project
	    $project_start = date('Y-m-d');
	    $project_info['project_start'] = $project_start;
	   	$result = $this->db->insert('projects', $project_info);

	   	if (!$result) return $result;

	   	// Add the user who created the project as a memeber
	   	$project_id = $this->db->insert_id();
	   	$role_id = 1; // The user who created it gets a role of 1, or administrator

	   	$this->addMemberToProject($project_info['owner_id'],$project_id,$role_id);

	   	// Set the first status update for the project
	   	$this->load->model('Milestones_model');
	   	$this->Milestones_model->addNewMilestone(array(
			  'comment' => 'Project begun.',
			  'attachment' => '',
			  'user_id' => $project_info['owner_id'],
			  'project_id' => $project_id
	   		));


	   	return $result;

	}

	/**
	* Returns an associative array of all the users in a project
	* @param [String] $project_id The project_id of the project
	* @return [Array] An array of all the members of the project
	*/
	public function getProjectMemeberAssoc($project_id) 
	{


	}

	public function getRecentProjects($amount)
	{
		$recent_projects = array();

		$this->db->select('*');
		$this->db->from('projects');
		$this->db->order_by('project_start','desc');
		$this->db->join('users','users.user_id=projects.owner_id');
		$this->db->limit($amount);
		$query = $this->db->get();

		if ($query->num_rows() <= 0 ) {
			return false;
		}

		return $query->result();
	}

	public function isProjectMemberAdmin()
	{


	}


	public function getProjectInfoByID($project_id)
	{
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->where('project_id',$project_id);
		$query = $this->db->get();

		if ($query->num_rows() <= 0) {
			return false;
		}
		return $query->row();
	}

	public function getInterestingProjects($screen_name)
	{
		$user_id = $this->user_model->getUserIDByScreename($screen_name);
		$this->db->select($this->project_thumbnail);
		$this->db->from('projects');
		$this->db->where('owner_id',$user_id);
		$this->db->join('users','users.user_id=projects.owner_id','left');
		$query = $this->db->get();

		if ($query->num_rows() <= 0) {
			return false;
		}

		return ($query->result());
	}

	public function getProjectInfoByScreename($screen_name) 
	{
		$user_id = $this->user_model->getUserIDByScreename($screen_name);
		$this->db->select('*');
		$this->db->from('project_members');
		$this->db->where('project_members.user_id',$user_id);
		$this->db->join('users','users.user_id=project_members.user_id'); // Join with the user table
		$this->db->join('projects','projects.project_id=project_members.project_id'); // Join with the projects table
		$query = $this->db->get();

		if ($query->num_rows() <= 0) {
			return false;
		}

		$projects = $query->result();

		// We need to go through and attach the actual username of the person who owns the project
		// so it we don't get confused by the username of the member and the username of the owner
		foreach ($projects as $project) {
			$project->owner_screename = $this->user_model->getScreenameByUserID($project->owner_id);
		}

		return $projects;
	}

	/**
	* Adds a user to a project as a memeber
	* @param [String] $user_id  valid user id 
	* @param [String] $project_id id corresponding to a project in the projects table
	* @param [String] $role_id an id representing the role of the user within the projects
	* @return [String] Returns the project member id of the user on success, false on failure
	*/
 	public function addMemberToProject($user_id,$project_id,$role_id)
	{
	    $join_date = date('Y-m-d');
		$data = array('role_id' => $role_id,
					  'project_id'=> $project_id,
					  'join_date' => $join_date,
				   	  'user_id' => $user_id
		);

		$result = $this->db->insert('project_members',$data);

		return $result;
	}

	/**
	* Gets the number of members in a project.
	* @param [String] $project_id An array containing the project information to be stored
	* @return [int] The number of members in a project
	*/
	public function getMemberCountForProject($project_id)
	{

		$this->db->select('COUNT(member_id) as count');
		$this->db->from('project_members');
		$this->db->where('project_id',$project_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result->count;
	}



	/**
	* Gets the number of projects the user has started.
	* @param [String] $screen_name A valid screen name
	* @return [int] The number of projects the user has started
	*/
	public function getProjectCountForUser($screen_name) 
	{
		$user_id = $this->user_model->getUserIDByScreename($screen_name);

		$this->db->select('COUNT(*) as count');
		$this->db->from('project_members');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result->count;
	}



	public function deleteUserFromProject($screen_name,$project_id)
	{
		$user_id = $this->user_model->getUserIDByScreename($screen_name);

        $tables = array('project_members');
        $this->db->where('user_id',$user_id);
        $this->db->where('project_id',$project_id);
        $result =  $this->db->delete($tables);

	}

	/**
	* Checks to see if the specified user is a memeber of specified project
	* @param [String] $screen_name A valid screen name
	* @param [String] $project_id a valid project id of a project
	* @return [Bool] True on success, false on failure
	*/
	public function isUserMember($screen_name,$project_id)
	{
		$user_id = $this->user_model->getUserIDByScreename($screen_name);
		$query = $this->db->get_where('project_members',array('user_id' => $user_id,'project_id' => $project_id));

		if ($query->num_rows() > 0) {
		 return true;
		}
		return false;
	}



}