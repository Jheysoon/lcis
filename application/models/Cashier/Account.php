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
        return $this->db->query("SELECT firstname, lastname, legacyid, tbl_party.id as partyid, tbl_account.id as accounts FROM tbl_account, tbl_party, tbl_movement WHERE
           tbl_account.party = tbl_party.id AND tbl_movement.account = tbl_account.id AND academicterm = 49 AND tbl_party.partytype = 3 LIMIT $limit, 15")->result_array();
    }
    function getStudInfo($id)
    {
        if($this->session->userdata('status') == 'N')
        {
            $this->db->where('id',$id);
            $q = $this->db->get('tbl_party');
        }
        else
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
    function checkexist($type, $dates, $amount, $academicterm, $ref, $desc, $partyid)
    {
        $account = $this->getAccountids($partyid);
        return $this->db->query("SELECT * FROM tbl_movement WHERE account = '$account' AND academicterm = '$academicterm' AND referencetype = '$ref'")->num_rows();
    }
    function updatebillclass($enrolid, $ref, $amount)
    {
          if ($ref == 1) {
            $this->db->query("UPDATE tbl_billclass SET enrolment = '$amount' WHERE netenrolment = '$enrolid'");
          }
          elseif($ref == 2){
            $this->db->query("UPDATE tbl_billclass SET enrolment = '$amount' WHERE netprelim = '$enrolid'");
          }
          elseif ($ref == 3) {
            $this->db->query("UPDATE tbl_billclass SET enrolment = '$amount' WHERE netmidterm = '$enrolid'");
          }
          elseif ($ref == 4) {
            $this->db->query("UPDATE tbl_billclass SET enrolment = '$amount' WHERE netsemi = '$enrolid'");
          }
          elseif ($ref == 5) {
            $this->db->query("UPDATE tbl_billclass SET enrolment = '$amount' WHERE netfinal = '$enrolid'");
          }

    }
    function insertBill($type, $dates, $amount, $academicterm, $ref, $desc, $partyid)
    {
        $uid = $this->session->userdata('uid');
        $enrolid =  $this->getEnrolment($partyid, $academicterm);
        $count = $this->db->query("SELECT * FROM tbl_billclass WHERE enrolment = '$enrolid'")->num_rows();
        if ($count >= 1) {
            $this->updatebillclass($enrolid, $ref, $amount);
        }else{
            $this->db->query("INSERT INTO tbl_bill SET requestedby = '$partyid', enteredby = '$uid', type = '1', datecreated = '$dates' status = 'E'");
            $enr = $this->db->insert_id();
            $this->db->query("INSERT INTO tbl_billcalss SET id = '$enrolid'");
            $billid = $this->db->insert_id();
            $this->updatebillclass($enrolid, $ref, $amount);


            $sys = $this->Api->systemValue();
            $accountingset = $sys['accountingset'] + 1;
            $account = $this->getAccountids($partyid);
            $thisbalance = $this->getbal($account);
            $ts = $thisbalance + $amount;

            $this->insertMovement($type, $dates, $amount, $academicterm, $ref, $desc, $partyid, $billid, $accountingset, $account, $thisbalance, $ts);

        }
    }
    function insertMovement($type, $dates, $amount, $academicterm, $ref, $desc, $partyid,$billid)
    {


          //INSERT INTO MOVEMENT
          $data = 	array('account' => $account,
                      'accountingset' => $accountingset,
                      'academicterm' => $academicterm,
                      'systemdate' => $dates,
                      'valuedate' => $dates,
                      'referencetype' => $ref,
                      'referenceid' => $billid,
                      'previousbalance' => $thisbalance,
                      'type' => $type,
                      'amount' => $amount,
                      'runbalance' => $ts,
                      'controlledby' => 1
                    );
                    $this->db->insert('tbl_movement', $data);
                    $this->setCurrentBallance($account, $ts);

    }
    function getBal($account){
          $x = $this->db->query("SELECT * FROM tbl_account WHERE id = '$account'")->row_array();
          return $x['currentbalance'];
    }
    function getEnrolment($partyid, $academicterm)
    {
        $s = $this->db->query("SELECT * FROM tbl_enrolment WHERE student = '$partyid' AND academicterm = '$academicterm'")->num_rows();
        if ($s >= 1) {
          $this->db->where('student', $partyid);
          $this->db->where('academicterm', $academicterm);
          $this->db->select('id');
          $x = $this->db->get('tbl_enrolment')->row_array();
          $id =  $x['id'];
        }
        else{
          $reg = $this->db->query("SELECT id as regid, coursemajor FROM tbl_registration WHERE student = '$partyid'")->row_array();
          $regid = $reg['regid'];
          $coursemajor = $reg['coursemajor'];
          $this->db->query("INSERT INTO tbl_enrolment SET student = '$partyid', academicterm = '$academicterm', `dte` = '$dates', school = '1', coursemajor = '$coursemajor', registration = '$regid'");
          $id = $this->db->insert_id();
        }
        return $id;
    }
  }
