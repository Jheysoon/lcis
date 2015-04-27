<?php
/*
| -------------------------------------
| @file  : Studentgrade.php
| @date  : 4/26/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Studentgrade extends CI_Model{

    function save_grade($class_allocid,$grade,$enrolment)
    {
        $data['semgrade'] = $grade;
        $data['enrolment'] = $enrolment;
        $data['classallocation'] = $class_allocid;

        $this->db->insert('tbl_studentgrade',$data);
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
}