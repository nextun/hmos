<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tokens extends HMS_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('Tokens_m');
		$this->load->model('Patient_m');
		$this->load->model('Drugs_m');
		$this->load->helper('date');

	}

	public function index(){
		$data['tokens_list'] = $this->Tokens_m->getlist();
		$data['ses_usertype'] = $this->session->userdata('usertype');
 		$this->load->view('tokens/index', $data);
	}

	public function checkpatient(){
		$data['patient'] ="";
		$data['error'] = "";
		$this->form_validation->set_rules('patient_id', 'Patient id', 'trim|required|regex_match[/^[0-9]/]');
		if($this->input->post('patient_id')){
			if ($this->form_validation->run() == TRUE)
			{
				$patient_id = $this->input->post('patient_id');
				$data['patient'] = $this->Patient_m->getbyid($patient_id);
				if($data['patient']==FALSE){
					$data['error'] ="Patient not found";
				}
			}else{
				$data['error'] = 'Please enter valid Patient ID';
			}
		}else{
			$data['error'] = 'Please enter Patient ID';
		}
		$data = $this->load->view('tokens/checkpatient',$data, TRUE);
		$this->output->set_output($data);
	}

	public function generate_token(){
		//$datestring = "%Y%m%d";
		//$time = time();
		$today = mdate("%Y%m%d", time());
		$maxid = 0;
		$row = $this->db->query("SELECT MAX(SUBSTR(tok_number,9)) AS max FROM tokens where tok_number LIKE '".$today."%'")->row();

		if ($row) {
			$maxid = $row->max;
		}

		$maxid = $maxid + 1 ;
		$tokenid = $today.$maxid;
		$this->form_validation->set_rules('pat_id', 'Patient ID', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error_msg', 'Error on patient ID.');
			redirect('tokens');
		}
		else
		{
			$query = $this->db->where('tok_patient_id' , $this->input->post('pat_id'));
			$query = $this->db->where('tok_status' , 'Open');
			$query = $this->db->get('tokens');

			if($query->num_rows()>0){
				$this->session->set_flashdata('error_msg', 'Patient has Open Token');
				 redirect('tokens');
			}else{
				$insertdata = array(
							'tok_patient_id' 	=> $this->input->post('pat_id'),
							'tok_number'     	=> $tokenid,
							'tok_added_time' 	=> mdate("%Y-%m-%d %H:%i:%s", time()),
							'tok_status'			=> 'Open',
				);

				$this->db->insert('tokens',$insertdata);
				$this->session->set_userdata('current_tokenid', $tokenid);
				//$this->session->set_flashdata('success_msg', 'successfully added.');
				redirect('tokens/process');
			}
		}
		//$data = $this->load->view('tokens/tokenid', $data, TRUE);
		//$this->output->set_output($data);
	}

	public function process(){

		$data['ses_usertype'] = $this->session->userdata('usertype');
		$data['drugs_list'] = $this->Drugs_m->getlist();
		$data['current_tokenid'] = $this->session->userdata('current_tokenid');
		$data['token_data'] = $this->Tokens_m->getTokenStatus($data['current_tokenid']);
		$data['token_drugs_list'] = $this->Tokens_m->getDrugsbyTokenID($data['current_tokenid']);
		$data['token_info'] = $this->Tokens_m->getTokenInfo($data['current_tokenid']);
		$data['drugs_types'] = $this->Drugs_m->getdrugs_types();

		if($data['token_data'] == "Closed" || $data['ses_usertype']== "nurse")
			{
				$data['patentDetails'] = $this->Tokens_m->patentDetails($data['current_tokenid']);

				$this->load->view('tokens/patientdrugs', $data);

			}else{
				//Form validation
				$this->form_validation->set_rules('drug_id', 'Drug name', 'trim|required');
				$this->form_validation->set_rules('quantity', 'Quantity ', 'required|regex_match[/^[0-9]/]');
				$this->form_validation->set_rules('drug_rate', 'Drug Rate', 'trim|required');
				$this->form_validation->set_rules('drug_types', 'Drug type', 'trim|required');
				$this->form_validation->set_rules('timerate', 'Timerate Rate', 'trim|required');
				//- Form validation set end

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tokens/drugs', $data);
				}
				else
				{
					$insertdata = array(
								'token_id'  	=> $data['current_tokenid'],
								'drug_id'   	=> $this->input->post('drug_id'),
								'quantity'		=> $this->input->post('quantity'),
								'timerate' 		=> $this->input->post('timerate'),
								'per_time' 		=> $this->input->post('drug_rate'),
								'drugtype_id' => $this->input->post('drug_types'),
								'note' => $this->input->post('note'),
								'added_date' 	=> mdate("%Y-%m-%d %H:%i:%s", time()),
								'drug_status'	=> 'Active',
							);
					$this->db->insert('token_drugs',$insertdata);
					$this->session->set_flashdata('success_msg', 'successfully added.');
					redirect('tokens/process');
				}
			}
		//$this->load->view('tokens/drugs', $data);
	}

	public function note($token_number){
		$data['current_tokenid'] = $this->session->userdata('current_tokenid');
		$data['token_data'] = $this->Tokens_m->getTokenStatus($token_number);
		$data['token_info'] = $this->Tokens_m->getTokenInfo($token_number);

				$this->form_validation->set_rules('note', 'Note', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tokens/patientnote', $data);
				}
				else
				{
					$insertdata = array(
								'token_id'      	=> $data['current_tokenid'],
								'description'      	=> $this->input->post('note'),
								'added_time' => mdate("%Y%m%d %h:%i:%s", time()),
								'doc_id'		=> 1,
							);
					$this->db->insert('token_info',$insertdata);
					$this->session->set_flashdata('success_msg', 'Note added.');
					redirect('tokens');
				}
	}

	public function admit(){
		$this->form_validation->set_rules('ward_id', 'Ward id  ', 'trim|required');
		$this->form_validation->set_rules('bed_id', 'Bed id', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['ward_list'] = $this->Tokens_m->getWard_hasbed();
			$this->load->view('tokens/admit',$data);
		}
		else
		{
			$data['current_tokenid'] = $this->session->userdata('current_tokenid');
			$updatedata = array(
						'tok_bed_id'  => $this->input->post('bed_id'),
						'tok_ward_id' => $this->input->post('ward_id'),
						'tok_reg_status' => 'Admit',
						'tok_reg_time'	=> mdate("%Y-%m-%d %H:%i:%s", time())
					);
			$this->db->where('tok_number', $data['current_tokenid']);
			$this->db->update('tokens', $updatedata);
			$this->session->set_flashdata('success_msg', 'successfully finished.');
			$this->session->set_userdata('current_tokenid', "");
			redirect('tokens');
		}
	}

	public function check($id){
		$this->session->set_userdata('current_tokenid', $id);
		//current_tokenid = 23434636;
			redirect('tokens/process');
	}

	public function get_beds(){
        $data['beds'] = $this->Tokens_m->gethasbed($this->input->post('ward_id'));
        //echo json_encode($beds);
		$data = $this->load->view('tokens/admitbed',$data, TRUE);
		$this->output->set_output($data);
  }

	public function finish(){
		$data['current_tokenid'] = $this->session->userdata('current_tokenid');
		if($data['current_tokenid']){
			$updatedata = array(
						'tok_reg_status'      	=> 'Discharged',
						'tok_end_time' => mdate("%Y%m%d %h:%i:%s", time()),
						'tok_status'		=> 'Closed',
					);
			$this->db->where('tok_number', $data['current_tokenid']);
			$this->db->update('tokens', $updatedata);
			$this->session->set_flashdata('success_msg', 'successfully finished.');
			$this->session->set_userdata('current_tokenid', "");
			redirect('tokens');
		}else{
			//
			$this->session->set_flashdata('success_msg', 'Faild.');
			$this->session->set_userdata('current_tokenid', "");
			redirect('tokens');
		}
	}
}
