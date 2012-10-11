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
        	return true;
		}
        	
        foreach ($member_info['proficiencies'] as $prof_id => $prof_value) {
            // Iterate through each proficiency the user has set and insert it into the database
            
            // My god... this is why I love CI
            $this->db->set('user_id', $user_id);
            $this->db->set('prof_id', $prof_id);
            $this->db->set('prof_value', $prof_value);
            $result = $this->db->insert('proficiencies');
            if (!$result) {
            	return false;
            }
        } //foreach
        return true;          
    }
    
	
	/**
	 * Gets an assocative array with the user's proficiency values
	 * mapped to the skill i.e. "Adobe Photoshop" => 20
     * @param [string] $screen_name The screen name of the user
	 * @return [Array] An assocative array containg all of the user's proficiencies
	 */
    public function getUserProficiencies($screen_name)
	{
		
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
                $userInfo['join_date']   = $user->join_date;
                $userInfo['user_id']     = $user->user_id;
                $userInfo['email']       = $user->email;
            }
            return $userInfo;
        } else {
            // User doesn't exist
            return false;
        }
    }
    
    
    
    /**
     * Checks whether the user is a current member.
     * @param [String ] $screename - The username to check for.
     * @return [Bool] True on if the user is a member, false if it's not.
     */
    public function isMember($screen_name)
    {
        // Get users with the matching screen name
        $query = $this->db->get_where('users', array(
            'screen_name' => $screen_name
        ));
        
        if ($query->num_rows() > 0) {
            // User is registered
            return true;
        } else {
            // User is new
            return false;
        }
    }
    
    
    
}
