<?php

class Common_dean extends CI_Model
{
	function countAcam($id)
	{
		$this->db->where('id',$id);
		return $this->db->count_all_results('tbl_academic');
	}
	function countAdmin($id)
	{
		$this->db->where('id',$id);
		return $this->db->count_all_results('tbl_administration');
	}
	function getColAcam($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_academic');
		return $q->row_array();
	}
	function getOffice($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_office');
		return $q->row_array();
	}
	function getColAdmin($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_administration');
		return $q->row_array();
	}
	function getColName($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_college');
		$q = $q->row_array();
		return $q['description'];
	}
	function getCollege($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('tbl_subject');
		$q = $q->row_array();
		return $q['owner'];
	}
	function getAllCl($user)
	{
		$this->db->where('instructor', $user);
		$this->db->select('id');
		$c = $this->db->get('tbl_classallocation')->result_array();
		$data = array();
		foreach($c as $cc)
		{
			$this->db->where('classallocation', $cc['id']);
			$d = $this->db->get('tbl_dayperiod')->result_array();
			foreach($d as $dd)
			{
				$data[] = $dd;
			}
		}
		return $data;
	}

	function getParty($id)
	{
		$t = $this->db->get_where('tbl_party', array('id' => $id))->row_array();
		return $t['lastname'].', '.$t['firstname'];
	}
}
