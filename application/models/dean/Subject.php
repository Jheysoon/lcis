<?php

class Subject extends CI_Model
{
	function getNumSubject()
	{
		return $this->db->get('tbl_subject')->num_rows();
	}
	function subjectWhere($owner)
	{
		/*if($owner == 0)
			$q = $this->db->query("SELECT * FROM tbl_subject WHERE owner = 0 ORDER BY code");
		else
			$q = $this->db->query("SELECT * FROM tbl_subject WHERE owner = $owner OR owner = 0 ORDER BY code");*/
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
		$this->db->update('tbl_subject',$data);
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
	function search($sid,$owner)
	{
		$q = $this->db->query("SELECT code,descriptivetitle
			FROM tbl_subject WHERE (code
			LIKE '%$sid%' OR descriptivetitle
			LIKE '%$sid%') AND owner = $owner OR owner = 0 LIMIT 6");
		return $q->result_array();
	}
	function count($code)
	{
		$this->db->where('code',$code);
		$q = $this->db->get('tbl_subject');
		return $q->row_array();
	}

	function whereCode_owner($owner,$sid)
	{
		if($owner == 1)
		{
			$where = "id = $sid AND (gesubject = 1 OR owner = $owner)";
			$this->db->where($where);
		}
		else
		{
			$this->db->where('id', $sid);
			$this->db->where('owner', $owner);
			$this->db->where('gesubject', '0');
		}
		return $q = $this->db->count_all_results('tbl_subject');
	}
	function getCode_owner($owner,$sid)
	{
		$this->db->where('owner',$owner);
		$this->db->where('id',$sid);
		return $q = $this->db->get('tbl_subject')->row_array();
	}
	function all()
	{
		return $this->db->get('tbl_subject')->result_array();
	}
	function subjectOwner($owner)
	{
		if($owner == 1)
		{
			$this->db->where('gesubject','1');
			$this->db->or_where('owner',$owner);
		}
		else
		{
			$this->db->where('owner',$owner);
		}
		return $this->db->get('tbl_subject')->result_array();
	}

	function getSubject()
	{
		$owner 		= $this->api->getUserCollege();
		$user 		= $this->session->userdata('uid');
		$systemVal 	= $this->api->systemValue();

		if($user == $systemVal['employeeid'])
		{
			return $this->db->query("SELECT a.id as id, code, descriptivetitle, yearlevel, studentcount, section, coursemajor
				FROM out_section a,tbl_subject b
				WHERE a.subject = b.id AND computersubject = 1
				ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
		}
		elseif($owner == 1)
		{
			return $this->db->query("SELECT a.id as id, code, descriptivetitle, yearlevel, studentcount, section, coursemajor
				FROM out_section a,tbl_subject b
				WHERE a.subject = b.id AND owner = $owner AND (owner = 1 OR gesubject = 1) AND computersubject = 0
				ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
		}
		else
		{
			return $this->db->query("SELECT a.id as id, code, descriptivetitle, yearlevel, studentcount, section, coursemajor
				FROM out_section a,tbl_subject b
				WHERE a.subject = b.id AND owner = $owner AND computersubject = 0 AND gesubject = 0
				ORDER BY b.code ASC, coursemajor ASC, yearlevel ASC");
		}
	}
}
