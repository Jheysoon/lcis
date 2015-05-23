<?php 

class Out_studentcount extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('out_studentcount',$data);
	}
}