<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller
{
  
  public function index(){
  	
  	if($this->session->userdata('logged_in')){
  		$session_data = $this->session->userdata('logged_in');
      $data['first_name'] = $session_data['first_name'];
     	$data['last_name'] = $session_data['last_name'];
      $this->template
     			->setViewPath('page/index')
		  		->setViewData($data)
		  		->render();
    }
  	else
  	{
  		redirect('/user/login');
  	}
    
  }

}

?>
