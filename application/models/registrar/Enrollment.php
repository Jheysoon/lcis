<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Enrollment extends CI_Model
{

    function get_first_15()
    {
        $q = $this->db->query("SELECT * FROM tbl_enrolment
                                WHERE coursemajor=5
                                GROUP BY student LIMIT 15");
        return $q->result_array();
    }
}