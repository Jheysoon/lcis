<?php
/**
 * @date    : 4/10/2015
 * @author  : Jayson Martinez
 */

class Option extends CI_Model{

    function getUserMenu($header)
    {
        $id = $this->session->userdata('uid');
        $this->db->where('userid',$id);
        $this->db->where('header',$header);
        $q = $this->db->get('tbl_useroption');
        return $q->result_array();
    }

    function getOption($option_id)
    {
        $this->db->where('id',$option_id);
        $q = $this->db->get('tbl_option');
        return $q->row_array();
    }

    function getOptionHeader()
    {
        $user_id = $this->session->userdata('uid');
        $q = $this->db->query("SELECT * FROM tbl_useroption,option_header WHERE userid = $user_id GROUP BY header ORDER BY priors ASC");
        return $q->result_array();
    }
    function getHeaderName($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('option_header');
        $q = $q->row_array();
        echo $q['name'];
    }

}