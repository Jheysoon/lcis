<?php 

/**
* 
*/
class Party extends CI_Model
{
	
	function get($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_party');
		return $q->row_array();
	}
}