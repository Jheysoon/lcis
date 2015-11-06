<?php

/**
 * Author: vladz
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
      $q = $this->db->query("SELECT d.*, d.id as pid, a.datecreated as dte, b.major as major,  c.description as description, e.*, f.description as college
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

    // query getting enrolment
    function getEnrolment($pid, $limit){
      $q = $this->db->query("SELECT a.*, b.firstname as school, d.subject, c.code, c.descriptivetitle, c.units, c.group
                             FROM view_tor a, tbl_party b, tbl_subject c, tbl_classallocation d
                             WHERE a.student = '$pid'
                             AND a.classallocation = d.id
                             AND d.subject = c.id
                             AND b.id = a.school
                             ORDER BY a.systart, a.syend, a.shortname, c.units DESC, c.code
                             LIMIT $limit, 20");
      return $q->result_array();
    }

    // query getting grade
    function getGrade($id){
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

    // query for counting tor page
    function countPage($sid){
      $q = $this->db->query("SELECT a.* FROM view_tor a, tbl_party b WHERE b.legacyid = '$sid' AND a.student = b.id");
      $row = $q->num_rows();

      $q = $this->db->query("SELECT distinct(school) FROM view_tor");
      $sch = $q->num_rows();

      $q = $this->db->query("SELECT academicterm FROM tbl_enrolment a, tbl_party b
                             WHERE b.legacyid = '$sid'
                             AND a.student = b.id
                           ");
      $ac = $q->num_rows();

      return $row + $sch + $ac;
    }

    function getSource($pid){
          $q = $this->db->query("SELECT hscard, tor FROM tbl_student WHERE id = $pid");
          return $q->row_array();
    }

    function getMajor($major){
      $this->db->where('id', $major);
      $this->db->select('description');
      return $this->db->get('tbl_major')->row_array();
    }
}


 ?>
