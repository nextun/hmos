<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward extends CI_Controller {

	public function index(){
		$this->load->model('Ward_m');
		$data['ward_list'] = $this->Ward_m->getlist();
		
		$this->load->view('settings/ward/index', $data);
	}
	
	public function add(){  
		$this->form_validation->set_rules('war_name', 'Ward number', 'trim|required');
		 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('settings/ward/add'  );
		}
		else
		{ 
			$insertdata = array(
						'war_name'      	=> $this->input->post('war_name'), 
						'war_status'     		=> 'Active',  
					);
			
			$this->db->insert('ward',$insertdata);
			
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('ward/add');
		}
	}
	
	

	public function edit($id){ 
		
		if($id){
			$this->load->model('Ward_m');
			$data['ward_list']  = $this->Ward_m->getbyid($id);
			count($data['ward_list']) || $data['errors'][] = 'Ward could not be found';
		}
       
		$this->form_validation->set_rules('war_name', 'War number', 'trim|required');  
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'war_name'      	=> $this->input->post('war_name'), 
						'war_status'     		=> 'Active',  
					);
			
			 
			
			$this->db->where('id', $id);
			$this->db->update('ward', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('ward/');
		}
		
		
		$this->load->view('settings/ward/edit', $data);
			
		
	}

}