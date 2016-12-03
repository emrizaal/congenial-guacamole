<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "article";
		$this->load->model("m_article");
	}

	public function index(){
		$data['data']=$this->m_article->getAllByIdMosque($this->_table,'id_mosque',$this->session->userdata('id_mosque'));
		$this->load->view('article',$data);
	}

	public function addArticle(){
		$this->load->view('add_article');
	}

	public function saveArticle(){
		$config['upload_path']   =   "assets/image/article";
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
			'content' => $p['content'],
			'pic' => $finfo['file_name']
			);
		$res = $this->m_article->insert($this->_table,$data);
		if($res)redirect("article");
	}

	public function deleteArticle($id){
		$data=$this->m_article->getArticleById($this->session->userdata('id_mosque'),$id);
		$this->m_article->deleteById($this->_table,array('id_article'=>$id));
		unlink("assets/image/article/".$data['pic']);
		redirect("article");
	}

	public function detailArticle($id){
		$data['data']=$this->m_article->getArticleById($this->session->userdata('id_mosque'),$id);
		$this->load->view("detail_article",$data);
	}

	public function editArticle($id){
		$data['data']=$this->m_article->getArticleById($this->session->userdata('id_mosque'),$id);
		$this->load->view("edit_article",$data);
	}

	public function updateArticle(){
		$config['upload_path']   =   "assets/image/article";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);

		$p=$this->db->escape_str($this->input->post());
		$data=array(
			'id_article' =>$p['id_article'],
			'title' => $p['title'],
			'content' => $p['content']
			);
		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
			$data['pic'] = $finfo['file_name'];
			$pic=$this->m_article->getArticleById($this->session->userdata('id_mosque'),$p['id_article']);
			unlink("assets/image/article/".$pic['pic']);
		}

		$res = $this->m_article->update($this->_table,$data,'id_article');
		if($res)redirect("article");
	}
	
}

?>
