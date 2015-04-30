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
    function ins_stat($partyid,$status)
    {
        $this->db->trans_begin();

        $q = $this->db->query("SELECT user FROM log_student WHERE id = (
            SELECT MAX(id) FROM log_student WHERE student=$partyid
        )");
        $q = $q->row_array();
        $source = $q['user'];

        $data['user'] = $source;
        $data['status'] = $status;
        $data['tm'] = time();
        $data['dte'] = date('Y-m-d');
        $data['student'] = $partyid;
        $this->db->insert('log_student',$data);

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
    function whereCount($field,$val = '')
    {
        if(is_array($field) and $val == '')
        {
            foreach($field as $key => $value)
            {
                $this->db->where($key,$value);
            }
        }
        else
        {
            $this->db->where($field,$val);
        }
        return $this->db->count_all_results('log_student');
    }
}