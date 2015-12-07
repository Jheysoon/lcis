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
}


 ?>