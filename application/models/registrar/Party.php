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
                                              WHERE (legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname) LIKE '%$id%' ) AND partytype = '3' LIMIT 8");
            }
            else{
                $party_id = $this->db->query("SELECT * FROM tbl_party
                                              WHERE (legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname) LIKE '%$id%')
                                              AND status = '$status' AND partytype = '3' LIMIT 8");
            }
            return $party_id->result_array();
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
            $this->db->where('partytype',3);
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
	}