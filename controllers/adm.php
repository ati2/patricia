<?php
class Adm extends CI_Controller {
	public function index(){  //main listing page
		$this->load->model('Adm_model');

		$data['newCount']=$this->Adm_model->newUsr();
		$data['newCount']=$data['newCount']['new_count'];

		$data['attendance']=$this->Adm_model->attendance();
		$data['attendance']=$data['attendance']['count'];

		$data['haveMet']=$this->Adm_model->submitted();
		$data['haveMet']=$data['haveMet']['count'];

		$data['late']=$this->Adm_model->late();
		$data['late']=$data['late']['count'];

		$data['consistent']=$this->Adm_model->consistent();
		$data['consistent']=$data['consistent']['count'];

		$data['missing']=$this->Adm_model->missing();
		$data['missing']=$data['missing']['count'];

		$data['former']=$this->Adm_model->former();
		$data['former']=$data['former']['count'];

		$data['updated']=$this->Adm_model->groupChanges();
		$data['updated']=$data['updated']['count'];

		$this->load->view('adm/overview',$data);
	}
	public function usr($error=""){
		$this->load->model('Usr_model');

		$data['pagetype']="add";
		$data['search'] = '';
		$data['term'] = '';
		$data['notValidName']='';
		$data['error'] = $error;	

		$searchTerm = $this->input->post('inputs');
		if($searchTerm!=''||$searchTerm!=null){		
			$data['term'] = $searchTerm;
			$data['search'] = $this->Usr_model->addSearch($searchTerm);
		}

		$data['sgoData'] = $this->Usr_model->getSGO($id);
		$tempLeader = $this->Usr_model->getUsr($data['sgoData']['leader_uid']);
		$data['sgoData']['leader_uid'] = ($tempLeader==false?'none':array($tempLeader['uid'],$tempLeader['fname']));

		$this->load->view('adm/usr',$data);
	}
	public function usrList($action=NULL){
		$this->load->model('Adm_model');
		$data['listing']="";
		if(!isset($action)){
			$data['listing']=$this->Adm_model->defaultList();
		}else{
			switch($action){
				case "attendance":
					$data['listing']=$this->Adm_model->attendanceList();
					break;
				case "new";
					$data['listing']=$this->Adm_model->newUsrList();
					break;
				case "consistent";
					$data['listing']=$this->Adm_model->consistentList();
					break;
				case "former";
					$data['listing']=$this->Adm_model->formerList();
					break;
				case "missing";
					$data['listing']=$this->Adm_model->missingList();
					break;
				default:
					$data['listing']=$this->Adm_model->defaultList();
					break;
			}
		}
		$this->load->view('adm/usrListing',$data);
	}
	public function usrdata($uid){
		$this->load->model('Usr_model');
		$this->load->model('Adm_model');
		$dupeArray;
		$data['usr'] = $this->Usr_model->getUsr($uid);
		$data['leaderData'] = $this->Adm_model->isLeader($uid);
		if(!($data['leaderData'])==""){
		for($i=0;$i<count($data['leaderData']);$i++){
			$grp=$data['leaderData'][$i];
			$usr=$this->Usr_model->getUsr($grp[1]);
			$dupeArray[]=$grp[1];
			$data['leaderData'][$i][2]=$usr['fname'];
		}
		$dupeArray=array_count_values($dupeArray);
		for($j=0;$j<count($data['leaderData']);$j++){
			$usrId=$data['leaderData'][$j][1];
			$data['leaderData'][$j][3]=($dupeArray[$usrId]>1)?1:0;
		}		
		}
		$data['uid']=$uid;
		$data['history']=$this->Adm_model->history($uid);
		$this->load->view('adm/usrManager',$data);
	}
	public function plot(){
		$this->load->model('Usr_model');
		$this->load->model('Adm_model');

		$data['ageInput']=(!isset($_POST['ageInput']))?1:$_POST['ageInput'];
		$data['genderInput']=(!isset($_POST['genderInput']))?1:$_POST['genderInput'];
		$data['dayInput']=(!isset($_POST['dayInput']))?1:$_POST['dayInput'];
		
		$groupData = $this->Adm_model->uniqueData();
		$data['days']=$groupData['day'];
		$data['genders']=$groupData['gender'];
		$data['ages']=$groupData['age'];
		$this->load->view('adm/mapview.php',$data);		
	}
	public function plottest($age,$gender,$day){
		$this->load->model('Usr_model');
		$this->load->model('Adm_model');
		
		$groupData = $this->Adm_model->getGroups($age,$gender,$day);
		for($i=0;$i<count($groupData);$i++){
			$leader=$this->Usr_model->getUsr($groupData[$i]['leader_uid']);
			$groupData[$i]['leader']=$leader['fname']." ".$leader['lname'];
		}

		$data['groupData']=$groupData;
		$this->load->view('adm/mapdata.php',$data);		
	}

}

?>