<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mosque extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "mosque";
		$this->load->model("m_mosque");
	}

	public function index(){
		$data['data']=$this->m_mosque->getAll($this->_table);
		$this->load->view('mosque',$data);
	}

	public function addMosque(){
		$this->load->view("add_mosque");
	}

	public function saveMosque(){
		$p=$this->db->escape_str($this->input->post());
		$ran=$this->randomPassword();
		$p['password'] = MD5($ran);
		$res=$this->m_mosque->insert($this->_table,$p);
		if($res)redirect("mosque");
	}

	public function deleteMosque($id){
		$p['id_mosque']=$id;
		$res=$this->m_mosque->adminDeleteById($this->_table,$p);
		if($res)redirect("mosque");
	}

	public function editMosque($id){
		$data['data']=$this->m_mosque->getMosqueById($id);
		$this->load->view("edit_mosque",$data);
	}

	public function updateMosque(){
		$config['upload_path']   =   "assets/image/mosque";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);

		$p=$this->db->escape_str($this->input->post());

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
			$p['pic'] = $finfo['file_name'];
			$pic=$this->m_mosque->getMosqueById($this->session->userdata('id_mosque'),$p['id_ustadz']);
			unlink("assets/image/mosque/".$pic['pic']);
		}
		$res=$this->m_mosque->adminUpdate($this->_table,$p,'id_mosque');
		if($res)redirect("mosque");
	}

	public function detailMosque($id){
		$data['data']=$this->m_mosque->getMosqueById($id);
		$this->load->view("detail_mosque",$data);
	}

	public function editProfile($id){
		$data['data']=$this->m_mosque->getMosqueById($id);
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
