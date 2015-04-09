<?php
/*
| -------------------------------------
| @file  : Useroption.php
| @date  : 4/9/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Useroption extends CI_Model
{

    function getOptionHeader()
    {
        $user_id = $this->session->userdata('uid');
        $q = $this->db->query("SELECT * FROM tbl_useroption WHERE userid = $user_id GROUP BY header ORDER BY priors ASC");
        return $q->result_array();
    }

    function getUserMenu($header)
    {
        $id = $this->session->userdata('uid');
        $this->db->where('userid', $id);
        $this->db->where('header', $header);
        $q = $this->db->get('tbl_useroption');
        return $q->result_array();
    }
}