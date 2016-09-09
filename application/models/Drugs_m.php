<?php 
class Drugs_m extends CI_Model{

	public function getlist(){
		$drugs = $this->db->get('drugs');
		return $drugs->result();
	}

	public function inserdoc(){

	}
	
	function getbyid($id){
		
        $query = $this->db->where('id' , $id);
        $query = $this->db->get('drugs' , 'DESC');
        
        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
	
	public function getdrugs_types(){
		$docs = $this->db->get('drug_types');
		return $docs->result();
	}
}