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
		$data['data']=$this->m_kajian->getAllKajian($this->session->userdata('id_mosque'));
		$this->load->view('kajian',$data);
	}

	public function addKajian(){
		$data['ustadz']=$this->m_kajian->getAllByIdMosque('ustadz','id_mosque',$this->session->userdata('id_mosque'));
		$this->load->view('add_kajian',$data);
	}

	public function saveKajian(){
		$config['upload_path']   =   "assets/image/kajian";
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

		if(!$this->upload->do_upload('attachment')){
			echo $this->upload->display_errors();
		}else{
			$fattachment=$this->upload->data();
		}

		$p=$this->db->escape_str($this->input->post());
		$data=array(
			'id_ustadz' => $p['ustadz'],
			'id_mosque' => $this->session->userdata('id_mosque'),
			'name' => $p['name'],
			'description' => $p['description'],
			'place' => $p['place'],
			'date' => $p['date'],
			'time_start' => $p['time_start'],
			'time_end' => $p['time_end'],
			'pic' => $finfo['file_name'],
			'attachment' => $fattachment['file_name']
			);
		$res = $this->m_kajian->insert($this->_table,$data);
		if($res)redirect("kajian");
	}

	public function editKajian($id){
		$data['ustadz']=$this->m_kajian->getAllByIdMosque('ustadz','id_mosque',$this->session->userdata('id_mosque'));
		$data['data']=$this->m_kajian->getKajianById($this->session->userdata('id_mosque'),$id);
		if(empty($data['data'])){
			redirect("kajian");
		}else{
			$this->load->view('edit_kajian',$data);	
		}
	}

	public function updateKajian(){
		$config['upload_path']   =   "assets/image/kajian";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$this->load->library('upload',$config);
		$pic=0;
		$attachment=0;
		$p=$this->db->escape_str($this->input->post());
		$kajian=$this->m_kajian->getKajianById($this->session->userdata('id_mosque'),$p['id_kajian']);


		$data=array(
			'id_kajian' => $p['id_kajian'],
			'id_ustadz' => $p['ustadz'],
			'id_mosque' => $this->session->userdata('id_mosque'),
			'name' => $p['name'],
			'description' => $p['description'],
			'place' => $p['place'],
			'date' => $p['date'],
			'time_start' => $p['time_start'],
			'time_end' => $p['time_end']
			);


		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
		}else{
			$finfo=$this->upload->data();
			$data['pic'] = $finfo['file_name'];
			$pic=1;
		}

		if(!$this->upload->do_upload('attachment')){
			echo $this->upload->display_errors();
		}else{
			$fattachment=$this->upload->data();
			$data['attachment'] = $fattachment['file_name'];
			$attachment=1;
		}

		
		
		$res = $this->m_kajian->update($this->_table,$data,'id_kajian');
		
		if($res){
			if($pic==1)unlink("assets/image/kajian/".$kajian['pic']);
			if($attachment==1)unlink("assets/image/kajian/".$kajian['attachment']);
			redirect("kajian");
		}
	}

	function deleteKajian($id){
		$data=$this->m_kajian->getKajianById($this->session->userdata('id_mosque'),$id);
		$this->m_kajian->deleteById($this->_table,array('id_kajian'=>$id));
		unlink("assets/image/kajian/".$data['pic']);
		unlink("assets/image/kajian/".$data['attachment']);
		redirect("kajian");
	}

	function detailKajian($id){
		$data['data']=$this->m_kajian->getKajianById($this->session->userdata('id_mosque'),$id);
		$this->load->view("detail_kajian",$data);
	}

}

?>
