<?php

/**
 * Author: Vladz
 * Date: July 2015
 * Type: Model
 */
class Tor extends CI_Model
{
    // query for counting page
    function getRows(){
        $q = $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                                 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                                 AND tbl_coursemajor.course = tbl_course.id
                                 AND tbl_party.id = tbl_registration.student
                                 AND tbl_registration.status = 'A'
                                 GROUP BY student");
        return $q->num_rows();
    }

    // query for getting student page limits
    function getStud($param)
    {
        $q = $this->db->query("SELECT tbl_party.id as pid, legacyid, lastname, firstname,  tbl_course.description as description, tbl_coursemajor.major as major
                               FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                                 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                                 AND tbl_coursemajor.course = tbl_course.id
                                 AND tbl_party.id = tbl_registration.student
                                 AND tbl_registration.status = 'A'
                                 GROUP BY student  ORDER BY legacyid DESC, tbl_registration.id DESC LIMIT $param, 15");
        return $q->result_array();
    }

    // query for searching specific student
    function getStudent($search)
    {
      $q = $this->db->query("SELECT legacyid, lastname, firstname
                             FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
                               WHERE tbl_registration.coursemajor = tbl_coursemajor.id
                               AND tbl_coursemajor.course = tbl_course.id
                               AND tbl_party.id = tbl_registration.student
                               AND tbl_registration.status = 'A'
                               AND(
                                      legacyid LIKE '%$search%'
                                      OR CONCAT(lastname, ' ', firstname) LIKE '%$search%'
                                      OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
                                  )
                               GROUP BY student  ORDER BY legacyid");
      return $q->result_array();
    }

    // query for getting specific student details
    function getStudDetails($sid){
      $q = $this->db->query("SELECT d.*, d.id as pid, b.major as major,  c.description as description, e.*, f.description as college
                             FROM tbl_registration a, tbl_coursemajor b, tbl_course c, tbl_party d, tbl_student e, tbl_college f
                             WHERE a.coursemajor = b.id
                             AND b.course = c.id
                             AND d.id = a.student
                             AND d.id = e.id
                             AND f.id = c.college
                             AND legacyid = '$sid'
                             ORDER BY a.id DESC LIMIT 1");
      return $q->row_array();
    }

    // query getting school details
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

    // query getting enrollment
    function getEnrolment($pid, $limit){
      $q = $this->db->query("SELECT a.*, b.firstname, c.systart, c.syend, d.shortname
                             FROM tbl_enrolment a, tbl_party b, tbl_academicterm c, tbl_term d
                             WHERE a.student = '$pid' AND a.school = b.id
                             AND a.academicterm = c.id AND c.term = d.id
                             ORDER BY c.systart, c.syend, d.id LIMIT $limit, 2");
      return $q->result_array();
    }

    function getEnrolment2($pid){
      $q = $this->db->query("SELECT COUNT(*) as ctr
                             FROM tbl_enrolment a, tbl_party b
                             WHERE a.student = '$pid' AND a.school = b.id");
      return $q->row_array();
    }

    // query getting grade per enrollment
    function getGrade($id){
      $q = $this->db->query("SELECT a.*, b.value as grade, b.description as gdesc,
                             e.code as code, e.descriptivetitle as title, e.units, e.group
                             FROM tbl_studentgrade a, tbl_grade b, tbl_classallocation c, tbl_subject e
                             WHERE enrolment = '$id'
                             AND a.semgrade = b.id AND c.id = a.classallocation AND c.subject = e.id
                             ORDER BY e.units DESC, e.code");
      return $q->result_array();
    }

    // query getting re-exam grade
    function getRegrade($id){
      $q = $this->db->query("SELECT value, description
                             FROM tbl_grade
                             WHERE id = '$id'");
      return $q->row_array();
    }

    function getAssignatories(){
      $this->db->order_by('signposition');
      $q = $this->db->get('tbl_assignatory');
      return $q->result_array();
    }

    function updateFields($f1, $f2, $position){
      $data = array(
          'assignatory' => $f1,
          'designation' => $f2
      );
      $this->db->where('signposition', $position);
      $q = $this->db->update('tbl_assignatory', $data);
    }
}


 ?>
