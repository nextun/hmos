<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function index(){
		$this->load->model('Patient_m');
		$data['patient_list'] = $this->Patient_m->getlist();

		$this->load->view('patient/index', $data);
	}

	public function add(){

		$this->form_validation->set_rules('pat_name', 'Patient name', 'trim|required');
		$this->form_validation->set_rules('pat_mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('pat_date_of_birth', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('pat_address', 'Address', 'trim|required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('patient/add');
		}
		else
		{
			$insertdata = array(
						'pat_name'      	=> $this->input->post('pat_name'),
						'pat_mobile'     		=> $this->input->post('pat_mobile'),
						'pat_date_of_birth' => $this->input->post('pat_date_of_birth'),
						'pat_address' => $this->input->post('pat_address'),
						'pat_status'		=> 'Active',
					);

			$this->db->insert('patient',$insertdata);

			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('patient/');
		}
	}



	public function edit($id){

		if($id){
			$this->load->model('Patient_m');
			$data['patient']  = $this->Patient_m->getbyid($id);
			count($data['patient']) || $data['errors'][] = 'Patient could not be found';
		}

		$this->form_validation->set_rules('pat_name', 'Patient name', 'trim|required');
		$this->form_validation->set_rules('pat_mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('pat_date_of_birth', 'Date of Birth', 'trim|required|max_length[10]|callback_is_date_valid');
        $this->form_validation->set_rules('pat_address', 'Address', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$updatedata = array(
						'pat_name'      	=> $this->input->post('pat_name'),
						'pat_mobile'     		=> $this->input->post('pat_mobile'),
						'pat_date_of_birth' => $this->input->post('pat_date_of_birth'),
						'pat_address' => $this->input->post('pat_address'),
						'pat_status'		=> 'Active',
					);



			$this->db->where('id', $id);
			$this->db->update('patient', $updatedata);

			$this->session->set_flashdata('success_msg', 'successfully updated.');
			redirect('patient/');
		}


		$this->load->view('patient/edit', $data);


	}

    function is_date_valid($date) {
    if (date('Y-m-d', strtotime($date)) == $date) {
        return TRUE;
    } else {
        $this->form_validation->set_message('dob_date', 'The %s Date must be in format "yyyy-mm-dd"');
            return FALSE;
    }
}

}
