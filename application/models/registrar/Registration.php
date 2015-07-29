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
    function ins_not_exist($data)
    {
    	$this->db->where('student',$data['student']);
    	$this->db->where('coursemajor',$data['coursemajor']);
    	$q = $this->db->count_all_results('tbl_registration');

    	if($q < 1)
    	{
    		$this->db->insert('tbl_registration',$data);
    	}
    }
    function getAcam($id)
    {
        $this->db->where('student',$id);
        $q = $this->db->get('tbl_registration');
        return $q->row_array();
    }

    function getLatestCM($id)
    {
        return $this->db->query("SELECT * FROM tbl_registration
            WHERE student = $id AND academicterm = (
                SELECT max(academicterm) FROM tbl_registration WHERE student = $id
            )")->row_array();
    }
}
