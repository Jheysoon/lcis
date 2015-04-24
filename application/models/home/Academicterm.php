<?php
/**
 * @date    : 4/24/2015
 * @author  : Jayson Martinez
 */

class Academicterm extends CI_Model{

    function getSY_id($sy,$sem)
    {
        $this->db->where('systart',$sy);
        $this->db->where('term',$sem);
        $q = $this->db->get('tbl_academicterm');
        return $q->row_array();
    }
}