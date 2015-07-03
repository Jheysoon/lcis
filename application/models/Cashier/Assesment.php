<?php 
	class Assesment extends CI_Model
	{
		function getstudinfo($legacyid){
			$this->db->where('legacyid', $legacyid);
			$this->db->select('id, firstname, middlename, lastname');
			return $this->db->get('tbl_party')->row_array();
		}
		function getAcadinfo($partyid){
			return $this->db->query("SELECT tbl_enrolment.id as enrolid, student, coursemajor, academicterm, CONCAT(systart,'-', syend) as sy, term as sem FROM tbl_enrolment, tbl_academicterm WHERE student = '$partyid' AND tbl_academicterm.id = tbl_enrolment.academicterm ORDER BY academicterm DESC LIMIT 1")->row_array();
		}
		function getSubInfo($enid){
			return $this->db->query("SELECT classallocation, tbl_subject.descriptivetitle, tbl_subject.code, units FROM tbl_studentgrade, tbl_subject, tbl_classallocation WHERE enrolment = '$enid' AND tbl_studentgrade.classallocation = tbl_classallocation.id AND tbl_classallocation.subject = tbl_subject.id")->result_array();
		}
		function getTuition($enrolid){
			$this->db->where('enrolment', $enrolid);
			return  $this->db->get('tbl_billclass')->num_rows();
		}
		function getTotal($enrolid){
			$this->db->where('enrolment', $enrolid);
			return  $this->db->get('tbl_billclass')->row_array();
		}
		function getR($coursemajor, $accounttype){
			$where = "tbl_feetype.id = tbl_fee.feetype AND tbl_fee.coursemajor = " . $coursemajor . " AND accounttype = " . $accounttype;
			$this->db->where($where);
			$this->db->select('`accounttype`, `rate`');
			return  $this->db->get('tbl_fee, tbl_feetype')->row_array();
		}
		function getPhase($id){
			$this->db->where('id', $id);
			return $this->db->get('tbl_phase')->row_array();
		}
		function balance($id){
			$m = $this->get_account($id);
			$aca = $this->api->systemValue();
			$q = $this->db->query("SELECT SUM(previousbalance) as prev, SUM(amount) as amount FROM tbl_movement WHERE account = '$m' AND academicterm != '". $aca['phaseterm'] . "'")->row_array();
			extract($q);
			return  $prev + $amount;
		}
		function get_account($id){
			$this->db->where('party', $id);
			$this->db->select('id');
			$x = $this->db->get('tbl_account')->row_array();
			return $x['id'];
		}
		function get_unit($enrolid){
			$this->db->where('id', $enrolid);
			$this->db->select('totalunit');
			$x = $this->db->get('tbl_enrolment')->row_array();
			return $x['totalunit'];
		}
		function getBilling($enrolid){
			echo $x = $this->get_phase();
			echo $enrolid;
			echo $y = $this->db->query("SELECT * FROM tbl_enrolment WHERE academicterm = '$x' AND id = '$enrolid'")->num_rows();
			return $y;

		}
		// Getting the Amount Override.
		function get_override($student, $enrolid){
			$x = $this->api->systemValue();
			$phase = $x['phase'];
			$xy = $this->get_phase();
			$array = array('student' => $student, 'phase' => $phase, 'academicterm' => $xy, 'enrolment' => $enrolid);
			$this->db->where($array);
			$this->db->select('amount');
			$y = $this->db->get('tbl_paymentoverride')->row_array();
			return $y['amount'];
		}
		function get_phase(){
			$x = $this->api->systemValue();
			$phase = $x['phase'];
			if ($phase != 1) {
				$acad = $x['currentacademicterm'];
			}else{
				$acad = $x['phaseterm'];
			}
			return $acad;
		}
}