<?php 

class user_model extends CI_Model {
	
	public function setUser($userData){
		$data = array(
			'fname' => trim($userData['fname']) ,
			'lname' => trim($userData['lname']),
			'email' => trim($userData['email']),
			'password' => md5(trim($userData['password'])),
			'date_created' => trim($userData['date_created'])
			);
		
		$this->db->insert('users', $data);
	}

	public function getUser($data){
		// print_r($data);
		$query = $this
					->db
					->get_where('users', 
						array(
							'email'=>trim($data['email']),
							'password' => md5(trim($data['password']))
						)
					);
		if($query -> num_rows() == 1)
			return $query->row_array();
   		else
			return false;
	}

	 /**
     * This function checks if email exists in the database.<br/>
     * @param string $email
     * @return array
     */
    function emailExists($email) {

        if ($email == "")
            return false;
        
        $this->db->where('email',$email);
        
        $result = $this->db->get('users')->result();

        if(count($result) == 0)
            return false;
        
        return $result[0];
    }

}