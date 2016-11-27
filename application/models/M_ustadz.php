<?php 
class M_ustadz extends MY_Model {

	public function getUstadzById($id){
		$query=$this->db->query("SELECT * from ustadz where id_ustadz='$id'")->row_array();
		return $query;
	}

}
?>