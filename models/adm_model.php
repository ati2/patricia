<?php
class Adm_model extends CI_Model {
	function adm_model(){
		$this->load->helper('url');
	}

/* *********************** SummaryBit ****************************** */
	
	function attendance(){		//all who attended in the past week
		$this->load->database();
		$queryString = '
			select count(DISTINCT `uid`) as count
			from USR_SGO
			where `date` >= DATE(NOW() - INTERVAL 1 WEEK)';

		$query = $this->db->query($queryString); 
		return $query->row_array();
	}

	function newUsr(){		//has not attended before this week
		$this->load->database();
		$queryString = '
			select count(`uid`) as new_count
			from (
				select `uid`,`date`,count(`uid`) as CT
				from USR_SGO	
				group by `uid`
				having CT=1
			)as newUsrs
			where `date` >= DATE(NOW() - INTERVAL 1 WEEK)';

		$query = $this->db->query($queryString); 
		return $query->row_array();
	}

	function consistent(){		//attends >7x in 2 months but was missing this week
		$this->load->database();
		$queryString = '
			select count(consistent.uid) as count
			from(
				select `uid`, count(`uid`)
				from USR_SGO
				where `date`>=DATE(NOW() - INTERVAL 2 MONTH)
				group by `uid`
				having count(`uid`)>=7
			) as consistent
			left join (
				select DISTINCT `uid`
				from USR_SGO
				where `date`>=DATE(NOW() - INTERVAL 1 WEEK)
			) as lastweek 
			on consistent.uid=lastweek.uid
			where lastweek.uid is null';
		$query = $this->db->query($queryString); 
		return $query->row_array();
	}

	function former(){ 		//attended this week but not in the past 2 months
		$this->load->database();
		$queryString = '
			select count(missing.uid) as count
			from(
				select `uid`, count(`uid`)
				from USR_SGO
				where `date` between DATE(NOW() - INTERVAL 2 MONTH)
				and DATE(NOW() - INTERVAL 1 WEEK)
				group by `uid`
				having count(`uid`)<=1
			) as missing
			inner join(
				select DISTINCT `uid`
				from USR_SGO
				where `date`>=DATE(NOW() - INTERVAL 1 WEEK)
			)  as lastweek
			on missing.uid=lastweek.uid';
		$query = $this->db->query($queryString); 
		return $query->row_array();
	}

	function missing(){		//attended >once in the past 3months ago but not in the past month
		$this->load->database();
		$queryString = '
			select count(`uid`) as count
			from(
				select `uid`, count(`uid`)
				from USR_SGO
				where `date` between DATE(NOW() - INTERVAL 3 MONTH)
				and DATE(NOW() - INTERVAL 1 MONTH)
				group by `uid`
				having count(`uid`)>1
			) as history
			where uid not IN (
				select `uid`
				from USR_SGO
				where `date`>=DATE(NOW() - INTERVAL 1 MONTH)
				group by `uid`
				having count(`uid`)>1
			)';
		$query = $this->db->query($queryString); 
		return $query->row_array();
	}
		
	function submitted(){
		$this->load->database();
		$queryString = '
			select count(DISTINCT `sgo_id`) as count
			from USR_SGO
			where `date` >= DATE(NOW() - INTERVAL 1 WEEK)';

		$query = $this->db->query($queryString); 
		return $query->row_array();
	}

	function late(){
		$this->load->database();
		$queryString = '
			select count(SGO.sgo_id) as count
			from SGO
			left join (
				select `sgo_id`
				from USR_SGO	
				where `date` >= DATE(NOW() - INTERVAL 1 WEEK)
			)as log
			on log.sgo_id = SGO.sgo_id
			where log.sgo_id is null';

		$query = $this->db->query($queryString); 
		return $query->row_array();
	}
	function groupChanges(){
		$this->load->database();
		$queryString = '
			SELECT count(`sgo_id`) as count
			from SGO
			where `update`>=DATE(NOW() - INTERVAL 1 WEEK)';
		$query = $this->db->query($queryString); 
		return $query->row_array();
	}
/* *********************** UserListing ****************************** */
	function defaultList(){
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			limit 0,50';
		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;

	}
	function attendanceList(){
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			left join (
				select DISTINCT `uid`
				from USR_SGO
				where `date` >= DATE(NOW() - INTERVAL 1 WEEK)
			) as attendees
			on attendees.uid=USR.uid
			where attendees.uid IS NOT null
			limit 0,50';

		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;
	}

	function newUsrList(){
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			left join (
				select `uid`,`date`,count(`uid`) as CT
				from USR_SGO	
				group by `uid`
				having CT=1 and `date` >= DATE(NOW() - INTERVAL 1 WEEK)
			)as newUsr
			on newUsr.uid=USR.uid
			where newUsr.uid IS NOT null
			limit 0,50';

		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;
	}
	function consistentList(){		//attends >7x in 2 months but was missing this week
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			left join (
				select (consistent.uid)
				from(
					select `uid`, count(`uid`)
					from USR_SGO
					where `date`>=DATE(NOW() - INTERVAL 2 MONTH)
					group by `uid`
					having count(`uid`)>=7
				) as consistent
				left join (
					select DISTINCT `uid`
					from USR_SGO
					where `date`>=DATE(NOW() - INTERVAL 1 WEEK)
				) as lastweek 
				on consistent.uid=lastweek.uid
				where lastweek.uid is null
			)as consistentUsrs
			on consistentUsrs.uid=USR.uid
			where consistentUsrs.uid IS NOT null
			limit 0,50';

		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;
	}

	function formerList(){ 		//attended this week but not in the past 2 months
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			left join (
				select (missing.uid)
				from(
					select `uid`, count(`uid`)
					from USR_SGO
					where `date` between DATE(NOW() - INTERVAL 2 MONTH)
					and DATE(NOW() - INTERVAL 1 WEEK)
					group by `uid`
					having count(`uid`)<=1
				) as missing
				inner join(
					select DISTINCT `uid`
					from USR_SGO
					where `date`>=DATE(NOW() - INTERVAL 1 WEEK)
				)  as lastweek
				on missing.uid=lastweek.uid
			)as formerUsrs
			on formerUsrs.uid=USR.uid
			where formerUsrs.uid IS NOT null
			limit 0,50';

		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;
	}

	function missingList(){		//attended >once in the past 3months ago but not in the past month
		$output="";
		$this->load->database();
		$queryString = '
			select *
			from USR
			left join (
				select (`uid`)
				from(
					select `uid`, count(`uid`)
					from USR_SGO
					where `date` between DATE(NOW() - INTERVAL 3 MONTH)
					and DATE(NOW() - INTERVAL 1 MONTH)
					group by `uid`
					having count(`uid`)>1
				) as history
				where uid not IN (
					select `uid`
					from USR_SGO
					where `date`>=DATE(NOW() - INTERVAL 1 MONTH)
					group by `uid`
					having count(`uid`)>1
				)
			)as missingUsr
			on missingUsr.uid=USR.uid
			where missingUsr.uid IS NOT null
			limit 0,50';

		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->uid,$row->fname,$row->lname);
		}
		return $output;
	}

/* *********************** UserManager ****************************** */
	//function getUsr($id) //from UsrModel

	function isLeader($uid){
		$output="";
		$this->load->database();
		$query = $this->db->query('SELECT * FROM SGO WHERE leader_uid="'.$uid.'" OR `apr_uid`="'.$uid.'" OR `assist_uid`="'.$uid.'"'); 
		if( count( $query->result())>0){
		foreach($query->result() as $row){
			$output[]=array($row->sgo_id,$row->leader_uid);
		}
		}
		return $output;
	}
	function history($uid){
		$this->load->datatbase();
		$output="";
		$queryString = '
			SELECT USR.fname, USR_SGO.date
			FROM USR, SGO, USR_SGO
			WHERE USR_SGO.uid =  "'.$uid.'"
			AND SGO.sgo_id = USR_SGO.sgo_id
			AND USR.uid = SGO.leader_uid
			GROUP BY SGO.leader_uid, USR_SGO.date
			ORDER BY USR_SGO.date DESC 
			LIMIT 0 , 30';
		$query = $this->db->query($queryString); 
		foreach($query->result() as $row){
			$output[]=array($row->fname,$row->date);
		}
		return $output;

	}
	function changeUsr(){
		$this->load->database();
		$data['fname'] = $this->input->get('fname');
		$data['lname'] = $this->input->get('lname');
		$this->db->where('uid',$uid);
		$this->db->update('USR',$data);
	}
/* ************************* Map Plot ******************************** */
	function getGroups($age,$gender,$day){
		$this->load->database();
		$output="";
		$additionalQueryTerms='`active`=1'; //group is active

		//1 is the default initialized value
		$additionalQueryTerms.=($age==1)?'':' AND `age`="'.str_replace('_',' ',$age).'"';
		$additionalQueryTerms.=($gender==1)?'':' AND `gender`="'.$gender.'"';
		$days=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$additionalQueryTerms.=($day==1)?'':' AND `date`="'.array_search($day,$days).'"';

		$query = $this->db->query('SELECT * FROM SGO WHERE '.$additionalQueryTerms); 
		foreach($query->result_array() as $row){
			$output[]=$row;
		}		
		return $output;
		
	}
		function uniqueData(){
			$output="";
			$this->load->database();
			$query = $this->db->query('SELECT `age`,`active`,`lat` FROM`SGO` GROUP BY `age` HAVING `age` != "" AND `active`="1" AND `lat`!=0'); 
			foreach($query->result_array() as $row){
				$output['age'][]=$row['age'];
			}
			$query2 = $this->db->query('SELECT `gender`,`active`,`lat` FROM`SGO` GROUP BY `gender` HAVING `gender` != "" AND `active`="1" AND `lat` !=0');
			foreach($query2->result_array() as $row2){
				$output['gender'][]=$row2['gender'];
			}

			$days=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
			$query3 = $this->db->query('SELECT `date`,`active`,`lat` FROM`SGO` GROUP BY `date` HAVING `date` != "" AND `active`="1" AND `lat`!=0'); 
			foreach($query3->result_array() as $row3){
				$output['day'][]=$days[$row3['date']];
			}

			return $output;
		}
		
}
?>