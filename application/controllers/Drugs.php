<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drugs extends CI_Controller {

	public function index(){
		$this->load->model('Drugs_m');
		$data['drugs_list'] = $this->Drugs_m->getlist();
		
		$this->load->view('drugs/index', $data);
	}
	
	public function add(){ 
		
		$this->form_validation->set_rules('dru_name', 'Drug name', 'trim|required');
		$this->form_validation->set_rules('dru_description', 'Drug Description ', 'trim|required'); 
		 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('drugs/add');
		}
		else
		{ 
			$insertdata = array(
						'dru_name'      	=> $this->input->post('dru_name'), 
						'dru_description'     		=> $this->input->post('dru_description'),  
						'dru_status'		=> 'Active',
					);
			
			$this->db->insert('drugs',$insertdata);
			
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('drugs/add');
		}
	}
	
	

	public function edit($id){
		
		if($id){
			$this->load->model('Drugs_m');
			$data['drugs_list']  = $this->Drugs_m->getbyid($id);
			count($data['drugs_list']) || $data['errors'][] = 'Drugs could not be found';
		}
       
		$this->form_validation->set_rules('dru_name', 'Drug name', 'trim|required');
		$this->form_validation->set_rules('dru_description', 'Drug Description ', 'trim|required');
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'dru_name'      	=> $this->input->post('dru_name'), 
						'dru_description'     		=> $this->input->post('dru_description'),  
						'dru_status'		=> 'Active',
					);
			
			 
			
			$this->db->where('id', $id);
			$this->db->update('drugs', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('drugs/');
		}
		
		
		$this->load->view('drugs/edit', $data);
			
		
	}

}