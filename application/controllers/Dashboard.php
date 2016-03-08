<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
        $this->load->model('dashboard_m');
		$this->dashboard_m->tokens();
		$this->load->view('dashboard');
	}
}