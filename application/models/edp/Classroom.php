<?php 

class Classroom extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('tbl_classroom',$data);
	}

	function all()
	{
		return $this->db->get('tbl_classroom')->result_array();
	}

	function find($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('tbl_classroom')->row_array();
	}
}