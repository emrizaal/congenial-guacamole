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
		$data['data']=$this->m_ebook->getAllByIdMosque($this->_table,'id_mosque',$this->session->userdata('id_mosque'));
		$this->load->view('ebook',$data);
	}

	public function addEbook(){
		$this->load->view('add_ebook');
	}

	public function saveEbook(){
		$config['upload_path']   =   "assets/image/ebook";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
		}

		$p=$this->db->escape_str($this->input->post());
		$data=array(
			'id_mosque' => $this->session->userdata('id_mosque'),
			'title' => $p['title'],
			'description' => $p['description'],
			'url' => $p['url'],
			'pic' => $finfo['file_name']
			);
		$res = $this->m_ebook->insert($this->_table,$data);
		if($res)redirect("ebook");
	}

	public function deleteEbook($id){
		$data=$this->m_ebook->getEbookById($this->session->userdata('id_mosque'),$id);
		$this->m_ebook->deleteById($this->_table,array('id_ebook'=>$id));
		unlink("assets/image/ebook/".$data['pic']);
		redirect("ebook");
	}

	public function detailEbook($id){
		$data['data']=$this->m_ebook->getEbookById($this->session->userdata('id_mosque'),$id);
		$this->load->view("detail_ebook",$data);
	}

	public function editEbook($id){
		$data['data']=$this->m_ebook->getEbookById($this->session->userdata('id_mosque'),$id);
		$this->load->view("edit_ebook",$data);
	}

	public function updateEbook(){
		$config['upload_path']   =   "assets/image/ebook";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);

		$p=$this->db->escape_str($this->input->post());
		$data=array(
			'id_ebook' =>$p['id_ebook'],
			'title' => $p['title'],
			'description' => $p['description'],
			'url' => $p['url']
			);
		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
			$data['pic'] = $finfo['file_name'];
			$pic=$this->m_ebook->getEbookById($this->session->userdata('id_mosque'),$p['id_ebook']);
			unlink("assets/image/ebook/".$pic['pic']);
		}

		$res = $this->m_ebook->update($this->_table,$data,'id_ebook');
		if($res)redirect("ebook");
	}
	
}

?>
