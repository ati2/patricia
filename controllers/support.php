<?php
class Support extends CI_Controller {
	public function index(){  //main listing page
		$data['temp']="hi";
		$this->load->view('support/main',$data);
	}
	public function start(){  //main listing page
		$data['temp']="hi";
		$this->load->view('support/getStarted',$data);
	}
	public function app(){  //main listing page
		$data['temp']="hi";
		$this->load->view('support/appGuide',$data);
	}
	public function ethos(){  //main listing page
		$data['temp']="hi";
		$this->load->view('support/ethos',$data);
	}

}

?>