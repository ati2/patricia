<?php
class Usr_model extends CI_Model {
	function usr_model(){
		$this->load->helper('url');
	}
	function pageData($links){
		$this->load->library('usr_menu');
		$menu = new usr_menu;
		$menuText = $menu->build_menu($links);
	
		return $menuText;
	}
/* *********************** session ****************************** */
	function checkSession(){
		if ( $this->session->userdata('username') == FALSE ) {
			redirect( "http://theninthbit.us/sgo/login/" );    // no session established, kick back to login page
		}
	}
	function makeListCookie($listing){
		 $this->load->helper('cookie');
		if(!$listing){
		}else{
			if(!get_cookie('ci_tempList')){   	//clear prev cookie
			}else{
				delete_cookie('ci_tempList');
			}

		 	$cookie = array( 			//set new cookie with array 
				'name'   => 'ci_tempList',
				'value'  => serialize($listing),
				'expire' => time()+86500
			);
			set_cookie($cookie);
		}

	}
	function resetListCookie($sgoId){
		$this->load->helper('cookie');
		delete_cookie('ci_tempList');

		$users = $this->Usr_model->getPeopleIn($sgoId); //get users from group
		$this->Usr_model->makeListCookie($users);	//set users to cookie
	}
	function getListCookie(){
		$this->load->helper('cookie');
		if(!get_cookie('ci_tempList')){ 
			return false;
		}else{
			return unserialize(get_cookie('ci_tempList'));	
		}
	}
	function clearCookie(){
		$this->load->helper('cookie');
		delete_cookie('ci_tempList');
	}

/* *********************** db functions ************************* */
	function submitCount($gdate,$gid){
		$submittedDate= $this->input->post('sgodate');
		$submittedArr = $this->input->post('users');
		if(is_array($submittedArr)){
			foreach($submittedArr as $user){
				$data = array(
					'uid' => $user,
					'sgo_id' => $gid,
					'date' => $submittedDate
				);
				$this->db->insert('USR_SGO',$data);
			}
		}else{
			$data = array(
				'uid' => '0',
				'sgo_id' => $gid,
				'date' => $submittedDate
			);
			$this->db->insert('USR_SGO',$data);
		}

	}
	function groupExists($username){
		$this->load->database();
		$query = $this->db->query("SELECT 1 FROM SGO WHERE `sgo_id` = '".$username."'");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function getSGO($id){
		$this->load->database();
		
		$query = $this->db->query('SELECT * FROM SGO WHERE `sgo_id` = "'.$id.'"'); 
		if($query->num_rows>0){
			$row = $query->row_array(0);
			return $row;
		}
	}
	function inputSgo($id){
		$this->load->database();


		$data['leader_uid'] = $this->input->post('leader');
		$data['apr_uid']  = $this->input->post('apprentice');
		$data['assist_uid']  = $this->input->post('assist');
		$data['date']  = $this->input->post('date');
		$data['location']  = $this->input->post('location');
		$data['age']  = $this->input->post('age');
		$data['gender']  = $this->input->post('gender');
		$data['time']  = $this->input->post('time');
		$data['update']  = date('Y-m-d', strtotime("now"));

		$this->db->where('sgo_id',$id);
		$this->db->update('SGO',$data);
		
	}
	function inputLatLong($id){
		$this->load->database();
		$data['lat'] = $this->input->get('latitude');
		$data['long'] = $this->input->get('longitude');
		$this->db->where('sgo_id',$id);
		$this->db->update('SGO',$data);
	}
	function getUsr($id){
		$this->load->database();
		
		$query = $this->db->query('SELECT * FROM USR WHERE `uid` = "'.$id.'"'); 
		if($query->num_rows>0){
			$row = $query->row_array(0);
			return $row;
		}
	}
	function getPeopleIn($sgoId){ 
		$this->load->database();
		$this->load->library('table');
		$tempMaxDate = date('Y-m-d', mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
		$query = $this->db->query("SELECT DISTINCT `uid` FROM `USR_SGO` WHERE sgo_id = '".$sgoId."' AND `date` > '".$tempMaxDate."'");
		if($query->num_rows()>0){
			$users = array();
			foreach($query->result() as $row){
				$users[ $row->uid ] = 0;
			}
			return $users;
		}else{
			return false;
		}
	}
	function getPeopleBy($uidCookieArr,$gid){
		$this->load->database();
		$this->load->helper('array');
		$toHide = $this->getBlackList($gid);
		$output=array();
		if(count($uidCookieArr)>0){
		foreach($uidCookieArr as $uid => $value){
			if(in_array($uid,$toHide)){
			}else{
				$query = $this->db->query("SELECT * FROM USR WHERE `uid` = ".$uid);
				if($query->num_rows()>0){
					foreach($query->result() as $row){
					$output[] = array($row->uid ,$row->fname ,$row->lname, $value);
					}
				}
			}

		}
		}
		return $output;
	}
	function addNewUser($gid){
		$this->load->database();
		$data = array(
			'fname' => $this->input->post('fname'), 
			'lname' => $this->input->post('lname'),  
			'lastSgo' => $gid
		);
		if($data['fname']==''||$data['lname']==''){
			return false;
		}
		$query = $this->db->query('SELECT `uid` FROM USR WHERE `fname` = "'.$data['fname'].'" AND `lname` = "'.$data['lname'].'"');
			if($query->num_rows() > 0){
				foreach($query->result() as $row){
					return $row->uid;
				}
			}

		if (!preg_match('/[^A-Za-z]/',$data['fname'])){
			$this->db->insert('USR',$data);
			$query = $this->db->query('SELECT `uid` FROM USR WHERE `fname` = "'.$data['fname'].'" AND `lname` = "'.$data['lname'].'" AND `lastSGO` = "'.$data['lastSgo'].'" LIMIT 1');
			if($query->num_rows() > 0){
				foreach($query->result() as $row){
					return $row->uid;
				}
			}
		}
		return false;
		
	}
	function blackList($sgo_id,$uid){
		$this->load->database();

		$checknum = 0;
		$data['sgo_id'] = $sgo_id;
		$data['uid'] = $checknum;


		$this->db->where('sgo_id',$sgo_id);
		$this->db->where('uid',$uid);
		$query = $this->db->get('BLACKLIST');
		$exists = ($query->num_rows()>0?true:false);
	
		$data['uid'] = $uid;
		if(!$exists){
			$this->db->insert('BLACKLIST',$data);
		}
	}
	function unBlackList($sgo_id,$uid){
		$this->load->database();
		$this->db->query('DELETE FROM `BLACKLIST` WHERE `sgo_id` = "'.$sgo_id.'" AND `uid` = "'.$uid.'"');

	}
	function getBlackList($sgo_id){
		$this->load->database();
		$output = array();
		$this->db->where('sgo_id',$sgo_id);
		$query = $this->db->get('BLACKLIST');
		if($query->num_rows()>0){
			foreach ($query->result() as $row){
				$output[] = $row->uid;
			}
		}
		return $output;
	}
	function addSearch($key){
		$key = preg_replace('#[^a-z A-Z]#', '', $key);

		$this->load->database();
		$keys = explode(" ",$key);
		$keys = array_slice($keys, 0, 3);


		$matches=array();
		foreach($keys as $tempKey){
			$query = $this->db->query("SELECT * FROM `USR` WHERE `fname` LIKE '%".$tempKey."%' OR `lname` LIKE '%".$tempKey."%' LIMIT 6");
			if($query->num_rows()>0){
				foreach($query->result() as $row){
					$matches[ $row->uid ] = array($row->fname,$row->lname,$row->lastSgo);
				}	
			}
		}
		return $this->userAssumptions($matches);
	}
		function userAssumptions($matches){
			$output = array();
			foreach($matches as $uid => $usrData){		//0=fname,1=lname,2=lastSgo
				$lastSgo = $this->getSGO($usrData[2]);
				$lastSgoLeader = $this->getUsr($lastSgo['leader_uid']);
				$output[$uid] = array($usrData[0],$usrData[1],$lastSgoLeader['fname'],$lastSgo['location'],$lastSgo['age'],$lastSgo['gender']);
				//output [search result] [0]fname [1]lname [2]leader [3]location [4]age [5]gender
			}
			return $output;
		}
}

?>