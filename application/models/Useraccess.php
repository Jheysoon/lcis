<?php
/**
 * @date    : 4/7/2015
 * @author  : Jayson Martinez
 */

class Useraccess extends CI_Model
{

    function chkLogin($username, $password)
    {
        $sql = "SELECT * FROM tbl_useraccess
                WHERE username = ?
                AND password = AES_ENCRYPT(?,'key')";

        $q = $this->db->query($sql, array($username, $password));
        return $q->num_rows();
    }

    function getUserId($username, $password)
    {
        $sql = "SELECT * FROM tbl_useraccess
                WHERE username = ?
                AND password = AES_ENCRYPT(?,'key')";

        $q = $this->db->query($sql, array($username, $password));
        $q = $q->row_array();

        return $q['partyid'];
    }
}