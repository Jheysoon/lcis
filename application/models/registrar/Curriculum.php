<?php

class Curriculum extends CI_Model
{
	function getCur($id,$cid)
	{
		$this->db->where('academicterm',$id);
		$this->db->where('coursemajor',$cid);
		$q = $this->db->count_all_results('tbl_curriculum');
		if($q > 0)
		{
			$this->db->where('academicterm',$id);
			$q = $this->db->get('tbl_curriculum');
			$q = $q->row_array();
			return $q['id'];
		}
		else
		{
			return 'repeat';
		}
	}

	function getCur2($id,$cid)
	{
		/*$this->db->where('academicterm',$id);
		$this->db->where('coursemajor',$cid);
		$q = $this->db->count_all_results('tbl_curriculum');*/

		$q = $this->db->query("SELECT * FROM tbl_curriculum WHERE coursemajor = $cid
				AND academicterm = $id")->num_rows();
		if($q > 0)
		{

			/*$this->db->where('academicterm',$id);
			$q = $this->db->get('tbl_curriculum');*/

			$q = $this->db->query("SELECT * FROM tbl_curriculum WHERE coursemajor = $cid
				AND academicterm = $id");
			$q = $q->row_array();
			return $q['id'];
		}
		else
		{
			return 'repeat';
		}
	}


	function getAc(){
		$result = $this->db->query("SELECT id as accad_id, CONCAT(systart, '-', syend) as sy FROM tbl_academicterm WHERE term = 1");
		return $result->result_array();
	}
	function getcid(){
			$uid = $this->session->userdata('uid');
			$getCollege = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_office, tbl_administration WHERE tbl_administration.id = '$uid' AND
			tbl_administration.office = tbl_office.id AND tbl_office.college = tbl_college.id");
			$c = $getCollege->row_array();
			return $cid = $c['id'];

	}

	function getcids(){
			$uids = $this->session->userdata('uid');
			$getColleges = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_academic WHERE tbl_academic.id = '$uids' AND
			tbl_academic.college = tbl_college.id");
			$cx = $getColleges->row_array();
			return $cids = $cx['id'];
	}
	function getCourse(){
		$cid = $this->getcid();
		$cids = $this->getcids();
		$result = $this->db->query("SELECT tbl_coursemajor.id as coursemajorid, course, major, tbl_course.description as desc_course FROM tbl_coursemajor, tbl_course, tbl_college
								WHERE tbl_course.id = course AND major = '' AND ((tbl_college.id =  '$cid' AND tbl_course.college =  '$cid') OR (tbl_college.id =  '$cids' AND tbl_course.college =  '$cids')) GROUP BY desc_course, coursemajorid");
		return $result->result_array();
	}
	function getm(){
		$cids = $this->getcids();
		$result = $this->db->query("SELECT tbl_coursemajor.id as coursid, CONCAT(tbl_course.description,' (', tbl_major.description, ')') as coursemajors
			FROM tbl_coursemajor, tbl_course, tbl_major, tbl_college WHERE tbl_course.id = course AND major = tbl_major.id  AND tbl_college.id =  '$cids' AND tbl_course.college =  '$cids'");
		return $result->result_array();
	}
	function getAllcurr(){
			$uid = $this->session->userdata('uid');
			$getCollege = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_office, tbl_administration WHERE tbl_administration.id = '$uid' AND
			tbl_administration.office = tbl_office.id AND tbl_office.college = tbl_college.id");
			$c = $getCollege->row_array();
			$cid = $c['id'];
			$cids = $this->getcids();

			$uid = $this->session->userdata('uid');
			$getColleges = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_academic WHERE tbl_academic.id = '$uid' AND
			tbl_academic.college = tbl_college.id");
			$c = $getColleges->row_array();
			$cids = $c['id'];




		$result = $this->db->query("SELECT tbl_curriculum.id as curricid, tbl_curriculum.description as curriculumdesc,`coursemajor`,`academicterm`, course, major, tbl_course.description as coursename, CONCAT(systart, '-', syend) as sy, yearlevel
			FROM `tbl_curriculum`, tbl_coursemajor, tbl_course, tbl_academicterm, tbl_college WHERE tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND major = 0
			AND tbl_academicterm.term = 1 AND (tbl_course.college = '$cid' OR tbl_course.college = '$cids' ) GROUP BY coursemajor, tbl_curriculum.academicterm");
			return $result->result_array();
	}
	function getAllcurr2(){
			$uid = $this->session->userdata('uid');
			$getCollege = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_office, tbl_administration WHERE tbl_administration.id = '$uid' AND
			tbl_administration.office = tbl_office.id AND tbl_office.college = tbl_college.id");
			$c = $getCollege->row_array();
			$cid = $c['id'];

			$uids = $this->session->userdata('uid');
			$getColleges = $this->db->query("SELECT tbl_college.id as id, tbl_college.description as descr
			FROM tbl_college, tbl_academic WHERE tbl_academic.id = '$uids' AND
			tbl_academic.college = tbl_college.id");
			$cx = $getColleges->row_array();
			$cids = $cx['id'];

			$result = $this->db->query("SELECT tbl_curriculum.id as curricid, tbl_curriculum.description as curriculumdesc,`coursemajor`,`academicterm`, course, major, CONCAT(tbl_course.description, ' (', tbl_major.description, ')') as coursename, CONCAT(systart, '-', syend) as sy, yearlevel
			FROM `tbl_curriculum`, tbl_coursemajor, tbl_course, tbl_academicterm, tbl_major WHERE tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND major != 0 AND tbl_major.id = major
			AND tbl_academicterm.term = 1 AND (tbl_course.college = '$cid' OR tbl_course.college = '$cids' )  GROUP BY coursemajor, tbl_curriculum.academicterm");
			return $result->result_array();
	}
	function getMatch($id,$cid)
	{
		$this->db->where('academicterm',$id);
		$this->db->where('coursemajor',$cid);
		$q = $this->db->count_all_results('tbl_curriculum');
		if($q > 0)
		{
			$this->db->where('coursemajor',$id);
			$q = $this->db->get('tbl_curriculum');
			$q = $q->row_array();
			return $q['id'];
		}
		else
		{
			return 'repeat';
		}
	}
	function insertsubj(){
		echo 1;
	}
}
