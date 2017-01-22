<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kajian extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "kajian";
		$this->load->model("m_kajian");
	}

	public function index(){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getAllKajianByIdMosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('kajian',$data);
	}

	public function addKajian(){
		$data['ustadz']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getAllByIdMosque/ustadz/id_mosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('add_kajian',$data);
	}

	public function editKajian($id){
		$data['ustadz']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getAllByIdMosque/ustadz/id_mosque/'.$this->session->userdata('id_mosque')),true);
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getKajianById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		if(empty($data['data'])){
			redirect("kajian");
		}else{
			$this->load->view('edit_kajian',$data);
		}
	}

	function detailKajian($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getKajianById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("detail_kajian",$data);
	}

}

?>
