<?php
/*
| -------------------------------------
| @file  : Classallocation.php
| @date  : 4/26/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Classallocation extends CI_Model{

    function insert_ca_returnId($subid,$academicterm)
    {
        $data['subject'] = $subid;
        $data['academicterm'] = $academicterm;
        $this->db->trans_begin();
        $this->db->limit(1);
        $this->db->where('academicterm',$academicterm);
        $this->db->where('subject',$subid);
        $c = $this->db->get('tbl_classallocation');
        if($c->num_rows()>1)
        {
            $c = $c->row_array();
            return $c['id'];
        }
        else
        {
            $this->db->insert('tbl_classallocation',$data);
            $id = $this->db->insert_id();
            return $id;
        }
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return 'error';
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
        return $this->db->count_all_results('tbl_classallocation');
    }
    function delete($field, $value)
    {
        $this->db->where($field, $value);
        $this->db->delete('tbl_classallocation');
    }

    function chkClassAlloc($subject,$acam,$course)
    {
        $this->db->where('subject',$subject);
        $this->db->where('academicterm',$acam);
        $this->db->where('coursemajor',$course);
        return $this->db->count_all_results('tbl_classallocation');
    }
}