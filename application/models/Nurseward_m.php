<?php 
class Nurseward_m extends CI_Model{

	public function getlist(){
		$this->db->select('nurse_ward.*,nurse.nur_name,ward.war_name');
		//$this->db->from('drug_stock');
		$this->db->join('nurse', 'nurse.id = nurse_ward.nurse_id');
		$this->db->join('ward', 'ward.id = nurse_ward.ward_id');
		
		$docs = $this->db->get('nurse_ward');
		return $docs->result();
	}
 
	
	function getbyid($id){
		
        $this->db->select('nurse_ward.*,nurse.nur_name,ward.war_name');
 		$this->db->join('nurse', 'nurse.id = nurse_ward.nurse_id');
		$this->db->join('ward', 'ward.id = nurse_ward.ward_id');
		$query = $this->db->where('nurse_ward.id' , $id);
		$query = $this->db->get('nurse_ward');
		
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    } 
	function getlistbyid($id){
		$this->db->select('drug_stock.*,drugs.dru_name');
		//$this->db->from('drug_stock');
		$this->db->join('drugs', 'drugs.id = drug_stock.drug_id'); 
        $query = $this->db->where('ward_id' , $id);
        $query = $this->db->get('drug_stock' , 'DESC');
        
        if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
    }
	
	function checkexist($nurse_id,$ward_id){
		 
        $query = $this->db->where('nurse_id' , $nurse_id);
		$query = $this->db->where('ward_id' , $ward_id);
        $query = $this->db->get('nurse_ward' , 'DESC');
        
        if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
}