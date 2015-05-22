<?php 

class Classroom extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('tbl_classroom',$data);
	}
}