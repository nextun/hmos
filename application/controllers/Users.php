<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
		$this->load->model('Users_m');
		$data['users_list'] = $this->Users_m->getlist();

		$this->load->view('users/index', $data);
	}

	public function add(){

		$this->form_validation->set_rules('username', 'Users name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password ', 'required');
		$this->form_validation->set_rules('usertype', 'Address', 'trim|required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('users/add');
		}
		else
		{
			$insertdata = array(
						'username'      	=> $this->input->post('username'),
						'password'     		=> $this->input->post('password'),
						'usertype' => $this->input->post('usertype'),
						'ref_id' => $this->input->post('ref_id'),
					);

			$this->db->insert('users',$insertdata);

			$this->session->set_flashdata('success_msg', 'successfully added.');
			redirect('users/');
		}
	}



	public function edit($id){

		if($id){
			$this->load->model('users_m');
			$data['users']  = $this->users_m->getbyid($id);
			count($data['users']) || $data['errors'][] = 'Users could not be found';
		}

		$this->form_validation->set_rules('username', 'Users name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password ', 'required');
		$this->form_validation->set_rules('usertype', 'User type', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$updatedata = array(
						'username'      	=> $this->input->post('username'),
						'password'     		=> $this->input->post('password'),
						'usertype' => $this->input->post('usertype'),
						'ref_id' => $this->input->post('ref_id'),
						'added_on'		=> mdate("%Y-%m-%d %H:%i:%s", time()),
					);



			$this->db->where('id', $id);
			$this->db->update('users', $updatedata);

			$this->session->set_flashdata('success_msg', 'Successfully updated.');
			redirect('users/');
		}


		$this->load->view('users/edit', $data);


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
