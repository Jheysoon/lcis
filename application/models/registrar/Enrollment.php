<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Enrollment extends CI_Model
{

    function getStud($limit)
    {
        $q = $this->db->query("SELECT * FROM tbl_enrolment
                                WHERE coursemajor=5
                                GROUP BY student LIMIT $limit,15");
        return $q->result_array();
    }
    function getRows()
    {
        return $this->db->query("SELECT * FROM tbl_enrolment
                                    WHERE coursemajor=5
                                    GROUP BY student")
            ->num_rows();
    }
}