<?php 
	/**
	* 
	*/
	class Common extends CI_Model
	{
		function select_student($id){

			$result = $this->db->query("SELECT tbl_party.id as partyid, legacyid, firstname, 
				middlename, tbl_registration.coursemajor, tbl_registration.student, lastname,
				`date`, course, tbl_course.id,description  FROM tbl_coursemajor, tbl_course,tbl_party,
				 tbl_registration WHERE legacyid = '$id' 
				AND tbl_registration.student = tbl_party.id 
				AND tbl_coursemajor.id = tbl_registration.coursemajor
				AND tbl_course.id = tbl_coursemajor.course ORDER by `date` DESC");
			return $result->row_array();
		}
		function get_school($partyid){
			$result = $this->db->query("SELECT school, firstname as sch
				FROM tbl_enrolment, tbl_party where student = '$partyid' 
				AND tbl_party.id = tbl_enrolment.school   GROUP BY school");
				return $result->result_array();
		}
		function select_schoolyear($partyid, $school){
			$result = $this->db->query("SELECT academicterm FROM tbl_enrolment
			 where student = '$partyid' AND  school = '$school' GROUP BY academicterm ORDER by academicterm");
			return $result->result_array();
		}
		function select_academicterm($academicterm){
			$result = $this->db->query("SELECT systart, syend, tbl_academicterm.term,description 
				FROM tbl_academicterm, tbl_term WHERE tbl_academicterm.id = '$academicterm' 
				AND tbl_term.id = tbl_academicterm.term");
			return $result->row_array();
		}
		function select_enrolmentid($academicterm, $partyid){
			$result = $this->db->query("SELECT id as enrolmentid FROM tbl_enrolment WHERE student = '$partyid' 
				AND academicterm = '$academicterm'");
			return $result->result_array();
		}
		function get_all_grades($enrolmentid)	{
			$result = $this->db->query("SELECT classallocation, semgrade, enrolment, subject, code, descriptivetitle, `value` FROM `tbl_studentgrade`, tbl_classallocation, tbl_subject, tbl_grade
 			WHERE enrolment = '$enrolmentid' AND tbl_classallocation.id = classallocation AND tbl_subject.id = subject AND tbl_grade.id = semgrade");
			return $result->result_array();
		}


	}


 ?>