<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mosque extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "mosque";
		$this->load->model("m_mosque");
	}

	public function editProfile($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/mosque/getMosqueById/'.$this->session->userdata('id_mosque')),true);
		$this->load->view("edit_profile",$data);
	}

	public function changePassword(){
		$data['info']="";
		$this->load->view("change_password",$data);
	}

	public function savePassword(){
		$p=$this->db->escape_str($this->input->post());
		$res=$this->m_mosque->checkPassword($p);
		if(empty($res)){
			$data['info']="<div class='alert alert-danger'>Wrong Password</div>";
			$this->load->view("change_password",$data);
		}else{
			$this->m_mosque->savePassword($p);
			$data['info']="<div class='alert alert-success'>Success</div>";
			$this->load->view("change_password",$data);
		}

	}
}

?>
