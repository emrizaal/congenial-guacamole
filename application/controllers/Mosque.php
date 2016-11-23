<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mosque extends CI_Controller {

	public function index(){
		$data['data']=$this->m_mosque->getAllMosque();
		$this->load->view('mosque',$data);
	}

	
}

?>
