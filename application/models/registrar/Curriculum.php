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
	function getAc(){
		$result = $this->db->query("SELECT id as accad_id, CONCAT(systart, '-', syend) as sy FROM tbl_academicterm WHERE term = 1");
		return $result->result_array();
	}
	function getCourse(){
		$result = $this->db->query("SELECT tbl_coursemajor.id as coursemajorid, course, major, tbl_course.description as desc_course FROM tbl_coursemajor, tbl_course 
								WHERE tbl_course.id = course AND major = 0");
		return $result->result_array();
	}
	function getm(){
		$result = $this->db->query("SELECT tbl_coursemajor.id as coursid, CONCAT(tbl_course.description,' (', tbl_major.description, ')') as coursemajors 
			FROM tbl_coursemajor, tbl_course, tbl_major WHERE tbl_course.id = course AND major = tbl_major.id");
		return $result->result_array();
	}
	function getAllcurr(){
		$result = $this->db->query("SELECT tbl_curriculum.id as curricid, tbl_curriculum.description as curriculumdesc,`coursemajor`,`academicterm`, course, major, tbl_course.description as coursename, CONCAT(systart, '-', syend) as sy, yearlevel  
			FROM `tbl_curriculum`, tbl_coursemajor, tbl_course, tbl_academicterm WHERE tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND major = 0 
			AND tbl_academicterm.term = 1 GROUP BY coursemajor, tbl_curriculum.academicterm");
		return $result->result_array();
	}
	function getAllcurr2(){
		$result = $this->db->query("SELECT tbl_curriculum.id as curricid, tbl_curriculum.description as curriculumdesc,`coursemajor`,`academicterm`, course, major, CONCAT(tbl_course.description, ' (', tbl_major.description, ')') as coursename, CONCAT(systart, '-', syend) as sy, yearlevel  
			FROM `tbl_curriculum`, tbl_coursemajor, tbl_course, tbl_academicterm, tbl_major WHERE tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND major != 0 AND tbl_major.id = major 
			AND tbl_academicterm.term = 1 GROUP BY coursemajor, tbl_curriculum.academicterm");
			return $result->result_array();
	}
}