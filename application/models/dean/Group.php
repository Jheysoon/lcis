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
			AND SUBSTRING(SUBCODE, 1,2) = '$code'
			GROUP BY `SUBTITLE`,`UNITS`
		");
		return $q->result_array();
	}

	function get_grouped_subjects($code){
		$q = $this->db->query("SELECT id, SUBTITLE, SUBNAME, UNITS
			FROM `tbl_enrolment_legacy`
			WHERE grouping != 0
			AND SUBSTRING(SUBCODE, 1,2) = '$code'
			GROUP BY grouping
		");
		return $q->result_array();
	}

	function group_sub($id, $gr){
		$this->db->where('id', $id);
		$this->db->update('tbl_enrolment_legacy', $gr);
	}

	function get_group_no(){
		$this->db->select('MAX(grouping) as gr');
		return $this->db->get('tbl_enrolment_legacy')->row_array();
	}

}
