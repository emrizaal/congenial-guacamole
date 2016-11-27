<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "mosque";
		$this->load->model("m_auth");
	}

	public function index(){
		$this->load->view('login');
	}

	public function auth(){
		$p=$this->input->post();
		$res=$this->m_auth->auth($p);
		$error['error']=true;
		if($res){
			$data=array(
				'id_mosque' => $res['id_mosque'],
				'name' => $res['name']
				);
			$this->session->set_userdata($data);
			redirect('dashboard');
		}else{
			$this->load->view('login',$error);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("auth");
	}

}

?>
