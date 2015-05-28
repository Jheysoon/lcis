<?php 

class Curriculumdetail extends CI_Model
{
	function getAllSubj($acam)
	{
		$this->db->where('curriculum',$acam);
		$q = $this->db->get('tbl_curriculumdetail');
		return $q->result_array();
	}
	function getAllYear($cur)
	{
		return $this->db->query("SELECT * 
					FROM tbl_curriculumdetail 
					WHERE curriculum=$cur 
					GROUP BY yearlevel")
		->result_array();
	}
}