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
        $x = $this->api->systemValue();
        $aca = $x['phaseterm'];
        return $this->db->query("SELECT * FROM tbl_account WHERE accounttype = 4 AND seq = 0")->num_rows();
    }
    function getAllmovement($limit = 0){
      $acad = $this->api->systemValue();
      $term = $acad['currentacademicterm'];
        return $this->db->query("SELECT firstname, lastname, legacyid, tbl_party.id as partyid, tbl_account.id as accounts FROM tbl_account, tbl_party, tbl_movement,tbl_enrolment WHERE
           tbl_account.party = tbl_party.id AND tbl_movement.account = tbl_account.id AND tbl_enrolment.academicterm = '$term' AND tbl_party.partytype = 3 AND tbl_enrolment.student = tbl_account.party LIMIT $limit, 15")->result_array();
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
        return $this->db->query("SELECT * FROM tbl_movement WHERE academicterm = '$acad' AND account = '$param' ORDER by systemdate, valuedate")->result_array();
    }
    function search_account($id)
    {
        $party_id = $this->db->query("SELECT *, student FROM tbl_party, tbl_enrolment
                               WHERE (legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname) LIKE '%$id%') AND tbl_party.id = student LIMIT 8")->result_array();
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
    function getEnrolmentId($billid)
    {
        $this->db->where('id', $billid);
        $this->db->select('enrolment');
        $x = $this->db->get('tbl_billclass')->row_array();
        return $x['enrolment'];
    }
    function getBillDetail($refid)
    {
        return $this->db->query("SELECT b.rate, c.description, a.amount FROM tbl_billclassdetail a, tbl_fee b, tbl_feetype c WHERE bill = '$refid' AND b.id = a.fee and c.id = b.feetype GROUP BY c.description ORDER by c.id")->result_array();
    }
    function getTotalUnit($enr)
    {
        $this->db->where('id', $enr);
        $this->db->select('totalunit');
        $x = $this->db->get('tbl_enrolment')->row_array();
        return $x['totalunit'];
    }
    function billclass($enrolmentid)
    {
      $this->db->where('enrolment', $enrolmentid);
      return $this->db->get('tbl_billclass')->row_array();
    }
    function getSubject($enrolmentid)
    {
      return $this->db->query("SELECT c.descriptivetitle, c.units, c.code FROM tbl_studentgrade a, tbl_classallocation b, tbl_subject c WHERE enrolment = '$enrolmentid' AND a.classallocation = b.id AND b.subject = c.id")->result_array();
    }
    function getstudents($refid)
    {
      return $this->db->query("SELECT CONCAT(b.firstname, ' ' , b.middlename, ' ',b.lastname) as fullname, c.coursemajor FROM tbl_bill a, tbl_party b, tbl_registration c WHERE a.id = '$refid' AND b.id = a.requestedby AND c.student = a.requestedby")->row_array();
    }
    function getpayment($refid)
    {
      return $this->db->query("SELECT * FROM tbl_payment WHERE id = '$refid'")->row_array();
    }
    function getphase($phase)
    {
      $x = $this->db->query("SELECT * FROM tbl_phase WHERE id = '$phase'")->row_array();
      return $x['description'];
    }
    function getCashier($id)
    {
      $x = $this->db->query("SELECT CONCAT(b.firstname, ' ' , b.middlename, ' ',b.lastname) as fullname FROM tbl_party b WHERE b.id = '$id'")->row_array();
      return $x['fullname'];
    }
    function getUnit($enrolmentid)
    {
        return $this->db->query("SELECT totalunit, numberofsubject FROM tbl_enrolment WHERE id = '$enrolmentid'")->row_array();
    }
}
