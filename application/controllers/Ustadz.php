<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ustadz extends CI_Controller {

	public function index(){
		$data['data']=$this->m_ustadz->getAllUstadz();
		$this->load->view('ustadz',$data);
	}

	
}

?>
