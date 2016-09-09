<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends HMS_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('Tokens_m');
		$this->load->model('Patient_m');
		$this->load->model('Drugs_m');
		$this->load->helper('date');
		$this->load->model('dashboard_m');


		//_is_logged_in

	}

	public function index(){
		$data['tokens_list'] = $this->Tokens_m->getlist();
		//$this->dashboard_m->tokens();

		$data['drug_level']  = $this->dashboard_m->druglevel();


$data['ses_usertype'] = $this->session->userdata('usertype');
		$this->load->view('dashboard', $data);
	}

}
