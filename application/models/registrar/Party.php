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
            $status = $this->session->userdata('status');
            if($status == 'N'){
                $party_id = $this->db->query("SELECT * FROM tbl_party
                                              WHERE legacyid LIKE '%$id%'
													 OR CONCAT(lastname, ' ', firstname) LIKE '%$id%'
													 OR CONCAT(firstname, ' ', lastname) LIKE '%$id%'
													 OR CONCAT(lastname, ', ', firstname) LIKE '%$id%'
													 OR CONCAT(firstname, ', ', lastname) LIKE '%$id%'
												 ");
            }
            else{
                $party_id = $this->db->query("SELECT * FROM tbl_party
                                              WHERE (
													 legacyid LIKE '%$id%'
													 OR CONCAT(lastname, ' ', firstname) LIKE '%$id%'
													 OR CONCAT(firstname, ' ', lastname) LIKE '%$id%'
													 OR CONCAT(lastname, ', ', firstname) LIKE '%$id%'
													 OR CONCAT(firstname, ', ', lastname) LIKE '%$id%'
												 )
                                              AND status = '$status'");
            }
            $p = $party_id->result_array();
            $ite = 0;
            $data = array();
            foreach ($p as $party) {
                $this->db->where('id',$party['id']);
                $q = $this->db->count_all_results('tbl_student');
                if($q > 0)
                {
                    $data[]= array('firstname'=>$party['firstname'],
                                'lastname'=>$party['lastname'],
                                'middlename'=>$party['middlename'],
                                'legacyid'=>$party['legacyid']);
                    $ite++;
                }
                if($ite == 8)
                {
                    break;
                }
            }
            return $data;
        }
        function search_pay($id){
             $party_id = $this->db->query("SELECT * FROM tbl_party
                                              WHERE (legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname) LIKE '%$id%' GROUP BY legacyid")->result_array();
           /*  $p = $party_id->result_array();
            $this->db->where('student', $p['id']);
            $x = $this->db->get('tbl_enrolment');*//*
           $ite = 0;
            $data = array();
            foreach ($p as $party) {
                $this->db->where('id',$party['id']);
                $q = $this->db->count_all_results('tbl_student');
                if($q > 0)
                {
                    $data[]= array('firstname'=>$party['firstname'],
                                'lastname'=>$party['lastname'],
                                'middlename'=>$party['middlename'],
                                'legacyid'=>$party['legacyid']);
                    $ite++;
                }
                if($ite == 8)
                {
                    break;
                }
            }
             return $data;*/
             return $party_id;
       }

        function getStudInfo($id)
        {
            if($this->session->userdata('status') == 'N'){
                $this->db->where('id',$id);
                $q = $this->db->get('tbl_party');
            }else{
                $this->db->where('tbl_party.id',$id);
                $this->db->where('tbl_party.status',$this->session->userdata('status'));
                 $q = $this->db->get('tbl_party');
            }
            return $q->row_array();
        }
		
        function existsID($id)
        {
            $this->db->where('legacyid',$id);
            return $this->db->count_all_results('tbl_party');
        }
		
        function getSchool()
        {
            $this->db->where('partytype',1);
            $this->db->or_where('partytype',5);
            $q = $this->db->get('tbl_party');
            return $q->result_array();
        }
		
        function getSchoolById($id)
        {
            $this->db->where('id',$id);
            $q = $this->db->get('tbl_party');
            return $q->row_array();
        }
		
        function getStatus($id)
        {
            $this->db->where('id',$id);
            $q = $this->db->get('tbl_party');
            return $q->row_array();
        }

        function getInfo($id)
        {
            $q = $this->db->query("SELECT legacyid,id,dateofbirth as dob,firstname,lastname,middlename,placeofbirth as pob,address1,address2 FROM tbl_party WHERE legacyid='$id'");
            return $q->row_array();
        }
		
		function college_school()
		{
			return $this->db->query("SELECT tbl_party.id as id, firstname FROM tbl_school, tbl_party WHERE tertiary = 1 AND tbl_party.id = tbl_school.id")->result_array();
		}
	}