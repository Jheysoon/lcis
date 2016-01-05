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
        $q = $this->db->query("SELECT optionid, b.header as header, b.link as link
                                FROM tbl_useroption a, tbl_option b, tbl_option_header c
                                WHERE userid = $user_id AND a.optionid = b.id AND b.header = c.id
                                GROUP BY header
                                ORDER by c.priors, b.id");
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