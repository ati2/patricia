<?php
class Data_model extends CI_Model {
	function data_model(){
		$this->load->helper('url');
	}
	function getLast($limit,$gid){
		$date = date('Y-m-d',strtotime('Sunday -'.$limit.' weeks'));

		$query = $this->db->query("SELECT date,sgo_id,uid,rid FROM USR_SGO WHERE `sgo_id` = '".$gid."' AND date > '".$date."' ORDER BY date DESC");
		if($query->num_rows()>0){
			$meets = array();
			foreach($query->result() as $row){
				if(!isset($meets[$row->date])){
					$meets[$row->date] = array($row->uid => $row->uid);
				}else{
					$meets[$row->date][$row->uid] = $row->uid;
				}
			}

			return array_reverse($meets,true);
		}else{
			return false;
		}
	}
	function generateRandomColor(){
		$randomcolor = '#' . strtoupper(dechex(rand(0,10000000)));
		if (strlen($randomcolor) != 7){
			$randomcolor = str_pad($randomcolor, 10, '0', STR_PAD_RIGHT);
			$randomcolor = substr($randomcolor,0,7);
		}
		return $randomcolor;
	}

}

?>