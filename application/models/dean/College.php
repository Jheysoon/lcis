<?php 

class College extends CI_Model
{
	function all()
	{
		$q = $this->db->get('tbl_college');
		return $q->result_array();
	}
}
