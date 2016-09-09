<?php
class MY_Controller Extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->data['errors'] = array();
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

}
