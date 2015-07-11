<?php
	class Assesment extends CI_Model
	{
		function getstudinfo($legacyid){
			$this->db->where('legacyid', $legacyid);
			$this->db->select('id, firstname, middlename, lastname');
			return $this->db->get('tbl_party')->row_array();
		}
		function getAcadinfo($partyid){
			$phasterm = $this->api->systemValue();
			$x = $phasterm['phaseterm'];
		  $u = 	$this->getBi($partyid);
			if ($u > 0) {
				return $this->db->query("SELECT tbl_enrolment.id as enrolid, student, coursemajor, academicterm, CONCAT(systart,'-', syend) as sy, term as sem FROM tbl_enrolment, tbl_academicterm WHERE student = '$partyid' AND tbl_enrolment.academicterm = '$x' and tbl_enrolment.academicterm = tbl_academicterm.id")->row_array();
			}else{
				return $this->db->query("SELECT tbl_enrolment.id as enrolid, student, coursemajor, academicterm, CONCAT(systart,'-', syend) as sy, term as sem FROM tbl_enrolment, tbl_academicterm WHERE student = '$partyid' AND tbl_enrolment.academicterm = tbl_academicterm.id ORDER BY academicterm DESC LIMIT 1")->row_array();
			}
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
			$term = $aca['phaseterm'];
			$ph = $aca['phase'];
			$q = $this->db->query("SELECT SUM(amount) as amount FROM tbl_movement WHERE account = '$m'")->row_array();
			extract($q);
			return  $amount;
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
			 $x = $this->get_phase();
			 $y = $this->db->query("SELECT * FROM tbl_enrolment WHERE academicterm = '$x' AND id = '$enrolid'")->num_rows();
			return $y;
		}
		// Getting the Amount Override.
		function get_override($student, $enrolid){
			$x = $this->api->systemValue();
			$phase = $x['phase'];
			$xy = $this->get_phase();

			$array = array('student' => $student, 'phase' => $phase, 'academicterm' => $xy);
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
		function getCourseMajorId($enrolid){
			$this->db->where('id',$enrolid);
			$this->db->select('coursemajor');
			$x = $this->db->get('tbl_enrolment')->row_array();
			return $x['coursemajor'];
		}
		function get_all_enrol($enrolid){
			$this->db->where('id', $enrolid);
			return $this->db->get('tbl_enrolment')->row_array();
		}
		function getAllPayments($enrolid){
			$this->db->where('enrolment', $enrolid);
			$this->db->select('id');
			$x = $this->db->get('tbl_billclass')->row_array();
			$billid = $x['id'];
			return $this->db->query("SELECT * FROM tbl_billclassdetail a, tbl_fee b, tbl_feetype c WHERE bill = '$billid' AND a.fee = b.id AND b.feetype = c.id AND miscellaneous = '0'")->result_array();
		}
		function getMiscellaneouse($enrolid)
		{
				$this->db->where('enrolment', $enrolid);
				$this->db->select('id');
				$x = $this->db->get('tbl_billclass')->row_array();
				$billid = $x['id'];
				$m = $this->db->query("SELECT SUM(a.amount) as misc FROM tbl_billclassdetail a, tbl_fee b, tbl_feetype c WHERE bill = '$billid' AND a.fee = b.id AND b.feetype = c.id AND miscellaneous = 1")->row_array();
				return $m['misc'];
		}
		function getDiscount($student)
		{
				$disc = 	$this->db->query("SELECT discount FROM tbl_billdiscount WHERE student = '$student'")->row_array();
				$di = $disc['discount'];
				$r = $this->db->query("SELECT * FROM tbl_discount WHERE id = '$di'")->row_array();
				return $r['percent'] / 100;
		}
		function getT($m, $enrolid)
		{
				$l = $this->db->query("SELECT * FROM tbl_billclass WHERE enrolment = '$enrolid'")->row_array();
				$r = $l['tuition'] * $m;
				if ($r <= 0) {
						return $l['netfullpayment'];
				}else{
						return $l['installment'] - $r;
				}
	}
		function getAmount($enrolid)
		{
					//$m = 	$this->db->query("SELECT netenrolment FROM tbl_billclass WHERE enrolment = '$enrolid'")->row_array();
					$this->db->where('enrolment', $enrolid);
					$this->db->select('netenrolment');
					$m = $this->db->get('tbl_billclass')->row_array();
					return $m['netenrolment'];
		}
		function get_ph($phT){
					//	$x = $this->db->query("SELECT description FROM tbl_phase WHERE id = '$phT'")->row_array();
					$this->db->where('id', $phT);
					$this->db->select('description');
					$x = $this->db->get('tbl_phase')->row_array();
					return $x['description'];
		}
		function getAmountNetPre($enrolid)
		{
					//	$m = 	$this->db->query("SELECT netprelim FROM tbl_billclass WHERE enrolment = '$enrolid'")->row_array();
						$this->db->where('enrolment', $enrolid);
						$this->db->select('netprelim');
						$x = $this->db->get('tbl_billclass')->row_array();
						return $x['netprelim'];
		}
		function getBi($student)
		{
						$sy = $this->get_phase();
						return $this->db->query("SELECT * FROM tbl_enrolment WHERE student = '$student' AND academicterm = '$sy'")->num_rows();
		}
		function getBillingIds($enrolid)
		{
						$this->db->where('enrolment', $enrolid);
						$this->db->select('id');
						$x = $this->db->get('tbl_billclass')->row_array();
						return $x['id'];
		}
		function getCrs($enrolid)
		{
						$this->db->where('id', $enrolid);
						$this->db->select('coursemajor');
						$x = $this->db->get('tbl_enrolment')->row_array();
						return $x['coursemajor'];
		}
		function insertpayment($billid, $amountpaid, $or_no, $phaseterm, $phase, $uid, $or_date)
		{
						//INSERTING IN table tbl_payment
							$data = array('paymenttype' => 1,
														'billing'	=> $billid,
														'officialreceipt' => $or_no,
														'academicterm' => $phaseterm,
														'phase' => $phase,
														'cashier' => $uid,
														'amount' => $amountpaid,
														'ordate' => $or_date);
							$this->db->insert('tbl_payment', $data);
		}
		function checkpayment($billid)
		{
				$this->db->where('billing', $billid);
				return $this->db->get('tbl_payment')->num_rows();
		}
		function insertmovement($billid, $coursemajor)
		{
				$getAcad = $this->api->systemValue();
				$academicterm = $getAcad['phaseterm'];
				$accountingset = $getAcad['accountingset'] + 1;
				$systemdate = Date('Y-m-d');

						//SELECT ALL ACCOUNT FROM THE TABLE OF TBL_BILLCLASSDETAIL OF THE STUDENT BASE ON HIS/HER ENROLMENT ID.
						$x = $this->db->query("SELECT d.id as account, a.bill, c.accounttype, c.description, a.amount, b.coursemajor FROM tbl_billclassdetail a, tbl_fee b, tbl_feetype c, tbl_accounttype e, tbl_account d
						WHERE a.bill = '$billid' AND a.fee = b.id AND b.feetype = c.id AND c.accounttype = e.id AND d.seq = '$coursemajor' and d.accounttype = e.id")->result_array();

					//INSERT ALL INCOME ACCOUNTS IN THE MOVEMENT TABLE
							foreach ($x as $key => $value) {
								extract($value);
												$data = array('account' => $account,
																	'accountingset' => $accountingset,
																	'academicterm' => $academicterm,
																	'systemdate' => $systemdate,
																	'valuedate' => $systemdate,
																	'referencetype' => $getAcad['phase'],
																	'referenceid' => $billid,
																	'previousbalance' => '',
																	'type' => 'C',
																	'amount' => '-'.$amount,
																	'controlledby' => 1
																);
									$this->db->insert('tbl_movement', $data);
							}
					//INSERT ACOUNT RECEVABLE IN TBL_MOVEMENT AND STUDENT ACCOUNT.
					$getAccountId = $this->db->query("SELECT a.student, c.id as accounts, b.netenrolment FROM tbl_enrolment a, tbl_billclass b, tbl_account c
						 																WHERE b.id = '$billid' AND a.id = b.enrolment AND c.party = a.student")->row_array();
					extract($getAccountId);

					$datas = array('account' => $accounts,
												'accountingset' => $accountingset,
												'academicterm' => $academicterm,
												'systemdate' => $systemdate,
												'valuedate' => $systemdate,
												'referencetype' => $getAcad['phase'],
												'referenceid' => $billid,
												'previousbalance' => '',
												'type' => 'D',
												'amount' => $netenrolment,
												'controlledby' => 1
											);
					$this->db->insert('tbl_movement', $datas);
					//INSERT ACOUNT RECEVABLE IN TBL_MOVEMENT AND SCHOOL ACCOUNT.
					$getSchoolAccount = $this->db->query("SELECT coursemajor, c.id as accounting FROM tbl_billclass a, tbl_enrolment b, tbl_account c WHERE
					a.id = 3 and a.enrolment = b.id and c.seq = b.coursemajor and c.accounttype = 4 and party = 1")->row_array();
					extract($getSchoolAccount);
					$getTotalPayment = $this->totalPayments($billid);
					$thisammount = $getTotalPayment - $netenrolment;
					$school = array('account' => $accounting,
												'accountingset' => $accountingset,
												'academicterm' => $academicterm,
												'systemdate' => $systemdate,
												'valuedate' => $systemdate,
												'referencetype' => $getAcad['phase'],
												'referenceid' => $billid,
												'previousbalance' => '',
												'type' => 'D',
												'amount' => $thisammount,
												'controlledby' => 1
											);
						$this->db->insert('tbl_movement', $school);

			}
			function totalPayments($billid){
						$this->db->where('id', $billid);
						$this->db->select('installment');
						$x = $this->db->get('tbl_billclass')->row_array();
						return $x['installment'];
			}
			function paymentmovement($am, $paymentid, $billid, $counted)
			{
							$getAcad = $this->api->systemValue();
							$academicterm = $getAcad['phaseterm'];
							$accountingset = $getAcad['accountingset'] + 1;
							$systemdate = Date('Y-m-d');
							//Getting the STUDENT ID from tbl_enrolment and Getting the Account ID from tbl_account Base on student party_id
							$getAccountId = $this->db->query("SELECT a.student, c.id as accounts FROM tbl_enrolment a, tbl_billclass b, tbl_account c WHERE b.id = '$billid' AND a.id = b.enrolment AND c.party = a.student")->row_array();
							extract($getAccountId);

							$datas = array('account' => $accounts,
														'accountingset' => $accountingset,
														'academicterm' => $academicterm,
														'systemdate' => $systemdate,
														'valuedate' => $systemdate,
														'referencetype' => 6,
														'referenceid' => $paymentid,
														'previousbalance' => '',
														'type' => 'C',
														'amount' => $am,
														'controlledby' => 1
													);
							$this->db->insert('tbl_movement', $datas);
							$datax = array('accountingset' => $accountingset);
							$this->db->update('tbl_systemvalues',$datax);
							if ($counted == 1) {

							}else{
									$getSchoolAccount = $this->db->query("SELECT coursemajor, c.id as accounting, netprelim FROM tbl_billclass a, tbl_enrolment b, tbl_account c WHERE
									a.id = 3 and a.enrolment = b.id and c.seq = b.coursemajor and c.accounttype = 4 and party = 1")->row_array();
									extract($getSchoolAccount);
									$getTotalPayment = $this->totalPayments($billid);
								//$thisammount = $getTotalPayment - $netenrolment;
									$school = array('account' => $accounting,
																'accountingset' => $accountingset,
																'academicterm' => $academicterm,
																'systemdate' => $systemdate,
																'valuedate' => $systemdate,
																'referencetype' => 6,
																'referenceid' => $paymentid,
																'previousbalance' => '',
																'type' => 'C',
																'amount' => '-'.$netprelim,
																'controlledby' => 1
															);
										$this->db->insert('tbl_movement', $school);
							}
			}
			function getAmountPaid($student, $enrolid)
			{
						$x = $this->getBillingIds($enrolid);
						$getAcad = $this->api->systemValue();
						$phase = $getAcad['phase'];
						$phaseterm = $getAcad['phaseterm'];

						$this->db->where('billing', $x);
						$this->db->where('academicterm', $phaseterm);
						$this->db->where('phase', $phase);
						$this->db->select_sum('amount');
						$am = $this->db->get('tbl_payment')->row_array();
						return $am['amount'];
			}
			function getifExistpayment($enrolid){
							$x = $this->getBillingIds($enrolid);
							$getAcad = $this->api->systemValue();
							$acad = $getAcad['phaseterm'];
							$m = $this->db->query("SELECT COUNT(*) FROM tbl_payment WHERE billing = '$x' AND academicterm = '$acad'")->row_array();
							return $m = 1;

			}
			function balanceenrolment($id){
				$m = $this->get_account($id);
				$aca = $this->api->systemValue();
				$term = $aca['phaseterm'];
				$ph = $aca['phase'];
				$q = $this->db->query("SELECT SUM(amount) as amount FROM tbl_movement WHERE account = '$m' AND academicterm != '$term'")->row_array();
				extract($q);
				return  $amount;
			}
}
