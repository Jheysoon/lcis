<?php 

	class Student extends CI_Model
	{
		function getRows($col){
        return $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
        						 AND tbl_coursemajor.course = tbl_course.id 
        						 AND tbl_party.id = tbl_registration.student 
        						 AND tbl_course.college = '$col' 
        						 GROUP BY student ORDER BY legacyid DESC")
            ->num_rows();
		}
		function getStud($param, $col)
	    {
	        $q = $this->db->query("SELECT tbl_party.id as pid, legacyid, lastname, firstname,  tbl_course.description as description, tbl_coursemajor.major as major 
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party 
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
	        						 AND tbl_coursemajor.course = tbl_course.id 
	        						 AND tbl_party.id = tbl_registration.student 
	        						 AND tbl_course.college = '$col' 
	        						 GROUP BY student  ORDER BY legacyid DESC LIMIT $param, 15");
	        return $q->result_array();
	    }

	    function getMajor($id){
	        $q = $this->db->query("SELECT description as des FROM tbl_major WHERE id = '$id'");
	        return $q->row_array();
	    }


        function existsID($id, $col)
        {
	        $q = $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party 
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
	        						 AND tbl_coursemajor.course = tbl_course.id 
	        						 AND tbl_party.id = tbl_registration.student 
	        						 AND tbl_course.college = '$col' 
	        						 AND legacyid = '$id'");
	        return $q->num_rows();
        }


		function getStudent($search, $col)
	    {
	        $q = $this->db->query("SELECT legacyid, lastname, firstname 
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party 
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
	        						 AND tbl_coursemajor.course = tbl_course.id 
	        						 AND tbl_party.id = tbl_registration.student 
	        						 AND tbl_course.college = '$col'
	        						 AND(
	        						 		legacyid LIKE '%$search%'
	        						 		OR CONCAT(lastname, ' ', firstname) LIKE '%$search%'
	        						 		OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
	        						 	) 
	        						 GROUP BY student  ORDER BY legacyid");
	        return $q->result_array();
	    }

	    function getStudInfo($id){
	        $q = $this->db->query("SELECT lastname, firstname, tbl_coursemajor.major as major, tbl_course.description as description, tbl_coursemajor.id as cid
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party 
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
	        						 AND tbl_coursemajor.course = tbl_course.id 
	        						 AND tbl_party.id = tbl_registration.student 
	        						 AND tbl_party.legacyid = '$id'
	        						 ");
	        return $q->row_array();
	    }

		function calculatebill($enid = 2){
			$getEnrolment = $this->db->query("SELECT * FROM tbl_studentgade WHERE enrolment = '$enid'");
			$g = $getEnrolment->result_array();
			foreach ($g as $key => $value) {
				extract($value);
			}

		}

		function getAcTerm($id){
			$this->db->where("id", $id);
			$q = $this->db->get("tbl_academicterm");
			return $q->row_array();
		}

		function getYearLevel($id){
			$q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_academicterm, tbl_party
								   WHERE tbl_enrolment.student = tbl_party.id 
								   AND tbl_enrolment.academicterm = tbl_academicterm.id
								   AND tbl_academicterm.term != 3
								   AND tbl_party.legacyid = '$id'");
			return $q->num_rows();
		}

		function getAllCur($cid){
			$this->db->where("coursemajor", $cid);
			$this->db->select("id");
			$q = $this->db->get("tbl_curriculum");
			return $q->result_array();
		}
	}