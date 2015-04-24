<?php 
	/**
	* 
	*/
	class Party extends CI_Model
	{
		function insert_students($data)
		{
			echo $data;
		}

        function searchId($id)
        {
            $party_id = $this->db->query("SELECT * FROM tbl_party WHERE legacyid LIKE '$id%' AND partytype = 3 LIMIT 5");
            return $party_id->result_array();
        }

        function getStudInfo($id)
        {
            $this->db->where('id',$id);
            $q = $this->db->get('tbl_party');
            return $q->row_array();
        }

        /*function get_first_15()
        {
            $q = $this->db->query("SELECT id,legacyid,firstname,lastname FROM tbl_party WHERE partytype=3 LIMIT 100");
            return $q->result_array();
        }*/
	}