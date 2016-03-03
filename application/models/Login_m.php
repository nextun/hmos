<?php 
class Login_m extends CI_Model{

	function login(){
        
        $username = $this->input->post('username');
        $password = $this->encrypt($this->input->post('password'));
        $usertype = $this->input->post('usertype');
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('usertype', $usertype);
 
        $user = $this->db->get('users')->row();
            

		if(count($user)){
			//Log in User
			$data = array(
				'username' => $user->name,
				'id' => $user->id,
                'usertype' => $user->usertype,
                'ref_id' => $user->ref_id,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);

		}

	}
    
    function loggedin(){
		return (bool) $this->session->userdata('loggedin');
	}
    
    function logout(){
		$this->session->sess_destroy();
	}
    
	public function inserdoc(){

	}
    
    //password encrypt
    function encrypt($sting){
		return md5($sting . config_item('encryption_key'));

	}

}