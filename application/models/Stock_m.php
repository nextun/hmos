<?php 
class Stock_m extends CI_Model{

	public function getlist(){
		$docs = $this->db->get('drug_stock');
		return $docs->result();
	}
 
	
	function getbyid($id){
		
        $query = $this->db->where('id' , $id);
        $query = $this->db->get('drug_stock' , 'DESC');
        
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
	
	function checkexist($drug_id,$ward_id){
		 
        $query = $this->db->where('drug_id' , $drug_id);
		$query = $this->db->where('ward_id' , $ward_id);
        $query = $this->db->get('drug_stock' , 'DESC');
        
        if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
}