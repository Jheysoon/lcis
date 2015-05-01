<?php
/*
| -------------------------------------
| @file  : Studentgrade.php
| @date  : 4/26/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Studentgrade extends CI_Model{

    function save_grade_returnId($class_allocid,$grade,$enrolment)
    {
        $data['semgrade'] = $grade;
        $data['enrolment'] = $enrolment;
        $data['classallocation'] = $class_allocid;
        $this->db->trans_begin();
        $this->db->insert('tbl_studentgrade',$data);
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
    function update_grade($student_grade_id,$grade_id)
    {
        $this->db->trans_begin();
        $this->db->query("UPDATE tbl_studentgrade SET semgrade = $grade_id WHERE id = $student_grade_id");

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
    function delete_grade($id)
    {
        $this->db->trans_begin();
        $this->db->query("DELETE FROM tbl_studentgrade WHERE id = $id");
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
    function delete($eid)
    {
        $this->db->where('enrolment',$eid);
        $this->db->delete('tbl_studentgrade');
    }
    function all($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('tbl_studentgrade');
        return $q->result_array();
    }
    function get_reexam($sid)
    {
        $this->db->where('id',$sid);
        $q = $this->db->get('tbl_studentgrade');
        $q = $q->row_array();
        return $q['reexamgrade'];
    }
    function update_reexam_grade($student_grade_id,$grade_id)
    {
        $this->db->trans_begin();
        $this->db->query("UPDATE tbl_studentgrade SET reexamgrade = $grade_id WHERE id = $student_grade_id");

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