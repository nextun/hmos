<?php 
class Ward_m extends CI_Model{

    function get_new(){
		$war = new stdClass();
		$war->war_name = '';
		
 		return $war;
	}
	
    
	public function getlist(){
		$docs = $this->db->get('ward');
		return $docs->result();
	}

	public function inserdoc(){

	}
	
	function getbyid($id){
		
        $query = $this->db->where('id' , $id);
        $query = $this->db->get('ward' , 'DESC');
        
        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
}