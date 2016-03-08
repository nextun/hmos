<?php
class Dashboard_m extends CI_Model{

	public function tokens(){
		$docs = $this->db->get('tokens');
		return $docs->row();
	}

	public function inserdoc(){

	}

}