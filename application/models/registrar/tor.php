<?php

/**
 *
 */
class tor extends CI_Model
{
    function getRows(){
        $q = $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                                 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                                 AND tbl_coursemajor.course = tbl_course.id
                                 AND tbl_party.id = tbl_registration.student
                                 GROUP BY student");
        return $q->num_rows();
    }

    function getStud($param)
    {
        $q = $this->db->query("SELECT tbl_party.id as pid, legacyid, lastname, firstname,  tbl_course.description as description, tbl_coursemajor.major as major
                               FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                                 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                                 AND tbl_coursemajor.course = tbl_course.id
                                 AND tbl_party.id = tbl_registration.student
                                 GROUP BY student  ORDER BY legacyid DESC, tbl_registration.id DESC LIMIT $param, 15");
        return $q->result_array();
    }

    function getStudent($search)
    {
      $q = $this->db->query("SELECT legacyid, lastname, firstname
                             FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                               WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                               AND tbl_coursemajor.course = tbl_course.id
                               AND tbl_party.id = tbl_registration.student
                               AND(
                                      legacyid LIKE '%$search%'
                                      OR CONCAT(lastname, ' ', firstname) LIKE '%$search%'
                                      OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
                                  )
                               GROUP BY student  ORDER BY legacyid");
      return $q->result_array();
    }
    function getStudDetails($sid){
      $q = $this->db->query("SELECT d.*, d.id as pid, b.major as major,  c.description as description, e.*
                             FROM tbl_registration a, tbl_coursemajor b, tbl_course c, tbl_party d, tbl_student e
                             WHERE a.coursemajor = b.id
                             AND b.course = c.id
                             AND d.id = a.student
                             AND d.id = e.id
                             AND legacyid = '$sid'
                             ORDER BY a.id DESC LIMIT 1");
      return $q->row_array();
    }

    function getSchool($school){
        $firstname = '';
        $this->db->where('id', $school);
        $this->db->select('firstname');
        $res = $this->db->get('tbl_party')->row_array();
        if ($res){
            extract($res);
        }
        return $firstname;
    }

    function getEnrolment($pid){
      $q = $this->db->query("SELECT a.*, b.firstname, c.systart, c.syend, d.shortname
                             FROM tbl_enrolment a, tbl_party b, tbl_academicterm c, tbl_term d
                             WHERE a.student = '$pid' AND a.school = b.id
                             AND a.academicterm = c.id AND c.term = d.id
                             LIMIT 2, 2");
      return $q->result_array();
    }

    function getGrade($id){
      $q = $this->db->query("SELECT a.*, b.value as grade, b.description as gdesc, e.code as code, e.descriptivetitle as title
                             FROM tbl_studentgrade a, tbl_grade b, tbl_classallocation c, tbl_subject e
                             WHERE enrolment = '$id'
                             AND a.semgrade = b.id AND c.id = a.classallocation AND c.subject = e.id");
      return $q->result_array();
    }

    function getRegrade($id){
      $q = $this->db->query("SELECT value
                             FROM tbl_grade
                             WHERE id = '$id'");
      $g = $q->row_array();
      return $g['value'];
    }
}


 ?>
