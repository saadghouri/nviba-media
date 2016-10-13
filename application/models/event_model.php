<?php 

class event_model extends CI_Model {
	
	public function setEvent($eventdata){
		$start_date = $eventdata['start_date'];
		$newStartDate = date("Y-m-d H:i:s", strtotime($start_date));

		$end_date = $eventdata['end_date'];
		$newEndDate = date("Y-m-d H:i:s", strtotime($end_date));

		$data = array(
			'name' => trim($eventdata['name']) ,
			'description' => trim($eventdata['description']),
			'start_date' => trim($newStartDate),
			'end_date' => trim($newEndDate),
			'address' => trim($eventdata['address']),
			'image_path' => trim($eventdata['image_path']),
			'user_id' => trim($eventdata['user_id'])
			);

		$this->db->insert('events', $data);
	}

	public function getAllEvents(){
		$query = $this->db
						->select('*')
						->from('users')
						->join('events', 'users.id = events.user_id')
						->get();
		
		if($query->num_rows() >= 1)
			return $query->result_array();
   		else
			return false;
	}

	public function getEvent($id){
		$query = $this->db->get_where('events', array('id'=>$id));
		return $query->row_array();
		
	}

	public function getRegisteredMemebers($id){
		$query = $this->db
						->select('users.fname, users.lname')
						->from('user_event')
						->join('users', 'users.id = user_event.user_id')
						->where('user_event.event_id', $id)
						->get();

		return $query->result_array();
	}

	public function setEventRegistration($eventData){
		$query = array(
			'event_id' => trim($eventData['event_id']) ,
			'user_id' => trim($eventData['user_id'])
			);

		$response = $this->db->insert('user_event', $query);
		return $response;
	}	

	public function getRegisteredUser($data){
		$query = $this->db->get_where('user_event', 
										array(
											'event_id' => $data['event_id'],
											'user_id' => $data['user_id']
											)
										);
		if($query->num_rows() >= 1){
			return false;
		}
		else{
			$response = $this->setEventRegistration($data);
			return $response;
		}
	}
}

?>