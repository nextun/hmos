<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends HMS_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('Tokens_m');
		$this->load->model('Reminder_m');
		$this->load->model('Patient_m');
		$this->load->model('Drugs_m');
		$this->load->helper('date');
		$this->load->model('dashboard_m');
		//_is_logged_in
	}

  public function index()
  {
		$open_admit = $this->Reminder_m->checkadmit();
		$now 	= mdate("%Y-%m-%d %H:%i:%s", time());
		$next_drugs  = array();
		$x = 0;
		foreach ($open_admit as $admit) {
					$admited_time = $admit->tok_reg_time;
					$token_created_time = $admit->tok_added_time;

					$token_number = $admit->tok_number;

					$token_drugs_list = $this->Reminder_m->getDrugsbyTokenID($token_number);
					$i =0;
					foreach ($token_drugs_list as $drugs_list) {
							if($drugs_list->drug_status == 'Active'){
								if($drugs_list->start_time == '0000-00-00 00:00:00'){

										$admited_time_span 	= human_to_unix($drugs_list->added_date);

										$now_time_span 			= human_to_unix($now);

										$update_time = $drugs_list->added_date;

									}else{
										$admited_time_span 	= human_to_unix($drugs_list->update_time);

										$now_time_span 			= human_to_unix($now);

										$update_time = $drugs_list->update_time;

									}

										if($drugs_list->timerate == 'daily'){
											$day_hours = 24;
											$time_range = $day_hours / $drugs_list->per_time;
										}
										elseif ($drugs_list->timerate == 'hourly') {
											$time_range = $drugs_list->per_time;
										}

										$time_range = "+".$time_range." hours";
										//+5 hours
										$next_time = strtotime($time_range, strtotime( $update_time ));

										//$data['next_time'] =$next_time;
										//$data["time_range"] = " <p>Now time ".$now."</p><p>Drug Addred Time ".$drugs_list->added_date."</p><p>Drug Range ".$time_range. "</p><p> Next time will be ".mdate("%Y-%m-%d %H:%i:%s",$next_time)."</p>";
										//$data["next_time"] = //timespan($now_time_span,$next_time);

										if($now_time_span > $next_time){

												$next_drugs[$x][$i]["next_time"] = "<span class=' text-danger'>". timespan($next_time , $now_time_span) . " ago !</span>";
										}else{
												$next_drugs[$x][$i]["next_time"] =  "<span class=' text-warning'>".timespan($now_time_span,$next_time)."</span>";
										}

										//$next_drugs[$i]["next_time"] =  timespan($now_time_span,$next_time);

										$next_drugs[$x][$i]["token_drug_id"] =  $drugs_list->id;
										$next_drugs[$x][$i]["token_id"] =  $drugs_list->token_id;
										$next_drugs[$x][$i]["timerate"] =  $drugs_list->timerate;
										$next_drugs[$x][$i]["per_time"] =  $drugs_list->per_time;
										$next_drugs[$x][$i]["quantity"] =  $drugs_list->quantity;
										$next_drugs[$x][$i]["type"] =  $drugs_list->type;
										$next_drugs[$x][$i]["dru_name"] =  $drugs_list->dru_name;
										$next_drugs[$x][$i]["added_date"] =  $drugs_list->added_date;
										$next_drugs[$x][$i]["time_range"] = $time_range;
										$next_drugs[$x][$i]["now"] = $now;
										$next_drugs[$x][$i]["next"] = mdate("%Y-%m-%d %H:%i:%s", $next_time);


										$i++;

							}

					}
						$x++;

		}


 	//$nexts  = $this->aasort($next_drugs,"next");
//	$nexts = usort($next_drugs, "compMatchPoints");
	usort($next_drugs,function($a,$b){
	     return $a[0]['next_time']-$b[0]['next_time'];
	});
	//var_dump($next_drugs);
	//	$next_drugs = $this->sortArray( $next_drugs, 'next' );
		//usort($next_drugs, function($a, $b){return $a[0]["next"] - $b[0]["next"];});
		// usort($next_drugs, function($a, $b){
		//     $a = strtotime($a['Conversation']['next']);
		//     $b = strtotime($b['Conversation']['next']);
		//
		//     if ($a == $b) {
		//         return 0;
		//     }
		//     return ($a > $b) ? -1 : 1;
		// });

		$data["next_drugs"] = $next_drugs;
		//$data["query"] = $this->db->last_query();
		$this->load->view('reminder/index', $data);
	  }

		function compMatchPoints($a, $b) {
      return $a[0]["next"] - $b[0]["next"];
 		}


		function aasort (&$array, $key) {
		    $sorter=array();
		    $ret=array();
		    reset($array);
		    foreach ($array as $ii => $va) {
						foreach ($va as $k => $val) {
							$sorter[$k]=$val[$key];
						}

		    }
		    asort($sorter);
		    foreach ($sorter as $ii => $va) {
		        $ret[$ii]=$array[$ii];
		    }
		    $array=$ret;
		}

	static function sortArray( $data, $field ) {
	    $field = (array) $field;
	    uasort( $data, function($a, $b) use($field) {
	        $retval = 0;
	        foreach( $field as $fieldname ) {
	            if( $retval == 0 ) $retval = strnatcmp( $a[$fieldname], $b[$fieldname] );
	        }
	        return $retval;
	    } );
	    return $data;
	}

	public function update($id)
	{
		$open_admit = $this->Reminder_m->checkadmit();
		$now 	= mdate("%Y-%m-%d %H:%i:%s", time());
		$next_drugs  = array();

		if ($id!=NULL) {
			$this->db->where('id', $id);
			$query = $this->db->get('token_drugs');
			//var_dump($this->db->last_query());
			if($query->num_rows()>0){
				$token_drug =  $query->row();

				$data['current_tokenid'] = $this->session->userdata('current_tokenid');

				if($token_drug->start_time== '0000-00-00 00:00:00'){
							$updatedata = array(
								'start_time' => mdate("%Y-%m-%d %H:%i:%s", time()),
								'update_time' => mdate("%Y-%m-%d %H:%i:%s", time())
							);
				}else{
					$updatedata = array(
								'update_time' => mdate("%Y-%m-%d %H:%i:%s", time())
							);
				}
				$this->db->where('token_id', $token_drug->token_id);
				$this->db->where('id', $id);
				$this->db->update('token_drugs', $updatedata);

				$insertdata = array(
							'token_id'  	=> $token_drug->token_id,
							'token_drug_id'   	=> $token_drug->drug_id,
							'nurse_id'		=>  $this->session->userdata('id'),
							'submit_time' 		=> mdate("%Y-%m-%d %H:%i:%s", time()),
						);

				$this->db->insert('token_nurse_drug',$insertdata);
				$this->session->set_flashdata('success_msg', 'Successfully updated.');

			}else {
				$data['error'] = "data not found";
			}

			$token_drugs_list = $this->Reminder_m->getDrugsbyTokenID($token_drug->token_id);
			//var_dump($this->db->last_query());
			$i =0;
			foreach ($token_drugs_list as $drugs_list) {
					if($drugs_list->drug_status == 'Active'){
						if($drugs_list->start_time == '0000-00-00 00:00:00'){

								$admited_time_span 	= human_to_unix($drugs_list->added_date);
								$now_time_span 			= human_to_unix($now);

								if($drugs_list->timerate == 'daily'){
									$day_hours = 24;
									$time_range = $day_hours / $drugs_list->per_time;
								}
								elseif ($drugs_list->timerate == 'hourly') {
									$time_range = $drugs_list->per_time;
								}

								$time_range = "+".$time_range." hours";
								$next_time = strtotime($time_range, strtotime( $drugs_list->added_date ));

								if($now_time_span > $next_time){

										$next_drugs[$i]["next_time"] = "<span class=' text-danger'>". timespan($next_time , $now_time_span) . " ago !</span>";
								}else{
										$next_drugs[$i]["next_time"] =  "<span class=' text-warning'>".timespan($now_time_span,$next_time)."</span>";
								}
								$next_drugs[$i]["token_drug_id"] =  $drugs_list->id;
								$next_drugs[$i]["token_id"] =  $drugs_list->token_id;
								$next_drugs[$i]["timerate"] =  $drugs_list->timerate;
								$next_drugs[$i]["per_time"] =  $drugs_list->per_time;
								$next_drugs[$i]["quantity"] =  $drugs_list->quantity;
								$next_drugs[$i]["type"] =  $drugs_list->type;
								$next_drugs[$i]["dru_name"] =  $drugs_list->dru_name;
								$next_drugs[$i]["added_date"] =  $drugs_list->added_date;
								$next_drugs[$i]["time_range"] = $time_range;
								$next_drugs[$i]["now"] = $now;
								$next_drugs[$i]["next"] = mdate("%Y-%m-%d %H:%i:%s", $next_time);

								$i++;

						}
					}
				}


		}

		$data["next_drugs"] = $next_drugs;
		$this->load->view('reminder/update', $data);
	}
}
