<?php 
	/**
	* 
	*/
	class Common extends CI_Model
	{
		function select_student($id){
			$data = array('legacyid' => $id);
			$this->db->order_by('date', 'DESC');
			$result = $this->db->get_where('view_studinfo', $data);
			return $result->row_array();
		}
		function get_school($partyid){
			$result = $this->db->query("SELECT school, firstname as sch
				FROM tbl_enrolment, tbl_party where student = '$partyid' 
				AND tbl_party.id = tbl_enrolment.school GROUP BY school");
				return $result->result_array();
		}
		function select_schoolyear($partyid, $school){
			$this->db->select('academicterm');
			$this->db->where('student', $partyid);
			$this->db->where('school', $school);
			$this->db->group_by('academicterm');
			$this->db->order_by('academicterm');
			$result = $this->db->get('tbl_enrolment');
			return $result->result_array();
		}
		function select_academicterm($academicterm){
			
		$result = $this->db->query("SELECT systart, syend, tbl_academicterm.term,description 
				FROM tbl_academicterm, tbl_term WHERE tbl_academicterm.id = '$academicterm' 
				AND tbl_term.id = tbl_academicterm.term");
				return $result->row_array();
		}
		function select_enrolmentid($academicterm, $partyid){
			$this->db->select('id as enrolmentid');
			$this->db->where('student', $partyid);
			$this->db->where('academicterm', $academicterm);
			$result = $this->db->get('tbl_enrolment');
			/*$result = $this->db->query("SELECT id as enrolmentid FROM tbl_enrolment WHERE student = '$partyid' 
				AND academicterm = '$academicterm'");*/
				return $result->result_array();
		}
		function get_all_grades($enrolmentid){
			$data = array('enrolment' => $enrolmentid);
			$result = $this->db->get_where('views_studentgrade', $data);
			return $result->result_array();

		}
		function theflag($partyid){
			$this->db->where('id',$partyid);
			$this->db->where('status', 'C');
			$q = $this->db->count_all_results('tbl_party');
			return $q;
		}
	}
