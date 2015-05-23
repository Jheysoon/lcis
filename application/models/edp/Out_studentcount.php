<?php 

class Out_studentcount extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('out_studentcount',$data);
	}

	function chkAcam($id)
	{
		$this->db->where('academicterm',$id);
		return $this->db->count_all_results('out_studentcount');
	}
}