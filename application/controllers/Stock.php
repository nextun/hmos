<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Ward_m'); 
		$this->load->model('Stock_m'); 
		$this->load->model('Drugs_m');
	}

	public function index(){ 
		
		$data['ward_list'] = $this->Ward_m->getlist();
		
		$this->load->view('stock/index', $data);
	}
	
	public function view($id){
		$data['wardid'] = $id;
		$data['stock_list'] = $this->Stock_m->getlistbyid($id);
		
		$this->load->view('stock/view', $data);
	}
	
	public function add($id = NULL){
		 	
		if($id){
			$data['ward_id']= $id;
		}
		$data['drugs_list'] = $this->Drugs_m->getlist();
		$data['drug_types']  = $this->Drugs_m->getdrugs_types();
		$data['ward_list'] = $this->Ward_m->getlist();
		
		$this->form_validation->set_rules('drug_id', 'Drug name', 'trim|required');
		$this->form_validation->set_rules('ward_id', 'Ward Description ', 'trim|required'); 
		$this->form_validation->set_rules('quantity', 'Quantity ', 'trim|required'); 
		$this->form_validation->set_rules('min_level', 'Min level ', 'trim|required'); 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('stock/add', $data);
		}
		else
		{
			$drug_id = $this->input->post('drug_id');
			$ward_id = $this->input->post('ward_id');
			
			if($this->Stock_m->checkexist($drug_id,$ward_id)){
				
				$updatedata = array(   
						'min_level'   => $this->input->post('min_level'),
					);
					$this->db->set('quantity', 'quantity + ' . (int) $this->input->post('quantity'), FALSE);
					$this->db->where('ward_id', $ward_id);
					$this->db->where('drug_id', $drug_id);
					$this->db->update('drug_stock', $updatedata);
					
			}else{
				$insertdata = array(
						'drug_id'      	=> $this->input->post('drug_id'), 
						'ward_id'   => $this->input->post('ward_id'),  
						'quantity'   => $this->input->post('quantity'),  
						'min_level'   => $this->input->post('min_level'), 
				);
				$this->db->insert('drug_stock',$insertdata);	
			}
			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('stock/add');
		}
	}

	public function edit($id){
		 
		$data['ward_list'] = $this->Ward_m->getlist();
		
		if($id){ 
			$data['drugs_list']  = $this->Drugs_m->getlist();
			count($data['drugs_list']) || $data['errors'][] = 'Drugs could not be found';
			 
			$data['stock_list'] = $this->Stock_m->getbyid($id);
		}
		
		$this->form_validation->set_rules('drug_id', 'Drug name', 'trim|required');
		$this->form_validation->set_rules('ward_id', 'Ward Description ', 'trim|required'); 
		$this->form_validation->set_rules('quantity', 'Quantity ', 'trim|required'); 
		$this->form_validation->set_rules('min_level', 'Min level ', 'trim|required'); 
		 
		
		if ($this->form_validation->run() == TRUE)
		{  
			$updatedata = array(
						'drug_id'      	=> $this->input->post('drug_id'), 
						'ward_id'   => $this->input->post('ward_id'),  
						'quantity'   => $this->input->post('quantity'),  
						'min_level'   => $this->input->post('min_level'),
			);
			
			$this->db->where('id', $id);
			$this->db->update('drug_stock', $updatedata);
			
			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('stock/');
		}
		
		
		$this->load->view('stock/edit', $data);
			
		
	}

}