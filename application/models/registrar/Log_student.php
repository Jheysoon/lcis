<?php
/**
 * @date    : 4/28/2015
 * @author  : Jayson Martinez
 */

class Log_student extends CI_Model
{
    function insert_not_exists($id)
    {
        $this->db->trans_begin();
        $this->db->where('student',$id);
        $q = $this->db->count_all_results('log_student');
        if($q < 1)
        {
            $data['student'] = $id;
            $data['status'] = 'O';
            $this->db->insert('log_student',$data);
        }
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
}