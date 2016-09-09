<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HMS_Controller extends CI_Controller {

    function __construct(){
  		parent::__construct();

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Login_m');

		//Login check
		$exception_uris = array(
			'login',
			'login/logout'
		);
		if(in_array(uri_string(), $exception_uris) == FALSE){
			if($this->Login_m->loggedin() == FALSE){
				redirect('login');
			}
		}
  }
}
