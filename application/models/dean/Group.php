<?php 

class Group extends CI_Model
{
	function all()
	{
		$q = $this->db->get('tbl_group');
		return $q->result_array();
	}
}
