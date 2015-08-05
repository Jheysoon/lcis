<?php

class Party extends CI_Model
{
    function getStudent($sid)
    {
        return $this->db->query("SELECT * FROM tbl_party WHERE id = (SELECT student FROM tbl_enrolment WHERE id = $sid)")->row_array();
    }
}
