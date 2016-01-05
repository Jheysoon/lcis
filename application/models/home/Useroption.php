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
        $user = $this->session->userdata('uid');
        return $this->db->query("SELECT * FROM tbl_option
            WHERE tbl_useroption.optionid = tbl_option.id
            AND tbl_useroption.userid = $user
            AND tbl_option.header = $header
            ORDER BY id")->result_array();
        
    }
}