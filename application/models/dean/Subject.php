<?php 

class Subject extends CI_Model
{
	function getNumSubject()
	{
		return $this->db->get('tbl_subject')->num_rows();
	}
	function subjectWhere()
	{
		$q = $this->db->query("SELECT * FROM tbl_subject ORDER BY code");
		return $q->result_array();
	}
	function find($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_subject');
		return $q->row_array();
	}
	function update($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update("tbl_subject",$data);
	}
}
