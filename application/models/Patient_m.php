<?php
class Patient_m extends CI_Model{

	public function getlist(){
		$docs = $this->db->get('patient');
		return $docs->result();
	}

	public function inserdoc(){

	}

	function getbyid($id){

        $query = $this->db->where('id' , $id);
        $query = $this->db->get('patient' , 'DESC');

        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
}
