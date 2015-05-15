<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Course extends CI_Model{

    function getCourse($cid)
    {
        $q = $this->db->query("SELECT description
                               FROM tbl_course
                               WHERE id = (
                               SELECT course
                               FROM tbl_coursemajor
                               WHERE id = $cid
                               )");
        $q = $q->row_array();
        return $q['description'];
    }

    function getMajor($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('tbl_major');
        $q = $q->row_array();
        return $q['description'];
    }

    function getAllCourse()
    {
        $q = $this->db->get('tbl_coursemajor');
        return $q->result_array();
    }

    function allCourse()
    {
        $q = $this->db->query("SELECT tbl_coursemajor.id as courseid, course, major, tbl_course.description as description FROM `tbl_coursemajor`, tbl_course 
          WHERE tbl_course.id = tbl_coursemajor.course AND major = 0");
        return $q->result_array();
    }
    function allcoursm(){
        $q = $this->db->query("SELECT tbl_coursemajor.id as courseid, course, major, CONCAT(tbl_course.description,'(', tbl_major.description, ')') as description FROM `tbl_coursemajor`, tbl_course, tbl_major 
        WHERE tbl_course.id = tbl_coursemajor.course AND tbl_coursemajor.major = tbl_major.id");
        return $q->result_array();
    }
    function getAllSchool($degree)
    {

      $q = $this->db->query(" SELECT tbl_party.id as sch_id, tbl_school.id, firstname FROM `tbl_school`, tbl_party WHERE tbl_party.id = tbl_school.id AND `". $degree ."` = '1'");
      return $q->result_array();
    }
    function specifics($partyid){
     
      $q = $this->db->query("SELECT coursemajor as courseid, course, tbl_course.description as coursename, college, tbl_college.description as collegename 
        FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_college WHERE student = '$partyid' AND tbl_coursemajor.id = coursemajor AND 
        tbl_course.id = course AND tbl_college.id = college ORDER BY `date` LIMIT 1");
      return $q->row_array();
    }

}