<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebook extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "ebook";
		$this->load->model("m_ebook");
	}

	public function index(){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/ebook/getAllEbookByIdMosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('ebook',$data);
	}

	public function addEbook(){
		$this->load->view('add_ebook');
	}

	public function detailEbook($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/ebook/getEbookById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("detail_ebook",$data);
	}

	public function editEbook($id){
		$data['data']=$this->m_ebook->getEbookById($this->session->userdata('id_mosque'),$id);
		$this->load->view("edit_ebook",$data);
	}
}

?>
