<?php 
class Bed_m extends CI_Model{

    function get_new(){
		$war = new stdClass();
		$war->bed_number = '';
		$war->bed_ward_id = 'Select the ward';
		
		
 		return $war;
	}
	
    
	public function getlist(){
		$docs = $this->db->get('bed');
		return $docs->result();
	}

	public function inserdoc(){

	}
	
	function getbyid($id){
		
        $query = $this->db->where('id' , $id);
        $query = $this->db->get('bed' , 'DESC');
        
        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
}