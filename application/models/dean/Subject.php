<?php 

class Subject extends CI_Model
{
	function getNumSubject()
	{
		return $this->db->get('tbl_subject')->num_rows();
	}
	function subjectWhere($owner)
	{
		if($owner == 0)
			$q = $this->db->query("SELECT * FROM tbl_subject ORDER BY code");
		else
			$q = $this->db->query("SELECT * FROM tbl_subject WHERE owner = $owner ORDER BY code");
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
	function whereCode($code)
	{
		$this->db->where('code',$code);
		return $this->db->count_all_results('tbl_subject');
	}
	function insert($data)
	{
		$this->db->insert('tbl_subject',$data);
	}
	function search($sid)
	{
		$q = $this->db->query("SELECT code,descriptivetitle 
			FROM tbl_subject WHERE code 
			LiKE '%$sid%' OR descriptivetitle 
			LIKE '%$sid%' LIMIT 6");
		return $q->result_array();
	}
	function count($code)
	{
		$this->db->where('code',$code);
		$q = $this->db->get('tbl_subject');
		return $q->row_array();
	}
}
