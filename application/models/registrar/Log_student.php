<?php
/**
 * @date    : 4/28/2015
 * @author  : Jayson Martinez
 */

class Log_student extends CI_Model
{
    function insert_not_exists($partyid,$status)
    {
        $date = date('Y-m-d');
        $time = time();
        $uid = $this->session->userdata('uid');
        $data = array('student' => $partyid,'dte' =>  $date, 'user' => $uid, 'status' => $status,'tm'=>$time);
        $this->db->insert('log_student', $data);

        $data2 = array('status' => $status);
        $this->db->where('id', $partyid);
        $this->db->update('tbl_party', $data2);

    }

    function getLatestTm($id)
    {
        $q = $this->db->query("SELECT tm
                                FROM log_student WHERE id=(
                                SELECT MAX(id) FROM log_student
                                WHERE student=$id)");
        $q = $q->row_array();
        return $q['tm'];
    }
}