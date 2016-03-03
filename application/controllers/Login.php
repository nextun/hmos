<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
        $this->load->model('Login_m');
	}
    
	public function index(){
		$this->load->view('login');
	}
    
    public function check(){
        
		$dashboard = 'dashboard';
		$this->Login_m->loggedin() == FALSE || redirect($dashboard);

		
        $rules  = array(
			'username' => array(
				'field' => 'username',
				'label' => 'Username', 
				'rules' => 'trim|required'
			),
			'password' => array(
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'trim|required'
			)
		);
        
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE){
			//Values
			if($this->Login_m->login() == TRUE){
				redirect($dashboard);
			}else{
				$this->session->set_flashdata('error','That email/password combination does not exist');
				redirect('login');
			}
		}
 		$this->load->view('login');
	}
    
    public function test(){
        $this->load->view('login');
    }
}
?>
