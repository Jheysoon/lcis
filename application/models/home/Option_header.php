<?php
/*
| -------------------------------------
| @file  : Option_header.php
| @date  : 4/9/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Option_header extends CI_Model
{
    function getHeaderName($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('tbl_option_header');
        $q = $q->row_array();
        echo $q['name'];
    }
}