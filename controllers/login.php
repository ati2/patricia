<?php
class Login extends CI_Controller {
	public function index(){
		$this->load->view('login_view');
	}
	public function submit() {


	$this->load->library('user_agent');
	$isMobile = $this->agent->is_mobile();

		$this->load->model('Usr_model');
		$sgoId = $this->input->post('username');
  		$pwd = $this->input->post('password');

  		if ( $this->Usr_model->groupExists($sgoId)  && $pwd == "password" )  {
			$this->session->set_userdata('logged_in',TRUE);
			$this->session->set_userdata('username',$sgoId);
			$this->session->set_userdata('mobile',$isMobile);

			$users = $this->Usr_model->getPeopleIn($sgoId); //get users from group
			if(!$users){ //there are no people in group,
				$sgoData = $this->Usr_model->getSgo($sgoId);
				$users= array( $sgoData['leader_uid']=>0);
			}
			$this->Usr_model->makeListCookie($users);	//set users to cookie

			redirect('http://theninthbit.us/sgo/usr/',"refresh");
		} else {
			redirect('http://theninthbit.us/sgo/login',"refresh");
  		}
	}

}
?>