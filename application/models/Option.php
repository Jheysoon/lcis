<?php
/**
 * @date    : 4/10/2015
 * @author  : Jayson Martinez
 */

class Option extends CI_Model{

    function getUserMenu($user_id)
    {
        $this->db->where('userid',$user_id);
        $q = $this->db->get('tbl_useroption');
        return $q->result_array();
    }

    function getOption($option_id)
    {
        $this->db->where('id',$option_id);
        $q = $this->db->get('tbl_option');
        return $q->row_array();
    }

}