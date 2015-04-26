<?php
/*
| -------------------------------------
| @file  : Subject.php
| @date  : 4/2/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Subject extends CI_Model
{
    function getAllSubj()
    {
        $q = $this->db->get('tbl_subject');
        return $q->result_array();
    }

    function findById($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('tbl_subject');
        return $q->row_array();
    }
}