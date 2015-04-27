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

    function getAllCourse()
    {
        $q = $this->db->get('tbl_course');
        return $q->result_array();
    }

}