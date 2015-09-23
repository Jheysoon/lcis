<?php

class Group extends CI_Model
{
	function all()
	{
		$q = $this->db->get('tbl_group');
		return $q->result_array();
	}

	function get_subjects($code){
		$q = $this->db->query("SELECT id, SUBTITLE, SUBNAME, UNITS
			FROM `tbl_enrolment_legacy`
			WHERE grouping = 0
			AND ($code)
			GROUP BY `SUBTITLE`,`SUBNAME`,`UNITS`
		");
		return $q->result_array();
	}

	function get_grouped_subjects($code){
		$q = $this->db->query("SELECT grouping, SUBTITLE, SUBNAME, UNITS
			FROM `tbl_enrolment_legacy`
			WHERE grouping != 0
			AND ($code)
			GROUP BY grouping
		");
		return $q->result_array();
	}

	function group_sub($subtitle, $subname, $unit, $gr){
		$this->db->where('UNITS', $unit);
		$this->db->where('SUBNAME', $subname);
		$this->db->where('SUBTITLE', $subtitle);
		$this->db->update('tbl_enrolment_legacy', $gr);
	}

	function get_group_no(){
		$this->db->select('MAX(grouping) as gr');
		return $this->db->get('tbl_enrolment_legacy')->row_array();
	}

	function ungroup($gr, $data){
		$this->db->where('grouping', $gr);
		$this->db->update('tbl_enrolment_legacy', $data);
	}

	function getCol($id){
		$this->db->where('id', $id);
		$q = $this->db->get('tbl_college');
		return $q->row_array();
	}

}
