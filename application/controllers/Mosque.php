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
		$p=$this->db->escape_str($this->input->post());
		$res=$this->m_mosque->adminUpdate($this->_table,$p,'id_mosque');
		if($res)redirect("mosque");
	}

	public function detailMosque($id){
		$data['data']=$this->m_mosque->getMosqueById($id);
		$this->load->view("detail_mosque",$data);
	}
}

?>
