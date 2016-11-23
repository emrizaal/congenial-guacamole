<?php 
class M_ustadz extends CI_Model {

	function getAllUstadz(){
		$query=$this->db->query("SELECT * from ustadz")->result_array();
		return $query;
	}

}
?>