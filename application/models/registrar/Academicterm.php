<?php
/*
| -------------------------------------
| @file  : Academicterm.php
| @date  : 4/27/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Academicterm extends CI_Model
{
    function all()
    {
        $q = $this->db->get('tbl_academicterm');
        return $q->result_array();
    }
    function findById($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('tbl_academicterm');
        return $q->row_array();
    }
    function getLongName($term)
    {
        $this->db->where('id',$term);
        $q = $this->db->get('tbl_term')->row_array();
        return $q['description'];
    }
}