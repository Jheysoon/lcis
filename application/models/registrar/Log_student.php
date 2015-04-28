<?php
/**
 * @date    : 4/28/2015
 * @author  : Jayson Martinez
 */

class Log_student extends CI_Model
{
    function insert_not_exists($partyid)
    {
        $date = date('Y-m-d');
        $uid = $this->session->userdata('uid');
        $status = $this->session->userdata('status');
        $data = array('student' => $partyid,'dte' =>  $date, 'user' => $uid, 'status' => $status);
        $this->db->insert('log_student', $data);

        $data2 = array('status' => $status);
        $this->db->where('id', $partyid);
        $this->db->update('tbl_party', $data2);

    }
}