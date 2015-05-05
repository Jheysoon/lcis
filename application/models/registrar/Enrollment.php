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
        if($status == 'N')
        {
            $status = '';
            $q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_party
                                WHERE coursemajor=5
                                AND  tbl_party.status = '$status'
                                AND tbl_enrolment.student = tbl_party.id
                                GROUP BY tbl_enrolment.student LIMIT $limit,15");
        }
        elseif($this->session->userdata('datamanagement') == 'C')
        {
            $q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_party
                                WHERE coursemajor=5
                                AND  tbl_party.status = '$status'
                                AND tbl_enrolment.student = tbl_party.id
                                GROUP BY tbl_enrolment.student LIMIT $limit,15");
        }
        else
        {
            $uid = $this->session->userdata('uid');
            $q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_party,log_student
                                WHERE coursemajor=5
                                AND  tbl_party.status = '$status'
                                AND tbl_enrolment.student = tbl_party.id
                                AND log_student.user = $uid AND 
                                log_student.student = tbl_party.id
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

    function getEnrollId($acam,$partyid)
    {
        $this->db->where('student',$partyid);
        $this->db->where('academicterm',$acam);
        $q = $this->db->get('tbl_enrolment');
        $q = $q->row_array();
        return $q['id'];
    }
    function delete_enroll($eid)
    {
        $this->db->where('id',$eid);
        $this->db->delete('tbl_enrolment');
    }
}