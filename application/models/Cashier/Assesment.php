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
		function getSubInfo($enid){
			return $this->db->query("SELECT classallocation, tbl_subject.descriptivetitle, tbl_subject.code, units FROM tbl_studentgrade, tbl_subject, tbl_classallocation WHERE enrolment = '$enid' AND tbl_studentgrade.classallocation = tbl_classallocation.id AND tbl_classallocation.subject = tbl_subject.id")->result_array();
		}
		function getTuition($enrolid){
			$this->db->where('enrolment', $enrolid);
			return  $this->db->get('tbl_billclass')->num_rows();
		}
		function getTotal($enrolid){
			$this->db->where('enrolment', $enrolid);
			return  $this->db->get('tbl_billclass')->row_array();
		}
		function getR($coursemajor, $accounttype){
			$where = "tbl_feetype.id = tbl_fee.feetype AND tbl_fee.coursemajor = " . $coursemajor . " AND accounttype = " . $accounttype;
			$this->db->where($where);
			$this->db->select('`accounttype`, `rate`');
			return  $this->db->get('tbl_fee, tbl_feetype')->row_array();
		}
}