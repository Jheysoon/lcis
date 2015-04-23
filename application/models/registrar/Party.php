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
            $party_id = $this->db->query("SELECT * FROM tbl_party WHERE legacyid LIKE '$id%' LIMIT 5");
            return $party_id->result_array();
        }
	}