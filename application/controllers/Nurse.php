<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse extends CI_Controller {
	public function index(){
		$this->load->model('Nurse_m');
		$data['nurselist'] = $this->Nurse_m->getnurselist();
		$this->load->view('nurse/index', $data);
	}
}