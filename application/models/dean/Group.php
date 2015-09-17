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
			AND $code
			GROUP BY `SUBTITLE`,`UNITS`
		");
		return $q->result_array();
	}

	function get_grouped_subjects($code){
		$q = $this->db->query("SELECT id, SUBTITLE, SUBNAME, UNITS
			FROM `tbl_enrolment_legacy`
			WHERE grouping != 0
			AND $code
			GROUP BY grouping
		");
		return $q->result_array();
	}

	function group_sub($name, $gr){
		$this->db->where('SUBTITLE', $name);
		$this->db->update('tbl_enrolment_legacy', $gr);
	}

	function get_group_no(){
		$this->db->select('MAX(grouping) as gr');
		return $this->db->get('tbl_enrolment_legacy')->row_array();
	}

}
