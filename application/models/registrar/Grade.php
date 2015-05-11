<?php
/*
| -------------------------------------
| @file  : Grade.php
| @date  : 4/2/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Grade extends CI_Model{

    function getAllGrade()
    {

        $this->db->order_by('description ASC, value ASC');
        $q = $this->db->get('tbl_grade');
        //$this->db->cache_off();
        return $q->result_array();
    }

    function get_where($id)
    {
    	$this->db->where('id',$id);
    	$q = $this->db->get('tbl_grade');
    	return $q->row_array();
    }

}