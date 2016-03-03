<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function index(){
		
	}

	public function slist(){
		$this->load->model('Doctor_m');
		$data['doctorslist'] = $this->Doctor_m->getdoclist();
		$data['header'] = "Doctors List";
		$data['pages'] = 45;
		$this->load->view('doctors/doc_list' , $data);
	}
	public function insert(){
		
	}

	public function edit($id){
		
	}


}