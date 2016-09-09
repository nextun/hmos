<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse extends CI_Controller {

	public function index(){
		$this->load->model('Nurse_m');
		$data['nurse_list'] = $this->Nurse_m->getlist();
		
		$this->load->view('nurse/index', $data);
	}
	
	public function add(){
		$this->load->view('nurse/add');
	}
	
	public function insert(){
		
		$this->form_validation->set_rules('nursename', 'Nurse name', 'trim|required');
		$this->form_validation->set_rules('nursemobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
 		 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('nurse/add');
		}
		else
		{ 
			$insertdata = array(
						'nur_name'      	=> $this->input->post('nursename'), 
						'nur_mobile'     		=> $this->input->post('nursemobile'), 
						'nur_status'		=> 'Active',
					);
			
			$this->db->insert('nurse',$insertdata);
			
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('nurse/add');
		}
	}
	
	

	public function edit($docid){
		
		if($docid){
			$this->load->model('Nurse_m');
			$data['nurse_list']  = $this->Nurse_m->getbyid($docid);
			count($data['nurse_list']) || $data['errors'][] = 'Nurse could not be found';
		}
       
		$this->form_validation->set_rules('nursename', 'Nurse name', 'trim|required');
		$this->form_validation->set_rules('nursemobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'nur_name'      	=> $this->input->post('nursename'), 
						'nur_mobile'     		=> $this->input->post('nursemobile'), 
						'nur_status'		=> 'Active',
					);
			
			 
			
			$this->db->where('id', $docid);
			$this->db->update('nurse', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('nurse/');
		}
		
		
		$this->load->view('nurse/edit', $data);
			
		
	}

}