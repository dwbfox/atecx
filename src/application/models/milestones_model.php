<?php



class Milestones_model extends CI_Model {



	public function addNewMilestone($milestoneData)
	{
	    $date = date( 'Y-m-d H:i:s');
		$data = array('date' => $date,
					  'comment' => $milestoneData['comment'],
					  'attachment' => $milestoneData['attachment'],
					  'user_id' => $milestoneData['user_id'],
					  'project_id' => $milestoneData['project_id']
  		);

		$result = $this->db->insert('milestones',$data);

		return $result;

	}

	public function getLatestMilestone($project_id)
	{

	}

	public function getTimelineByProjectID($project_id)
	{
		$columns = '
			date,
			comment,
			attachment,
			users.user_id,
			bio,
			screen_name,
			avatar,
			type
		';

		$this->db->select($columns);
		$this->db->from('milestones');
		$this->db->where('project_id',$project_id);
		$this->db->join('users','milestones.user_id=users.user_id');
		$query = $this->db->get();

		if ($query->num_rows() <= 0) {
			return false;
		}

		return $query->result();	
	}


}


?>