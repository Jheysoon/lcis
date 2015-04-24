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
                WHERE username = ?";

        $q = $this->db->query($sql, array($username));
        if($q->num_rows()>0)
        {
            $q = $q->result_array();

            foreach ($q as $info)
            {
                    // verify if the password in hash
                if(password_verify($password,$info['password']) && $info['username'] == $username)
                {
                    return 'ok';
                    break;
                }
            }
        }
        else
        {
            return 'not';
        }
    }

    function getUserId($username, $password)
    {
        $sql = "SELECT * FROM tbl_useraccess
                WHERE username = ?";

        $q = $this->db->query($sql, array($username));
        $q = $q->result_array();

        foreach ($q as $info)
        {
            if(password_verify($password,$info['password']) && $info['username'] == $username)
            {
                return $info['partyid'];
                break;
            }
        }
    }
}