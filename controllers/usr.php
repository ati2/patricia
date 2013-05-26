<?php
class Usr extends CI_Controller {
	public function index(){  //main listing page
		$this->load->model('Usr_model');
		$this->load->model('Data_model');
		$this->Usr_model->checkSession();
				
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');

		$data['pagetype']="index";
		$sgo = $this->Usr_model->getSGO($id);
		$data['sgoData'] = $sgo;
		$cookieDat = $this->Usr_model->getListCookie();
		$data['users'] = $this->Usr_model->getPeopleBy($cookieDat,$id);
		$days = (date('w') - $sgo['date']);

		$days+=($sgo['date']<=date('w')?0:7);
		$date1 = $subDate = date('Y-m-d', strtotime('-'.$days.' days'));
		$data['date'] = $date1;

		$data['graph'] = $this->Data_model->getLast(8,$id);

		$tempLeader = $this->Usr_model->getUsr($data['sgoData']['leader_uid']);
		$data['sgoData']['leader_uid'] = ($tempLeader==false?'none':array($tempLeader['uid'],$tempLeader['fname']));


		$this->loadView('usr_listing',$data);
	}
	public function submitCount(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();

		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['pagetype']="submitCount";
		$sgo = $this->Usr_model->getSGO($id);
		$this->Usr_model->resetListCookie($id);

		$this->Usr_model->submitCount($sgo['date'],$id);

		$this->load->view('usr_submit',$data);

	}
	public function add($error=""){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();	
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
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

		$this->loadView('usr_add',$data);

	}
	public function submitAdd($key){
		$this->load->model('Usr_model');
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['pagetype']="submitAdd";	
		$this->Usr_model->unBlackList($id,$key);
		$listing = $this->Usr_model->getListCookie();

		$listing[$key] = '1';

		$this->Usr_model->makeListCookie($listing);
		redirect('http://theninthbit.us/sgo/usr/',"refresh");
	}

	public function submitNewUsr(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['pagetype']="submitNewUsr";
		$newUid = $this->Usr_model->addNewUser($id);
	

		if(!$newUid==false){
			$this->submitAdd($newUid);
		}
		redirect('http://theninthbit.us/sgo/usr/add/error',"refresh");
	}

	public function settings(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');

		$cookieDat = $this->Usr_model->getListCookie();
		$data['users'] = $this->Usr_model->getPeopleBy($cookieDat,$id);
		$data['sgoData'] = $this->Usr_model->getSgo($id);
		$data['pagetype']="settings";		
		$tempLeader = $this->Usr_model->getUsr($data['sgoData']['leader_uid']);
		$tempApr = $this->Usr_model->getUsr($data['sgoData']['apr_uid']);
		$tempAssist = $this->Usr_model->getUsr($data['sgoData']['assist_uid']);

		$data['sgoData']['leader_uid'] = ($tempLeader==false?'none':array($tempLeader['uid'],$tempLeader['fname']));
		$data['sgoData']['apr_uid'] = ($tempApr==false?'none':array($tempApr['uid'],$tempApr['fname']));
		$data['sgoData']['assist_uid'] = ($tempAssist==false?'none':array($tempAssist['uid'],$tempAssist['fname']));

		$this->loadView('usr_setting',$data);
		
	}
	public function submitSetting(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['pagetype']="submitSetting";
		$this->Usr_model->inputSgo($id);
		redirect('http://theninthbit.us/sgo/usr/',"refresh");
	}
	public function submitLatLong(){
		$this->load->model('Usr_model');
		$id = $this->session->userdata('username');
		$this->Usr_model->inputLatLong($id);
		$data['pagetype']="submitLatLong";
	}
	public function mobile(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();
		$id = $this->session->userdata('username');
		$isMobile = !$this->session->userdata('mobile');
		$this->session->set_userdata('mobile',$isMobile);
		$data['pagetype']="mobile";
		redirect('http://theninthbit.us/sgo/usr/',"refresh");
	}
	public function msg(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();

		$data['pagetype']="msg";
		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		
		$data['sgoData'] = $this->Usr_model->getSGO($id);
		$tempLeader = $this->Usr_model->getUsr($data['sgoData']['leader_uid']);
		$data['sgoData']['leader_uid'] = ($tempLeader==false?'none':array($tempLeader['uid'],$tempLeader['fname']));


		$this->loadView('usr_msg',$data);		
	}
	public function submitMsg(){
		$this->load->model('Usr_model');
		$this->Usr_model->checkSession();

		$id = $this->session->userdata('username');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['pagetype']="submitMsg";
		$subject = $this->input->post('subject');
		$body = $this->input->post('body');
		$body = ($body==null?"":$body);
		$recipient = "math2.7182@gmail.com";

		$id = $this->session->userdata('username');
		mail($recipient,$subject,$body."from".$id);

		$this->load->view('usr_submit',$data);
		
	}
		private function loadView($view,$data){
			if($data['mobile']){
				$this->load->view('mobile/'.$view,$data);
			}else{
				$this->load->view('full/'.$view,$data);
			}
		}
	public function logout(){
		$this->load->model('Usr_model');
		$this->Usr_model->clearCookie();
		$this->session->sess_destroy();
		$data['pagetype']="logout";		
		redirect('http://theninthbit.us/sgo/login/',"refresh");


	}
}

?>