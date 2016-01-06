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
                                ORDER by c.priors, b.id, c.name");
        return $q->result_array();
    }

    function getUserMenu($header)
    {
        $user = $this->session->userdata('uid');
        return $this->db->query("SELECT a.link as link, a.desc as desc1 FROM tbl_option a, tbl_useroption b
            WHERE b.optionid = a.id
            AND b.userid = $user
            AND a.header = $header
            ORDER BY a.id")->result_array();
        
    }
}