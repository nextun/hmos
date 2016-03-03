<?php 
class Doctor_m extends CI_Model{

	public function getdoclist(){
		$docs = $this->db->get('doctors');
		return $docs->result();
	}

	public function inserdoc(){

	}

}