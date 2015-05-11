<?php 

class Subject extends CI_Model
{
	function getNumSubject()
	{
		return $this->db->get('tbl_subject')->num_rows();
	}
	function subjectWhere($limit)
	{
		//$this->db-where();
		$q = $this->db->query("SELECT * FROM tbl_subject LIMIT $limit,15");
		return $q->result_array();
	}
}
