<?php 

/**
* 
*/
class Designation extends CI_Model
{
	
	function getDesignations()
	{
		$this->db->order_by('description');
		return $this->db->get('tbl_designation')->result_array();
	}

	function addDesignation($desig){
		$arr = array('description' => $deisg);
		$this->db->insert('tbl_designation', $arr);
	}

	function updateDesignation($id, $desig){
		$arr = array('description' => $deisg);
		$this->db->where('id', $id);
		$this->db->update('tbl_designation', $arr);
	}

	function getSpecificDesig($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_designation')->row_array();
	}
}


 ?>