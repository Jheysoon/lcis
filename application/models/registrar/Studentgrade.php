<?php
/*
| -------------------------------------
| @file  : Studentgrade.php
| @date  : 4/26/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Studentgrade extends CI_Model{

    function save_grade($class_allocid,$grade,$enrolment)
    {
        $data['semgrade'] = $grade;
        $data['enrolment'] = $enrolment;
        $data['classallocation'] = $class_allocid;

        $this->db->insert('tbl_studentgrade',$data);
    }
}