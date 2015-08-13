<?php

  /**
   *
   */
  class Account extends CI_Model
  {
    function getCategory()
    {
        return $this->db->query("SELECT * FROM tbl_category")->result_array();
    }
    function getAllaccount()
    {
        return $this->db->query("SELECT * FROM tbl_account WHERE accounttype = 4 AND seq = 0")->num_rows();
    }
    function getAllmovement($limit = 0){
        return $this->db->query("SELECT firstname, lastname, legacyid, tbl_party.id as partyid, tbl_account.id as accounts FROM tbl_account, tbl_party WHERE
           tbl_account.party = tbl_party.id LIMIT $limit, 15")->result_array();
    }
    function getStudInfo($id)
    {
        if($this->session->userdata('status') == 'N')
        {
            $this->db->where('id',$id);
            $q = $this->db->get('tbl_party');
        }else
        {
            $this->db->where('tbl_party.id',$id);
            $this->db->where('tbl_party.status',$this->session->userdata('status'));
             $q = $this->db->get('tbl_party');
        }
        return $q->row_array();
    }
    function getCoursemajor($partyid){
       return $this->db->query("SELECT coursemajor FROM tbl_registration WHERE student = '$partyid'")->row_array();
    }
    function getstudent($param)
    {
      return $this->db->query("SELECT firstname, lastname, middlename, id as partyid FROM tbl_party WHERE legacyid = '$param'")->row_array();
    }
    function breakAcad($param)
    {
      return $this->db->query("SELECT a.academicterm as acad, CONCAT(systart, '-', syend) as sy, term FROM tbl_movement a, tbl_academicterm b WHERE a.account = '$param' AND a.academicterm = b.id GROUP by a.academicterm")->result_array();
    }
    function getAccountids($param)
    {
       $x = $this->db->query("SELECT id as accountid FROM tbl_account WHERE party = '$param'")->row_array();
       return $x['accountid'];
    }
    function getmovement($param, $acad){
      return $this->db->query("SELECT * FROM tbl_movement WHERE academicterm = '$acad' AND account = '$param' ORDER by referenceid")->result_array();
    }
    function search_account($id)
    {
      $party_id = $this->db->query("SELECT *, student FROM tbl_party, tbl_enrolment
                               WHERE (legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname LIKE '%$id%')) AND tbl_party.id = student LIMIT 8")->result_array();
                               return $party_id;
    }
    function acad()
    {
      return $this->db->query("SELECT id as acad, CONCAT(systart, '-', syend) as sy, term FROM tbl_academicterm")->result_array();
    }
    
  }
