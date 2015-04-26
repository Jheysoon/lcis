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
        //$this->db->cache_on();
        $q = $this->db->get('tbl_grade');
        //$this->db->cache_off();
        return $q->result_array();
    }

}