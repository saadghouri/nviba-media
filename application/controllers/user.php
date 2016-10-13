<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
	public function signup()
	{
		if(!$this->session->userdata('logged_in')){
			$this->template
				->setViewPath('user/index')
	  			->render();
	  	}
	  	else{
	  		redirect('/');
	  	}
	}

	public function getUserRegistrationFormValues()
	{	
		$this->load->model('user_model');
		$data = $this->input->post();
		$response = $this->validateForm($data);
		echo json_encode($response);	
	}

	protected function validateForm($formValues)
	{


		/** First sanitize the form values **/
		$sanitizedFormVals = $this->getSanitizedFormValues($formValues);
		if ($sanitizedFormVals["fname"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your first name."
            );
        }

        if ($sanitizedFormVals["lname"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your last name."
            );
        }

        if ($sanitizedFormVals["email"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your email address."
            );
        } elseif ($this->user_model->emailExists($sanitizedFormVals["email"])) {
        	return array(
                "error_code" => 0,
                "message" => "Your email already exist in database"
            );
        }

        if ($sanitizedFormVals["password"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your password."
            );
        }
    	else
    	{
        	if(strlen($sanitizedFormVals["password"]) < 5) 
        	{
            	return array(
                	"error_code" => 0,
                	"message" => "Password cannot be greater than 5 characters."
            	);	
            }

        }
	
		$this->user_model->setUser($sanitizedFormVals);
	
		$success = array(
			"error_code" => 1,
			"message" => 'User successfully added'
		);
	
		return $success;
      
	}


	protected function getSanitizedFormValues($data)
	{
		$vals = array(
			'date_created' => date('Y-m-d'),
            'fname' => (isset($data["fname"]) && trim($data["fname"]) != "") ? trim($data["fname"]) : "",
            'lname' => (isset($data["lname"]) && trim($data["lname"]) != "") ? trim($data["lname"]) : "",
            'email' => (isset($data["email"]) && trim($data["email"]) != "") ? trim($data["email"]) : "",
            'password' => (isset($data["password"]) && trim($data["password"]) != "") ? trim($data["password"]) : "",
            );
		return $vals;
	}

	public function login()
	{
		if(!$this->session->userdata('logged_in')){
			$this->template
	     			->setViewPath('user/login')
			  		->render();
		}
		else{
			redirect('/');
		}
	}

	public function loginVerification(){
		$loginCredentials = $this->input->post();
		$response = $this->validateLoginForm($loginCredentials);
		if($response == null)
		{
			$userData = $this->check_database($loginCredentials);
			if($userData != false)
			{
				$userDataArray = array(
					'id' => $userData['id'],
					'first_name' => $userData['fname'],
					'last_name' => $userData['lname'],
					'email' => $userData['email'],
					'password' => $userData['password'],
					'date_created' => $userData['date_created']
					);

				$this->session->set_userdata('logged_in', $userDataArray);
				$output = array(
					'error_code' => 1,
					'message' => 'User successfully logged in');

				echo json_encode($output);
			}
			else
			{
				$output = array(
					'error_code' => 0,
					'message' => 'Incorrect username or password');
				echo json_encode($output);
			}	
		}
		else
		{
			echo json_encode($response);
		}
	}

	protected function check_database($data){
		$this->load->model('user_model');
		$response = $this->user_model->getUser($data);	
		return $response;
	}

	protected function validateLoginForm($data){
		if ($data["email"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your email address."
            );
        }

        if ($data["password"] == NULL) {
            return array(
                "error_code" => 0,
                "message" => "Please enter your password."
            );
        }
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}
?>