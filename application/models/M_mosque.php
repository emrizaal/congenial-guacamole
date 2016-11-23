<?php 
class M_mosque extends CI_Model {

	function getAllMosque(){
		$query=$this->db->query("SELECT * from mosque")->result_array();
		return $query;
	}

}
?>