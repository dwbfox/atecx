<?php



class User_model extends CI_Model
{
    /**
     * Inserts a new member into the database
     * @param [String] $member_info - An array containing the required member information, may be unescaped
     * @return [Bool] True on success, false on failure
     */
    public function addNewMember($member_info)
    {
        if (!is_array($member_info))
            return false;
        $date = date('Y-m-d');
        
        // This will be inserted into the users table
        $user_profile = array(
            "oauth_user_id" => $member_info['oauth_user_id'],
            "screen_name" => $member_info['screen_name'],
            "email" => $member_info['email'],
            "interests" => $member_info['interests'],
            "join_date" => $date,
            "bio" => $member_info['bio']
        );
        
        $result = $this->db->insert('users', $user_profile);
        
		
		// Something went wrong
        if (!$result && $this->db->affected_rows() <= 0) {
            return false;
		}
		
		
        // Get the user ID so we can insert it into the proficiencies table
        $user_id = $this->db->insert_id();
        
        // This will be inserted into the proficiencies table
        if (!isset($member_info['proficiencies'])) {
        	return $user_id;
		}
        	
        foreach ($member_info['proficiencies'] as $prof_id => $prof_value) {
            // Iterate through each proficiency the user has set and insert it into the database
            
            // My god... this is why I love CI
            // Active Record sanitizes SQL entries
            // It also is enabled for XSS protection, although we might need to set up
            // custom checks later on in the production version of this script
            $this->db->set('user_id', $user_id);
            $this->db->set('prof_id', $prof_id);
            $this->db->set('prof_value', $prof_value);
            $result = $this->db->insert('proficiencies');
            if (!$result) {
            	return false;
            }
        } //foreach
        return $user_id;          
    }



    /**
    * Deletes the user and all of their data. 
    * Note that it does not delete any of their uploaded data
    * @param $user_id the user_id of the user to remove from the site
    */
    public function deleteMember($user_id) 
    {
        $tables = array('users','proficiencies','project_members');
        $this->db->where('user_id',$user_id);
        return $this->db->delete($tables);
    }
    
	
	/**
	 * Gets an associative array with the user's proficiency values
	 * mapped to the skill e.g. "Adobe Photoshop" => 20
     * @param [string] $screen_name The screen name of the user
	 * @return [Array] An assocative array containg all of the user's proficiencies
	 */
    public function getUserProficiencies($screen_name)
	{
        $user_id = $this->getUserIDByScreename($screen_name);

        $this->db->select('*');
        $this->db->from('proficiencies');
        $this->db->join('prof_roles','proficiencies.prof_id=prof_roles.prof_id');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();

        if ($query->num_rows() <= 0) return false;
        return $query->result();
    }


	
	
    /**
     * Gets an assocative array with the user's table data.
     * This is used to set the necessary session data when logging users in
     * @param [string] $screen_name The screen name of the user
     * @return Array of user's information on success, false on failure
     */
    public function getUserInfoAssoc($screen_name)
    {
        $userInfo = array();
        $query    = $this->db->get_where('users', array(
            'screen_name' => $screen_name
        ));
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $user) {
                $userInfo['screen_name'] = $user->screen_name;
                $userInfo['bio'] = $user->bio;
                $userInfo['join_date']   = $user->join_date;
                $userInfo['user_id']     = $user->user_id;
                $userInfo['email']       = $user->email;
            }
            return $userInfo;
        } else {
            // User doesn't exist or something went wrong
            return false;
        }
    }

    /**
    *
    * Gets the "user id" of the specified user
    * @param [String] $screen_name a valid screen name
    * @return [String] the id of the user on success, false on failure
    */
    public function getUserIDByScreename($screen_name)
    {
    
        $query = $this->db->get_where('users',array('screen_name' => $screen_name));

        if ($query->num_rows() !== 1)
        {
            return false;
        }
        $data = $query->row();
        $query->free_result();
        return $data->user_id;
    }
    
    /**
    *
    * Gets the "oauth user id" of the specified user
    * @param [int] $id a valid oauth_user_id
    * @return [String] the screename of the user on success, false on failure
    */
    public function getScreenameByOAuthID($id)
    {
    
        $query = $this->db->get_where('users',array('oauth_user_id' => $id));

        if ($query->num_rows() !== 1)
        {
            return false;
        }

        $data = $query->row();
        $query->free_result();
        return $data->screen_name;
    }

    /**
    *
    * Gets the "user id" of the specified user
    * @param [int] $id a valid user_id
    * @return [String] the screename of the user on success, false on failure
    */
    public function getScreenameByUserID($id)
    {
    
        $query = $this->db->get_where('users',array('user_id' => $id));

        if ($query->num_rows() !== 1)
        {
            return false;
        }

        $data = $query->row();
        $query->free_result();
        return $data->screen_name;
    }

    public function getProficiencyRoles($catagory)
    {
        $query = $this->db->get_where('prof_roles',array('prof_catagory' => $catagory));
        return $query->result();
    }


    
    /**
     * Checks whether the user is a current member.
     * @param [String ] $screename - The user id to check for.
     * @return [Bool] True on if the user is a member, false if it's not.
     */
    public function isMember($oauth_user_id)
    {
        // Get users with the matching screen name
        $query = $this->db->get_where('users', array(
            'oauth_user_id' => $oauth_user_id
        ));
        
        if ($query->num_rows() > 0) {
            // User is registered
            return true;
        } else {
            // User is new
            return false;
        }
    }  

    public function liberateUserData($screen_name)
    {

        $user_id = $this->getUserIDByScreename($screen_name);
        // Fetch user data
        $query = $this->db->get_where('users', array(
            'screen_name' => $screen_name
        ));

        $this->load->dbutil();
        return $this->dbutil->xml_from_result($query);
    }
}
