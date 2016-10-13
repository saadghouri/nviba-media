<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller
{
	public function index()
	{
		if($this->session->userdata('logged_in')){
			$this->template
					->setViewPath('events/index')
					->render();	
		}
		else
			redirect('user/login');
	}

	public function verifyevent(){
		if($this->session->userdata('logged_in')){
            $data = $this->input->post();
        	$validationResponse = $this->validateEventFormValues($data);
        	
        	if($validationResponse == null)
        	{
        		$file_name = uniqid() . $_FILES['image_path']['name']; //Unique file name
        		$fileUploadResponse = $this->uploadImage($_FILES, $file_name);
        	
        		if($fileUploadResponse != false)
        		{
        			$eventArray = array(
        				'name' => $data['name'],
        				'description' => $data['description'],
        				'start_date' => $data['start_date'],
        				'end_date' => $data['end_date'],
        				'address' => $data['address'],
        				'user_id' => $data['user_id'],
        				'image_path' => $file_name
        			);

        			$response = $this->createEvent($eventArray);
        			$success = "<div class='alert bg-success'>Event successfully created</div>";
        			$this->session->set_flashdata('success',$success);
        			redirect('events');
        		}
        	}
        }
        else
            redirect('user/login');
	}

	protected function validateEventFormValues($data){
		if ($data["name"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your name."
            );
        }

        if ($data["description"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter the description."
            );
        }

		if ($data["start_date"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please choose the start date & time"
            );
        }

        if ($data["address"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter the location."
            );
        }

        if ($data["end_date"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please choose the end date & time"
            );
        }
     }

     protected function createEvent($data){
     	$this->load->model('event_model');
     	$this->event_model->setEvent($data);	
		$success = array(
				"error_code" => 1,
				"message" => "Event successfully created."
				);
		
		return $success;
     }

     protected function uploadImage($files, $file_name){
     	if (is_uploaded_file($files['image_path']['tmp_name']) && $files['image_path']['error']==0) {

     		$path = $_SERVER['DOCUMENT_ROOT'] . "/nviba-media/assets/uploads/" . $file_name;
     		if (!file_exists($path)) {
	     		if (move_uploaded_file($_FILES['image_path']['tmp_name'], $path)) 
	     			return true;
	     		else
	     			return false;
	     	}
	     	else
	     		return false;
     	} 
     	else 
     		return false;
     }


     public function all(){
        if($this->session->userdata('logged_in')){
            $this->load->model('event_model');
         	$data = $this->event_model->getAllEvents();
            if($data != false) 
         	{	

                foreach($data as $key => $eventInfo){
                    $start_date = $eventInfo['start_date'];
                    $newStartDate = date("d-m-Y H:i:s", strtotime($start_date));

                    $end_date = $eventInfo['end_date'];
                    $newEndDate = date("d-m-Y H:i:s", strtotime($end_date));
                   
                    $array = array(
                        'id' => $eventInfo['id'],
                        'name' => $eventInfo['name'],
                        'description' => $eventInfo['description'],
                        'start_date' => $newStartDate,
                        'end_date' => $newEndDate,
                        'address' => $eventInfo['address'],
                        'image_path' => $eventInfo['image_path'],
                        'user_id' => $eventInfo['user_id'],
                        'fname' => $eventInfo['fname'],
                        'lname' => $eventInfo['lname']
                        );
                    $data[$key] = $array;
                }
                $data['eventData'] = $data;
                $this->template
         			->setViewData($data)
         			->setViewPath('events/all')
         			->render();
         	}
         	else
         	{
         		$danger = "<div class='alert bg-danger'>No events found</div>";
                $this->session->set_flashdata('danger',$danger);
         		$this->template
         			->setViewPath('events/all')
         			->render();
         	}
        }
        else
            redirect('user/login');
     }

     public function show($id = ""){
        if($this->session->userdata('logged_in')){
            if(isset($id) && !empty($id)){
                $this->load->model('event_model');
                $result['eventInfo'] = $this->event_model->getEvent($id);
                $result['registeredMembers'] = $this->event_model->getRegisteredMemebers($id);
                if($result['eventInfo'] != false){
                    $this->template
                            ->setViewData($result)
                            ->setViewPath('events/show')
                            ->render();   
                }
                else{
                    redirect('events/all');
                }
            }
        }
        else
            redirect('events/all');
     }
     public function checkUserRegisteration(){
        $data = $this->input->post();
        $this->load->model('event_model');
        $response = $this->event_model->getRegisteredUser($data);
        if($response == false){ 
            $success = array(
                    "error_code" => 0,
                    "message" => "You have already registered for this event."
                    );

            
        }
        else{
            $success = array(
                "error_code" => 1,
                "message" => "You have successfully registered to this event."
                );
        }

        echo json_encode($success);


     }
}

?>