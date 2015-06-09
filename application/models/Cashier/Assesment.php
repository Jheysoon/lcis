<?php 
	/**
	* 
	*/
	class Assesment extends CI_Model
	{
		function getstudinfo($legacyid){
			$this->db->where('legacyid', $legacyid);
			$this->db->select('id, firstname, middlename, lastname');
			return $this->db->get('tbl_party')->row_array();
		}
		function getAcadinfo($partyid){
			return $this->db->query("SELECT tbl_enrolment.id as enrolid, student, coursemajor, academicterm, CONCAT(systart,'-', syend) as sy, term as sem FROM tbl_enrolment, tbl_academicterm WHERE student = '$partyid' AND tbl_academicterm.id = tbl_enrolment.academicterm ORDER BY academicterm DESC LIMIT 1")->row_array();
		}

	}