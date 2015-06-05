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
			return $this->db->query("SELECT tbl_enrolment.student, tbl_enrolment.coursemajor, tbl_enrolment.academicterm, tbl_enrolment.id as enrolid, tbl_coursemajor.course, tbl_course.description as coursedesc, CONCAT(systart,'-' ,syend) as sy, tbl_academicterm.term as sem 
				FROM tbl_enrolment, tbl_coursemajor, tbl_course, tbl_academicterm WHERE tbl_coursemajor.course = tbl_course.id AND tbl_enrolment.coursemajor = tbl_coursemajor.id AND  academicterm = tbl_academicterm.id AND tbl_enrolment.student = '$partyid' ORDER BY tbl_enrolment.academicterm DESC LIMIT 1")->row_array();
		}
		function getSubjectinfo($enid){

		}
	}