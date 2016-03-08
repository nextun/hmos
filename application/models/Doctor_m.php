<?php 
class Doctor_m extends CI_Model{

	public function getdoclist(){
		$docs = $this->db->get('doctors');
		return $docs->result();
	}

	public function inserdoc(){

	}
	
	function getbyid($id){
		
        $query = $this->db->where('id' , $id);
        $query = $this->db->get('doctors' , 'DESC');
        
        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
}