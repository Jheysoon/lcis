<?php 

	class Student extends CI_Model
	{
		function getRows(){
        return $this->db->query("SELECT * FROM tbl_enrolment
                                    GROUP BY student")
            ->num_rows();
		}
	}