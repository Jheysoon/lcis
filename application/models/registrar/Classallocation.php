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
        $this->db->insert('tbl_classallocation',$data);
        $id = $this->db->insert_id();

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return 'error';
        }
        else
        {
            $this->db->trans_commit();
            return $id;
        }
    }
}