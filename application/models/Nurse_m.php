<?php 
class Nurse_m extends CI_Model{
    public function getnurselist(){
		$nurs = $this->db->get('nurse');
		return $nurs->result();
	}

}