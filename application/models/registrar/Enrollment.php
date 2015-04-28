<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Enrollment extends CI_Model
{

    function getStud($limit)
    {
        $status = $this->session->userdata('status');
        if($status == 'N'){
            $q = $this->db->query("SELECT * FROM tbl_enrolment
                                    WHERE coursemajor=5
                                    GROUP BY student LIMIT $limit,15");
        }
        else{
            $q = $this->db->query("SELECT * FROM tbl_enrolment, log_student
                                    WHERE coursemajor=5
                                    AND  log_student.status = '$status'
                                    AND tbl_enrolment.student = log_student.student
                                    GROUP BY tbl_enrolment.student LIMIT $limit,15");
        }
        return $q->result_array();
    }
    function getRows()
    {
        return $this->db->query("SELECT * FROM tbl_enrolment
                                    WHERE coursemajor=5
                                    GROUP BY student")
            ->num_rows();
    }
    function update_record($id)
    {
        $this->db->trans_begin();

        // count first the number of subject
        $this->db->where('id',$id);
        $q = $this->db->get('tbl_enrolment');
        $q = $q->row_array();

        // if greater than 0
        if($q['numberofsubject'] > 0)
        {
            // update it with minus 1
            $this->db->query("UPDATE tbl_enrolment SET numberofsubject = numberofsubject - 1 WHERE id = $id");
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
    function insert_return_id($data)
    {
        $this->db->trans_begin();
        $this->db->insert('tbl_enrolment',$data);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
        return $id;
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
        return $this->db->count_all_results('tbl_enrolment');
    }

    function getID($enrollid)
    {
        $this->db->where('id',$enrollid);
        $q = $this->db->get('tbl_enrolment');
        return $q->row_array();
    }
}