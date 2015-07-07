<?php

	class Student extends CI_Model
	{
		function getRows($col){
        return $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
        						 AND tbl_coursemajor.course = tbl_course.id
        						 AND tbl_party.id = tbl_registration.student
        						 AND tbl_course.college = '$col'
        						 GROUP BY student ORDER BY legacyid DESC")
            ->num_rows();
		}
		function getStud($param, $col)
	    {
	        $q = $this->db->query("SELECT tbl_party.id as pid, legacyid, lastname, firstname,  tbl_course.description as description, tbl_coursemajor.major as major
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
	        						 AND tbl_coursemajor.course = tbl_course.id
	        						 AND tbl_party.id = tbl_registration.student
	        						 AND tbl_course.college = '$col'
	        						 GROUP BY student  ORDER BY legacyid DESC LIMIT $param, 15");
	        return $q->result_array();
	    }
	    function getMajor($id){
	        $q = $this->db->query("SELECT description as des FROM tbl_major WHERE id = '$id'");
	        return $q->row_array();
	    }
        function existsID($id, $col)
        {
	        $q = $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
	        						 AND tbl_coursemajor.course = tbl_course.id
	        						 AND tbl_party.id = tbl_registration.student
	        						 AND tbl_course.college = '$col'
	        						 AND legacyid = '$id'");
	        return $q->num_rows();
	      }
		function getStudent($search, $col)
	    {
	        $q = $this->db->query("SELECT legacyid, lastname, firstname
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
	        						 AND tbl_coursemajor.course = tbl_course.id
	        						 AND tbl_party.id = tbl_registration.student
	        						 AND tbl_course.college = '$col'
	        						 AND(
	        						 		legacyid LIKE '%$search%'
	        						 		OR CONCAT(lastname, ' ', firstname) LIKE '%$search%'
	        						 		OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
	        						 	)
	        						 GROUP BY student  ORDER BY legacyid");
	        return $q->result_array();
	    }
	    function getStudInfo($id){
	        $q = $this->db->query("SELECT lastname, firstname, tbl_coursemajor.major as major,
								 tbl_coursemajor.course as course, tbl_course.description as
	        					 description, tbl_coursemajor.id as cid, tbl_registration.curriculum as curriculum,
	        					 tbl_registration.date as dte, tbl_party.id as pid
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
	        						 AND tbl_coursemajor.course = tbl_course.id
	        						 AND tbl_party.id = tbl_registration.student
	        						 AND tbl_party.legacyid = '$id'
	        						 ");
	        return $q->row_array();
	    }
			//Insert Bill Detail
			function insertbilldetail($enid, $billid, $fid, $the_rate){
							$billcheck = $this->db->query("SELECT COUNT(*) as counted FROM tbl_billclassdetail WHERE bill = '$billid' AND fee = '$fid'")->row_array();
							if ($billcheck['counted'] == 0) {
								$billdetails = array('bill' => $billid, 'fee' => $fid, 'amount' => $the_rate);
								$this->db->insert('tbl_billclassdetail', $billdetails);
							}else{
								$billdetails = array('bill' => $billid, 'fee' => $fid, 'amount' => $the_rate);
								$this->db->where('bill', $billid);
								$this->db->where('fee', $fid);
								$this->db->update('tbl_billclassdetail', $billdetails);
							}
			}

		//Calculation for for the billing of a student based on enrolment
		function getCalculation($enid){
			$computer = 0;
			$booklet = 0;
			$netenrol = 0;
			$tuition = 0;
			$mat = 0;
			$totalbook = 0;
			$totaltuition = 0;
			$laboratory = 0;
			$miscellaneous = 0;
			$internetfee = 0;
			$discount = 0;
			$nstp = 0;
			$leytetymes = 0;
			$the_rate = 0;
			$this->db->where('id', $enid);
			extract($this->db->get('tbl_enrolment')->row_array());

					$bs = $this->db->query("SELECT COUNT(*) as counted FROM tbl_billclass WHERE enrolment = '$enid'")->row_array();
					echo $bs['counted'];
					if ($bs['counted'] == 0){
						//Insert into tbl_bill for the ID and get the last insert
						$nows = Date('Y-m-d');
								//Begin Transaction for the billing base on the evaluation.
					//	$this->db->trans_begin();
						$insertbill = array('requestedby' => $student,
																'datecreated' => $nows,
																'enteredby' => $this->session->userdata('uid'),
																'status' => 'E',
																'type' => '1'
																);
							$this->db->insert('tbl_bill', $insertbill);
							$billid = $this->db->insert_id();
					}else{
						$this->db->where('enrolment', $enid);
						$this->db->select('id as bills');
						extract($this->db->get('tbl_billclass')->row_array());
						echo $billid = $bills;
					}
					//Get all the fee type in tbl_feetype and the rate.
					$where = "tbl_feetype.id = tbl_fee.feetype AND tbl_fee.coursemajor = " . $coursemajor;
					$this->db->where($where);
					$this->db->select('`tbl_fee.id as fid`, `description`, `code`, `accounttype`, `rate`');
			//Get all account code and Rate each account.
			foreach ($this->db->get('tbl_fee, tbl_feetype')->result_array() as $key => $val) {
					extract($val);
	 							 if ($accounttype == 23){
	 							 	$m = $this->getEn($enid);
	 							 	foreach ($m as $key => $value) {
						 				extract($value);
 							 			$x = $this->getSubs($classallocation);
			 							 		if($x['computersubject'] == 1) {
			 							 						 $computer = $rate;
																	$the_rate = $computer;
																	$this->insertbilldetail($enid, $billid, $fid, $the_rate);
									 							 break;
						 							}
											}
	 							 }elseif($accounttype == 24){
	 							 	$m = $this->getEn($enid);
	 							 	foreach ($m as $key => $ms)
										{
	 							 		extract($ms);
 							 			$xl = $this->getSubs($classallocation);
			 							 		if($xl['bookletcharge'] == 1)
													{
			 							 						 	$booklet = $rate;
																	$the_rate = $booklet;
																			$this->insertbilldetail($enid, $billid, $fid, $the_rate);
									 							  break;
						 							}
							 			}
	 							}
								elseif ($accounttype == 19)
								{
		 							 	if ($coursemajor == 5)
											{
	 							 					 $laboratory = $rate;
														$the_rate = $laboratory;
																$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							 		}
	 							 }
									elseif($accounttype == 6)
										{
												 		$mat = $rate * $totalunit;
													$the_rate = $mat;
															$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							  }
										elseif ($accounttype == 7 )
										{
		 											 	$tuition = $rate * $totalunit;
														$the_rate = $tuition;
														$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							  }
										elseif($accounttype == 20)
										{
		 									 			$leytetymes = $rate;
														$the_rate = $leytetymes;
														$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							  }
										elseif($accounttype == 22)
										{
		 							 			 		$internetfee = $rate;
														$the_rate = $internetfee;
														$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							  }
										elseif($accounttype == 21)
										{
		 							 		$m = $this->getEn($enid);
			 							 	foreach ($m as $key => $value)
												{
								 				extract($value);
		 							 			$x = $this->getSubs($classallocation);
					 							 		if($x['nstp'] == 1)
															{
					 							 					 	$nstp = $rate;
																		$the_rate = $nstp;
																		$this->insertbilldetail($enid, $billid, $fid, $the_rate);
											 							 break;
								 							}
													}
		 							 }
										else
										{
		 										 	$miscellaneous += $rate;
													$the_rate = $rate;
													$this->insertbilldetail($enid, $billid, $fid, $the_rate);
		 							  }
										//echo $fid . "|" . $the_rate . "|" . $billid  . "<br />";
	 							 }
									$discount = 10/100;
									$netfull = $tuition * $discount;
									$install = $tuition / 5;
									$totalbook = $booklet * $numberofsubject * 4;
									$fullpaydiscount = $tuition * $discount;
									$discounted = $tuition - $fullpaydiscount;
									$computerdevided = $computer / 5;
									$int = $internetfee / 4;
									$bookfee = $numberofsubject * $booklet;
									$netfullpayment = $discounted + $mat + $laboratory + $miscellaneous + $leytetymes + $nstp + $internetfee + $computer + $totalbook;
									$netenrolment = $install + $computerdevided + $miscellaneous + $laboratory + $leytetymes + $nstp + $mat;
									$netprelim = $install + $computerdevided + $int + $bookfee;
									$installment =  $tuition + $mat + $laboratory + $miscellaneous + $leytetymes + $nstp + $internetfee + $computer + $totalbook;
									$q = $this->db->query("SELECT COUNT(*) as counted FROM tbl_billclass WHERE enrolment = '$enid'")->row_array();

								//Check if billing is created, if it is created it will automatically updated, if not it will be inserted.
									if ($q['counted'] == 0){
											$data = array(
											'id' => $billid,
											'enrolment' => $enid,
											'tuition' => $tuition,
											'matriculation' => $mat,
											'laboratory' => $laboratory,
											'miscellaneous' => $miscellaneous,
											'leytetime' => $leytetymes,
											'nstp' => $nstp,
											'internet' => $internetfee,
											'computer' => $computer,
											'booklet' => $booklet,
											'discount' => $discount,
											'installment' => $installment,
											'fullpaydiscount' => $fullpaydiscount,
											'netfullpayment' =>$netfullpayment,
											'netenrolment' => $netenrolment,
											'netprelim' => $netprelim,
											'netmidterm' =>$netprelim,
											'netsemi' => $netprelim,
											'netfinal' => $netprelim
										);
											$this->db->insert('tbl_billclass', $data);
											return 0;
									}else{
										$datax = array(
											'enrolment' => $enid,
											'tuition' => $tuition,
											'matriculation' => $mat,
											'laboratory' => $laboratory,
											'miscellaneous' => $miscellaneous,
											'leytetime' => $leytetymes,
											'nstp' => $nstp,
											'internet' => $internetfee,
											'computer' => $computer,
											'booklet' => $booklet,
											'discount' => $discount,
											'installment' => $installment,
											'fullpaydiscount' => $fullpaydiscount,
											'netfullpayment' =>$netfullpayment,
											'netenrolment' => $netenrolment,
											'netprelim' => $netprelim,
											'netmidterm' =>$netprelim,
											'netsemi' => $netprelim,
											'netfinal' => $netprelim
										);
										$this->db->where('enrolment', $enid);
										$this->db->update('tbl_billclass', $datax);
									}
					//first Transaction to execute
				//	if ($this->db->trans_status() === FALSE)
				//	{
							//		$this->db->trans_rollback();
					//}
					//else
					//{
						//			$this->db->trans_commit();
					//}

			}
		//For rounding money value
		function rounded($val){
			return $x = round($val, 0, PHP_ROUND_HALF_UP);
		}
		//Get All Subject based on Enrolment ID.
		function getEn($enid){
			$this->db->where('enrolment', $enid);
			return $this->db->get('tbl_studentgrade')->result_array();
		}
		//Get All Subject from Class Allocation Based on Class Allocation ID.
		function getSubs($classallocation){
			return $xl = $this->db->query("SELECT * FROM `tbl_subject` WHERE tbl_subject.id = (SELECT subject FROM tbl_classallocation WHERE tbl_classallocation.id = '$classallocation')")->row_array();
		}
		//Get Academicterm Based On ID.
		function getAcTerm($id){
			$this->db->where("id", $id);
			$q = $this->db->get("tbl_academicterm");
			return $q->row_array();
		}

		function getYearLevel($id){
			$q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_academicterm
								   WHERE tbl_enrolment.academicterm = tbl_academicterm.id
								   AND tbl_academicterm.term != 3
								   AND tbl_enrolment.student = '$id'");
			return $q->num_rows();
		}
		function getAllCur($curriculum){
			$where = 'tbl_curriculum.academicterm = tbl_academicterm.id AND tbl_curriculum.id = '.$curriculum;
			$this->db->where($where);
			$this->db->select("`systart`, `syend`");
			$q = $this->db->get("tbl_curriculum, tbl_academicterm");
			return $q->row_array();
		}
		//Get Class Allocation
		function getClassAloc($academicterm, $student, $course){

			$q = $this->db->query("SELECT * FROM tbl_classallocation
								   WHERE academicterm = '$academicterm'
								   AND coursemajor = '$course'
								   AND subject NOT IN(SELECT subject FROM
								   	tbl_studentgrade, tbl_classallocation, tbl_enrolment
								   	WHERE tbl_studentgrade.classallocation = tbl_classallocation.id
								   	AND tbl_enrolment.id = tbl_studentgrade.enrolment
								   	AND tbl_enrolment.id = '$student')
									GROUP BY subject
								   ");
			return $q->result_array();
		}

		function getClassAloc2($academicterm, $student, $course, $subject){

			$q = $this->db->query("SELECT * FROM tbl_classallocation, tbl_subject
								   WHERE academicterm = '$academicterm'
								   AND coursemajor != '$course'
								   AND subject NOT IN(SELECT subject FROM
								   	tbl_studentgrade, tbl_classallocation, tbl_enrolment
								   	WHERE tbl_studentgrade.classallocation = tbl_classallocation.id
								   	AND tbl_enrolment.id = tbl_studentgrade.enrolment
								   	AND tbl_enrolment.id = '$student')
									AND tbl_classallocation.subject = tbl_subject.id
									AND (tbl_subject.code LIKE '%$subject%'
									OR tbl_subject.descriptivetitle LIKE '%$subject%')
									GROUP BY subject
								   ");
			return $q->result_array();
		}


		function getSubDetail($subject){
			$this->db->where('id', $subject);
			$q = $this->db->get('tbl_subject');
			return $q->row_array();
		}

		function getSched($id, $sub){
			$where = 'academicterm='.$id.' AND subject='.$sub;
			$this->db->where($where);
			$q = $this->db->get('tbl_classallocation');
			return $q->result_array();
		}

		function getSubject($cid){
			$where = 'tbl_classallocation.id='.$cid.' AND tbl_classallocation.subject=tbl_subject.id';
			$this->db->where($where);
			$this->db->select('code');
			$q = $this->db->get('tbl_classallocation, tbl_subject');
			return $q->row_array();
		}

		// function getDP($id){
		// 	$q = $this->db->query("SELECT * FROM tbl_day, tbl_period, tbl_dayperiods
		// 						   WHERE tbl_dayperiods.day = tbl_day.id
		// 						   AND tbl_dayperiods.period = tbl_period.id
		// 						   AND tbl_dayperiods.id = $id
		// 						  ");
		// 	return $q->row_array();
		// }

		function getRoom($id){
			$q = $this->db->query("SELECT legacycode, tbl_location.description as loc FROM tbl_classroom, tbl_location
								   WHERE tbl_classroom.location = tbl_location.id
								   AND tbl_classroom.id = $id
								  ");
			return $q->row_array();
		}

		function getSpecificAllocation($id){
			$this->db->where('id', $id);
			$this->db->select('dayperiod');
			$q = $this->db->get('tbl_classallocation');
			return $q->row_array();
		}

		function getRegID($student){
			$q = $this->db->query("SELECT id FROM tbl_registration
								   WHERE student = '$student' ORDER BY id DESC LIMIT 1
								  ");
			extract($q->row_array());
			return $id;
		}

		function getUnits($id){
			$q = $this->db->query("SELECT units, nonacademic FROM tbl_subject
								   WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = '$id')
								  ");
			return $q->row_array();
		}

		function addEnrolment($count, $student, $coursemajor, $registration, $academicterm, $units, $status){
			$data = array(
				'student' => $student,
				'coursemajor' => $coursemajor,
				'registration' => $registration,
				'academicterm' => $academicterm,
				'totalunit' => $units,
				'school' => 1,
				'dte' => date('Y-m-d'),
				'numberofsubject' => $count,
				'status' => $status
			);

			$this->db->insert('tbl_enrolment', $data);
			return $this->db->insert_id();
		}

		function addInitialGrade($alloc, $enrolment){
			$data = array(
				'classallocation' => $alloc,
				'enrolment' => $enrolment
			);

			$this->db->insert('tbl_studentgrade', $data);
		}

		function updateReserved($id, $count){
			$data = array(
				'reserved' => $count
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_classallocation', $data);
		}

		function getReserved($id){
			$this->db->where('id', $id);
			$this->db->select('reserved');
			return $this->db->get('tbl_classallocation')->row_array();
		}

		function updateEnrolled($id, $count){
			$data = array(
				'enrolled' => $count
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_classallocation', $data);
		}

		function getEnrolled($id){
			$this->db->where('id', $id);
			$this->db->select('enrolled');
			return $this->db->get('tbl_classallocation')->row_array();
		}

		function getUnit($cur, $level, $term){
			$q = $this->db->query("SELECT SUM(units) as unit FROM tbl_curriculumdetail, `tbl_subject`
						WHERE curriculum = '$cur' AND yearlevel = '$level' AND term = '$term' AND
						tbl_curriculumdetail.subject = tbl_subject.id AND nonacademic = 0
			");
			return $q->row_array();
		}

		function checkEvaluation($pid, $term){
			$this->db->where('academicterm', $term);
			$this->db->where('student', $pid);
			$res = $this->db->get('tbl_enrolment');
			return $res->row_array();
		}

		function getEvaluation($id){
			$this->db->where('enrolment', $id);
			$res = $this->db->get('tbl_studentgrade');
			return $res->result_array();
		}

		function deleteEvaluation($id){
			$this->db->where('enrolment', $id);
			$this->db->delete('tbl_studentgrade');
		}

		function updateEnrolment($id, $unit){
			$data = array('totalunit' => $unit);
			$this->db->where('id', $id);
			$this->db->update('tbl_enrolment', $data);
		}
	}
