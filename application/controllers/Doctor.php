<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function index(){
		$this->load->model('Doctor_m');
		$data['doctorslist'] = $this->Doctor_m->getdoclist();
		
		$this->load->view('doctors/index', $data);
	}
	
	public function add(){
		$this->load->view('doctors/add');
	}
	
	public function insert(){
		
		$this->form_validation->set_rules('docname', 'Doctor name', 'trim|required');
		$this->form_validation->set_rules('docmobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('dochospital', 'Hospital name', 'trim|required');
		 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('doctors/add');
		}
		else
		{ 
			$insertdata = array(
						'doc_name'      	=> $this->input->post('docname'), 
						'doc_mobile'     		=> $this->input->post('docmobile'), 
						'doc_main_hospital' => $this->input->post('dochospital'),
						'doc_status'		=> 'Active',
					);
			
			$this->db->insert('doctors',$insertdata);
			
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('doctor/add');
		}
	}
	
	

	public function edit($docid){
		
		if($docid){
			$this->load->model('Doctor_m');
			$data['doctors_list']  = $this->Doctor_m->getbyid($docid);
			count($data['doctors_list']) || $data['errors'][] = 'Doctor could not be found';
		}
       
		$this->form_validation->set_rules('docname', 'Doctor name', 'trim|required');
		$this->form_validation->set_rules('docmobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('dochospital', 'Hospital name', 'trim|required');
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'doc_name'      	=> $this->input->post('docname'), 
						'doc_mobile'     		=> $this->input->post('docmobile'), 
						'doc_main_hospital' => $this->input->post('dochospital'),
						'doc_status'		=> 'Active',
					);
			
			 
			
			$this->db->where('id', $docid);
			$this->db->update('doctors', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('doctor/');
		}
		
		
		$this->load->view('doctors/edit', $data);
			
		
	}

}