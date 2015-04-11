<?php
/**
 * @date    : 4/10/2015
 * @author  : Jayson Martinez
 */

class Option extends CI_Model
{

    function getOption($option_id)
    {
        $this->db->where('id', $option_id);
        $q = $this->db->get('tbl_option');
        return $q->row_array();
    }
}