<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed extends CI_Controller {

	public function index(){
		$this->load->model('Bed_m');
		$data['bed_list'] = $this->Bed_m->getlist();
		
		$this->load->view('settings/bed/index', $data);
	}
	
	public function add(){ 
		$this->load->model('Ward_m');
		$data['ward_list'] = $this->Ward_m->getlist();
		$this->form_validation->set_rules('bed_number', 'Bed number', 'trim|required'); 
		$this->form_validation->set_rules('bed_ward_id', 'Ward name', 'trim|required');
		 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('settings/bed/add' , $data);
		}
		else
		{ 
			$insertdata = array(
						'bed_number'      	=> $this->input->post('bed_number'), 
						'bed_ward_id'     		=> $this->input->post('bed_ward_id'),  
					);
			
			$this->db->insert('bed',$insertdata);
			
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('bed/add');
		}
	}
	
	

	public function edit($id){
		$this->load->model('Ward_m');
		$data['ward_list'] = $this->Ward_m->getlist();
		
		if($id){
			$this->load->model('Bed_m');
			$data['bed_list']  = $this->Bed_m->getbyid($id);
			count($data['bed_list']) || $data['errors'][] = 'Bed could not be found';
		}
       
		$this->form_validation->set_rules('bed_number', 'Bed number', 'trim|required'); 
		$this->form_validation->set_rules('bed_ward_id', 'Ward name', 'trim|required');
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'bed_number'      	=> $this->input->post('bed_number'), 
						'bed_ward_id'     		=> $this->input->post('bed_ward_id'),  
					);
			
			 
			
			$this->db->where('id', $id);
			$this->db->update('bed', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('bed/');
		}
		
		
		$this->load->view('settings/bed/edit', $data);
			
		
	}

}