<?php
class Reminder_m extends CI_Model{

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

	public function checkadmit()
	{
			$this->db->where("tok_status","Open");
			$this->db->where("tok_reg_status","Admit");
			$query = $this->db->get("tokens");

			return $query->result();
	}

	function getDrugsbyTokenID($id){
 
			$this->db->select('token_drugs.*,drugs.dru_name,drug_types.type');
			$this->db->join('drugs','token_drugs.drug_id=drugs.id','left');
			$this->db->join('drug_types','token_drugs.drugtype_id=drug_types.id', 'left');
			$this->db->where('token_drugs.token_id' , $id);
			$this->db->order_by('token_drugs.id', 'DESC');
	    $query = $this->db->get('token_drugs');
	 			return $query->result();

			//
			//
			// $this->db->select('`token_drugs`.`token_id`,
			//          `token_drugs`.`id`,
			//          `token_drugs`.`start_time`,
			//          `token_drugs`.`per_time`,
			//          `token_drugs`.`timerate`,
			//          `token_drugs`.`quantity`,
			//          `token_drugs`.`given_doc_id`,
			//          `token_drugs`.`note`,
			//          `token_drugs`.`drug_status`,
			//          `token_drugs`.`stoped_doc_id`,
			//          `token_drugs`.`added_date`,
			//          `drug_types`.`type`,
			//          `drugs`.`dru_name`,
			//          `tokens`.`tok_added_time`,
			//          `tokens`.`tok_reg_time`,
			//          `tokens`.`tok_status`,
			//          `tokens`.`tok_end_time`,
			//          `tokens`.`tok_reg_status`,
			//          `patient`.`pat_name`,
			//          `ward`.`war_name`,
			//          `bed`.`bed_number`
			// 				 `token_drugs` ');
			//
			// $this->db->join('`tokens`','`token_drugs`.`token_id` = `tokens`.`tok_number`','inner');
			// $this->db->join('drugs','`token_drugs`.`drug_id` = `drugs`.`id`','inner');
			// $this->db->join('drug_types','`token_drugs`.`drug_id` = `drugs`.`id`','left');
			// $this->db->join('patient','`patient`.`id` = `tokens`.`tok_patient_id`','left');
			// $this->db->join('ward','`ward`.`id` = `tokens`.`tok_ward_id`','left');
			// $this->db->join('bed','`bed`.`id` = `tokens`.`tok_bed_id`','left');
			// $this->db->where('token_id' , $id);
			// $this->db->order_by('token_drugs.id', 'DESC');
	    // $query = $this->db->get('token_drugs');
	 	// 		return $query->result();
	}

}
