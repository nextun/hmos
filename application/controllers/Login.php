<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends HMS_Controller {

    public function __construct(){
		parent::__construct();
        $this->load->model('Login_m');
	}

	public function index(){


		$dashboard = 'dashboard';
		$this->Login_m->loggedin() == FALSE || redirect($dashboard);
    // if (	$this->Login_m->loggedin() == FALSE) {
    //     echo "error";
    // }else {
    //   redirect($dashboard);
    // }

		$this->form_validation->set_rules("username","Username","trim|required");
		$this->form_validation->set_rules("password","Password","trim|required");


		if($this->form_validation->run() == TRUE){
			//Values
			if($this->Login_m->login() == TRUE){
				redirect($dashboard);
			}else{
				$this->session->set_flashdata('error','That email/password combination does not exist');
				redirect('login');
        //$this->load->view('login');
			}
		}
 		$this->load->view('login');
	}

  public function logout(){
		$this->Login_m->logout();
		redirect('login');
	}

    public function test(){
        $this->load->view('login');
    }

}

http://localhost/hmos/login/logout

?>
