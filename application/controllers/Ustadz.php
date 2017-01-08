<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ustadz extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "ustadz";
		$this->load->model("m_ustadz");
	}

	public function index(){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/kajian/getAllByIdMosque/ustadz/id_mosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('ustadz',$data);
	}

	public function addUstadz(){
		$this->load->view('add_ustadz');
	}

	public function detailUstadz($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/ustadz/getUstadzById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("detail_ustadz",$data);
	}

	public function editUstadz($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/ustadz/getUstadzById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("edit_ustadz",$data);
	}

	public function updateUstadz(){
		$config['upload_path']   =   "assets/image/ustadz";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);

		$p=$this->db->escape_str($this->input->post());
		$data=array(
			'id_ustadz' =>$p['id_ustadz'],
			'name' => $p['name'],
			'description' => $p['description']
			);
		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
			$data['pic'] = $finfo['file_name'];
			$pic=$this->m_ustadz->getUstadzById($this->session->userdata('id_mosque'),$p['id_ustadz']);
			unlink("assets/image/ustadz/".$pic['pic']);
		}

		$res = $this->m_ustadz->update($this->_table,$data,'id_ustadz');
		if($res)redirect("ustadz");
	}

}

?>
