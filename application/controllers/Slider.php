<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {

	private $_table;

	public function __construct() {
		parent::__construct();
		$this->_table = "slider";
		$this->load->model("m_slider");
	}

	public function index(){
		$data['data']=json_decode($this->curl->simple_get(API_LINK.'/slider/getAllSliderByIdMosque/'.$this->session->userdata('id_mosque')),true);
		$this->load->view('slider',$data);
	}

}

?>
