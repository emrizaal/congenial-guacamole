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
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/article/getAllArticleByIdMosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('article',$data);
	}

	public function addArticle(){
		$this->load->view('add_article');
	}

	public function detailArticle($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/article/getArticleById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("detail_article",$data);
	}

	public function editArticle($id){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/article/getArticleById/'.$this->session->userdata('id_mosque').'/'.$id),true);
		$this->load->view("edit_article",$data);
	}
}

?>
