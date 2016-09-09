<?php
class Dashboard_m extends CI_Model{

	public function tokens(){
		$docs = $this->db->get('tokens');
		return $docs->row();
	}

	public function druglevel(){
		$query = $this->db->query("SELECT drug_stock.*,drugs.dru_name,ward.war_name 
									FROM drug_stock 
									inner join drugs on drugs.id=drug_stock.drug_id 
									inner join ward on ward.id=drug_stock.ward_id 
									where min_level>quantity");
		return $query->result();
	}

}