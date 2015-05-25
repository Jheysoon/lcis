<?php 

	class Student extends CI_Model
	{
		function getRows(){
        return $this->db->query("SELECT * FROM tbl_enrolment
                                    GROUP BY student")
            ->num_rows();
		}
		function calculatebill($enid = 2){
			$getEnrolment = $this->db->query("SELECT * FROM tbl_studentgade WHERE enrolment = '$enid'");
			$g = $getEnrolment->result_array();
			foreach ($g as $key => $value) {
				extract($value);
			}

		}

	}