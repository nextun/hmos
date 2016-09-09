<?php
class Tokens_m extends CI_Model{


	public function getlist(){
		$this->db->select('tokens.*, bed.bed_number,ward.war_name');
		$this->db->join('bed','bed.id=tokens.tok_bed_id', 'left');
		$this->db->join('ward','ward.id=tokens.tok_ward_id','left');
		$tokens = $this->db->get('tokens');

		return $tokens->result();
	}

	public function inserdoc(){

	}

	function getbyid($id){

        $query = $this->db->where('id' , $id);
        $query = $this->db->get('tokens' , 'DESC');

        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
    }
	function getTokenStatus($id){

        $query = $this->db->where('tok_number' , $id);
        $query = $this->db->get('tokens' , 'DESC');

        if($query->num_rows()>0){
			return $query->row()->tok_status;
		}else{
			return false;
		}
    }

	function patentDetails($tok_number){
		$this->db->select('patient.*,tokens.tok_ward_id,tokens.tok_bed_id,tokens.tok_end_time');
		$this->db->join('tokens','tokens.tok_patient_id=patient.id');
		$query = $this->db->where('tokens.tok_number' , $tok_number);
        $query = $this->db->get('patient' , 'DESC');

        if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	function getTokenInfo($id){
		$query = $this->db->where('token_id' , $id);
        $query = $this->db->get('token_info' , 'DESC');

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

	}

	function getWard_hasbed(){
		$query = $this->db->where('ward.war_status' , "Active");
		$query = $this->db->get('ward' , 'DESC');
			return $query->result();
	}

	function gethasbed($wardid){
		$query = $this->db->query("SELECT bed.bed_number,bed.id
								  FROM bed
								  join ward on ward.id=bed.bed_ward_id
								  WHERE NOT EXISTS (SELECT * FROM tokens WHERE tokens.tok_bed_id=bed.id  and tokens.tok_ward_id=bed.bed_ward_id and tokens.tok_status='Open'  ) and bed_ward_id=".$wardid." ");

			return $query->result();
	}
}
