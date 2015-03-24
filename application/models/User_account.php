<?php
/*
| -------------------------------------
| @file  : User_account.php
| @date  : 3/24/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class User_account extends CI_Model {

    function getEmpInfo($id)
    {
        $this->db->where('eid',$id);
        $q = $this->db->get('user_accounts');
        return $q->row_array();
    }
}