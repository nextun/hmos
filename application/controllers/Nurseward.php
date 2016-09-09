<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurseward extends CI_Controller {

	public function index(){ 
		$this->load->model('Nurseward_m');
		$data['nurseward_list'] = $this->Nurseward_m->getlist();
		
		$this->load->view('nurseward/index', $data);
	}
	
	public function view($id){
		$data['wardid'] = $id;
		$this->load->model('Stock_m');
		$data['stock_list'] = $this->Stock_m->getlistbyid($id);
		
		$this->load->view('nurseward/view', $data);
	}
	
	public function add($id = NULL){
		$this->load->model('Nurseward_m');
		
		if($id){
			$data['ward_id']= $id;
		}
		$this->load->model('Nurse_m');
		$data['nurse_list'] = $this->Nurse_m->getlist();
		
		$this->load->model('Ward_m');
		$data['ward_list'] = $this->Ward_m->getlist();
		
		$this->form_validation->set_rules('nurse_id', 'Nurse name', 'trim|required');
		$this->form_validation->set_rules('ward_id', 'Ward Description ', 'trim|required');  
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('nurseward/add', $data);
		}
		else
		{
			$nurse_id = $this->input->post('nurse_id');
			$ward_id = $this->input->post('ward_id');
			
			if($this->Nurseward_m->checkexist($nurse_id,$ward_id)){
				
				$this->session->set_flashdata('success_msg', 'Already exist.');
				redirect('nurseward/add');
					
			}else{
				$insertdata = array(
						'nurse_id'  => $this->input->post('nurse_id'), 
						'ward_id'   => $this->input->post('ward_id'),   
				);
				$this->db->insert('nurse_ward',$insertdata);	
			}
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('nurseward/add');
		}
	}

	public function edit($id){
		
		$this->load->model('Nurse_m');
		$data['nurse_list'] = $this->Nurse_m->getlist();
		
		$this->load->model('Ward_m');
		$data['ward_list'] = $this->Ward_m->getlist();
		
		if($id){
			$this->load->model('Nurseward_m');
			$data['nurseward_list']  = $this->Nurseward_m->getbyid($id);
			count($data['nurseward_list']) || $data['errors'][] = 'Record could not be found';
		}
		
		$this->form_validation->set_rules('nurse_id', 'Nurse name', 'trim|required');
		$this->form_validation->set_rules('ward_id', 'Ward Description ', 'trim|required');  
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'nurse_id'      	=> $this->input->post('nurse_id'), 
						'ward_id'   => $this->input->post('ward_id'),   
			);
			
			$this->db->where('id', $id);
			$this->db->update('nurse_ward', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('nurseward/');
		}
		
		
		$this->load->view('nurseward/edit', $data);
			
		
	}

}