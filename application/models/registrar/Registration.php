<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Registration extends CI_Model{

    function getCourseMajorId($course_id)
    {
        $this->db->where('student',$course_id);
        $q = $this->db->get('tbl_registration');
        $q = $q->row_array();
        return $q['coursemajor'];
    }

}