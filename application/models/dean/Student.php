<?php

	class Student extends CI_Model
	{
		function getRows($col){
        return $this->db->query("SELECT * FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
        						 AND tbl_coursemajor.course = tbl_course.id
        						 AND tbl_party.id = tbl_registration.student
        						 AND tbl_course.college = '$col'
								 AND tbl_registration.status != 'G'
        						 GROUP BY student ORDER BY legacyid DESC")
            ->num_rows();
		}
		function getRows2(){
        return $this->db->query("SELECT * FROM tbl_registration, tbl_party
        						 WHERE tbl_party.id = tbl_registration.student
								 AND tbl_registration.status != 'G'
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
									 	 	 AND tbl_registration.status != 'G'
	        						 GROUP BY student  ORDER BY legacyid DESC LIMIT $param, 15");
	        return $q->result_array();
	    }
		function getStud2($param)
	    {
	        $q = $this->db->query("SELECT tbl_party.id as pid, legacyid, lastname, firstname,  tbl_course.description as description, tbl_coursemajor.major as major
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
	        						 AND tbl_coursemajor.course = tbl_course.id
	        						 AND tbl_party.id = tbl_registration.student
									 AND tbl_registration.status != 'G'
	        						 GROUP BY student  ORDER BY legacyid DESC LIMIT $param, 15");
	        return $q->result_array();
	    }
	    function getMajor($id){
	        $q = $this->db->query("SELECT description as des FROM tbl_major WHERE id = '$id'");
	        return $q->row_array();
	    }
        function existsID($id)
        {
	        $q = $this->db->query("SELECT tbl_course.college as cid, tbl_college.description as description
													   		 FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party, tbl_college
						        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
						        						 AND tbl_coursemajor.course = tbl_course.id
														 	 	 AND tbl_course.college = tbl_college.id
						        						 AND tbl_party.id = tbl_registration.student
						        						 AND legacyid = '$id'");
	        return $q->row_array();
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
						        						 		OR CONCAT(lastname, ', ', firstname) LIKE '%$search%'
						        						 		OR CONCAT(firstname, ', ', lastname) LIKE '%$search%'
						        						 	)
	        						 					GROUP BY student  ORDER BY legacyid");
	        return $q->result_array();
	    }
		function getStudent2($search)
	    {
	        $q = $this->db->query("SELECT legacyid, lastname, firstname
						        					   FROM tbl_registration, tbl_party
						        						 WHERE tbl_party.id = tbl_registration.student
						        						 AND(
						        						 		legacyid LIKE '%$search%'
						        						 		OR CONCAT(lastname, ' ', firstname) LIKE '%$search%'
						        						 		OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
						        						 		OR CONCAT(lastname, ', ', firstname) LIKE '%$search%'
						        						 		OR CONCAT(firstname, ', ', lastname) LIKE '%$search%'
						        						 	)
	        						 					GROUP BY student  ORDER BY legacyid");
	        return $q->result_array();
	    }
	    function getStudInfo($id){
	        $q = $this->db->query("SELECT lastname, firstname, tbl_coursemajor.major as major, tbl_registration.id as reg,
																 tbl_coursemajor.course as course, tbl_course.description as description,
																 tbl_coursemajor.id as cid, tbl_registration.curriculum as curriculum,
									        			 tbl_registration.date as dte, tbl_party.id as pid
						        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party
						        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id
						        						 AND tbl_coursemajor.course = tbl_course.id
						        						 AND tbl_party.id = tbl_registration.student
						        						 AND tbl_party.legacyid = '$id'
									 						 	 AND tbl_registration.id =
																 (SELECT MAX(a.id) FROM tbl_registration a, tbl_party b
																 WHERE a.student = b.id AND b.legacyid = '$id' )");
	        return $q->row_array();
	    }
			//Insert Bill Detail
			function insertbilldetail($data){
							$this->db->where('bill', $data['bill']);
							$this->db->where('fee', $data['fee']);
							$x = $this->db->get('tbl_billclassdetail')->num_rows();
							if ($x > 0)
							{
								$this->db->where('bill', $data['bill']);
								$this->db->where('fee', $data['fee']);
								$this->db->update('tbl_billclassdetail', $data);
							}
							else
							{
								$this->db->insert('tbl_billclassdetail', $data);
							}
			}
			function enr_info($enid)
			{
					 return $this->db->query("SELECT student as partyid, coursemajor FROM tbl_enrolment WHERE id = '$enid'")->row_array();
			}
			function get_fees($coursemajor)
			{
					return $this->db->query("SELECT  a.id AS fid, a.feetype, a.rate, b.code, b.description, b.miscellaneous
										  	 FROM  `tbl_feetype` b, tbl_fee a
										  	 WHERE a.feetype = b.id
										  	 AND coursemajor = $coursemajor
										  	 AND a.feetype !=19
										  	 AND feetype !=21")->result_array();
			}
			function get_sub_unit($enid)
			{
					$x = $this->db->query("SELECT SUM(units)  as units
											FROM  `tbl_studentgrade` a, tbl_classallocation b, tbl_subject c
											WHERE enrolment =  '$enid'
											AND b.id = a.classallocation
											AND c.id = b.subject
											AND c.nstp = 0")->row_array();
					return $x['units'];
			}
			function get_total_subj($enid)
			{
					$x = $this->db->query("SELECT COUNT(*)  as subjects
														FROM  `tbl_studentgrade` a, tbl_classallocation b, tbl_subject c
														WHERE enrolment =  '$enid'
														AND b.id = a.classallocation
														AND c.id = b.subject")->row_array();
					return $x['subjects'];
			}
			function insert_bill($data)
			{
					$this->db->insert('tbl_bill', $data);
					return $this->db->insert_id();
			}
			function get_chem($enid)
			{
					return $this->db->query("SELECT * FROM `tbl_studentgrade` a, tbl_classallocation b, tbl_subject c
																		WHERE enrolment = '$enid'
																		AND b.id = a.classallocation
																		AND c.id = b.subject AND chemlab = 1")->num_rows();
			}
			function get_comp($enid)
			{
				return $this->db->query("SELECT * FROM `tbl_studentgrade` a, tbl_classallocation b, tbl_subject c
																	WHERE enrolment = '$enid'
																	AND b.id = a.classallocation
																	AND c.id = b.subject AND computersubject = 1")->num_rows();
			}
			function  get_nstp($enid)
			{
				return $this->db->query("SELECT * FROM `tbl_studentgrade` a, tbl_classallocation b, tbl_subject c
										WHERE enrolment = '$enid'
										AND b.id = a.classallocation
										AND c.id = b.subject AND nstp = 1")->num_rows();
			}
			function check_billclass($enid)
			{
				return $this->db->query("SELECT * FROM tbl_billclass WHERE enrolment = '$enid'")->num_rows();
			}
			function get_billid($enid)
			{
				 $x = $this->db->query("SELECT * FROM tbl_billclass WHERE enrolment = '$enid'")->row_array();
				 return $x['id'];
			}
			function getdetail($billid)
			{
				return $this->db->query("SELECT c.id, c.code, c.description, a.amount, b.rate
													FROM `tbl_billclassdetail` a, tbl_fee b, tbl_feetype c
													WHERE b.feetype = c.id AND a.fee = b.id AND a.bill = '$billid'")->result_array();
			}
			function insert_billclass($data)
			{
				$this->db->insert('tbl_billclass', $data);
			}
			function update_billclass($data, $bill)
			{
					$this->db->where('id', $bill);
					$this->db->update('tbl_billclass', $data);
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
		function getYearLevel($id)
		{
			$q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_academicterm
								   WHERE tbl_enrolment.academicterm = tbl_academicterm.id
								   AND tbl_academicterm.term != 3
								   AND tbl_enrolment.student = '$id'");
			return $q->num_rows();
		}
		function getAllCur($curriculum)
		{
			$where = 'tbl_curriculum.academicterm = tbl_academicterm.id AND tbl_curriculum.id = '.$curriculum;
			$this->db->where($where);
			$this->db->select("`systart`, `syend`");
			$q = $this->db->get("tbl_curriculum, tbl_academicterm");
			return $q->row_array();
		}
		//Get Class Allocation
		function getClassAloc($academicterm, $student, $course, $lvl, $cur, $term)
		{
			$q = $this->db->query("SELECT * FROM tbl_classallocation
													   WHERE academicterm = '$academicterm'
													   AND subject IN(
													   SELECT subject FROM tbl_curriculumdetail
													   WHERE curriculum = '$cur'
													   AND yearlevel = '$lvl'
													   AND term = '$term')
													   AND subject NOT IN(SELECT b.subject FROM
													   tbl_studentgrade a, tbl_classallocation b, tbl_enrolment c, tbl_grade d
													   WHERE a.classallocation = b.id
													   AND c.id = a.enrolment
													   AND c.student = $student
														AND (d.id = a.semgrade OR d.id = a.reexamgrade)
														AND d.value <= 3.0 AND description IS NULL)
														GROUP BY subject
														ORDER BY subject");
			return $q->result_array();
		}
		function getClassAloc2($subject, $term)
		{
			$q = $this->db->query("SELECT a.*
								   FROM tbl_subject a, tbl_classallocation b
								   WHERE (a.code LIKE '%$subject%'
								   OR a.descriptivetitle LIKE '%$subject%')
								   AND b.academicterm = '$term'
								   AND a.id = b.subject
								   GROUP BY a.id
								   ORDER BY a.code
								   ");
			return $q->result_array();
		}

		function checkEnrolment($subject, $student)
		{
			$q = $this->db->query("SELECT a.id
								   FROM tbl_studentgrade a, tbl_classallocation b, tbl_enrolment c, tbl_grade d
								   WHERE a.enrolment = c.id
								   AND b.id = a.classallocation
								   AND b.subject = '$subject'
								   AND c.student = '$student'
								   AND (d.id = a.semgrade OR d.id = a.reexamgrade)
								   AND d.value <= 3.0 AND description IS NULL
								   ");
			return $q->num_rows();
		}
		function getSubDetail($subject)
		{
			$this->db->where('id', $subject);
			$q = $this->db->get('tbl_subject');
			return $q->row_array();
		}
		function getSched($id, $sub, $coursemajor)
		{
			$where = 'academicterm='.$id.' AND subject='.$sub;
			$this->db->where($where);
			$q = $this->db->get('tbl_classallocation');
			return $q->result_array();
		}
		function getSched2($id, $sub)
		{
			$where = 'academicterm='.$id.' AND subject='.$sub;
			$this->db->where($where);
			$q = $this->db->get('tbl_classallocation');
			return $q->result_array();
		}

		function getSubject($cid)
		{
			$where = 'a.id='.$cid.' AND a.subject = b.id';
			$this->db->where($where);
			$this->db->select('b.code, b.id as subID');
			$q = $this->db->get('tbl_classallocation a, tbl_subject b');
			return $q->row_array();
		}

		function getRoom($id)
		{
			$q = $this->db->query("SELECT legacycode, tbl_location.description as loc FROM tbl_classroom, tbl_location
								   WHERE tbl_classroom.location = tbl_location.id
								   AND tbl_classroom.id = $id
								  ");
			return $q->row_array();
		}

		function getSpecificAllocation($id)
		{
			$this->db->where('id', $id);
			$this->db->select('dayperiod');
			$q = $this->db->get('tbl_classallocation');
			return $q->row_array();
		}

		function getRegID($student)
		{
			$q = $this->db->query("SELECT id FROM tbl_registration
													   WHERE student = '$student' ORDER BY id DESC LIMIT 1");
			extract($q->row_array());
			return $id;
		}
		function getUnits($id){
			$q = $this->db->query("SELECT units, nonacademic FROM tbl_subject
								   					 WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = '$id')");
			return $q->row_array();
		}
		function addEnrolment($count, $student, $coursemajor, $registration, $academicterm, $units, $status)
		{
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
		function addInitialGrade($alloc, $enrolment)
		{
			$data = array(
				'classallocation' => $alloc,
				'enrolment' => $enrolment);
			$this->db->insert('tbl_studentgrade', $data);
		}
		function updateReserved($id, $count)
		{
			$data = array('reserved' => $count);
			$this->db->where('id', $id);
			$this->db->update('tbl_classallocation', $data);
		}
		function getReserved($id)
		{
			$this->db->where('id', $id);
			$this->db->select('reserved');
			return $this->db->get('tbl_classallocation')->row_array();
		}

		function updateEnrolled($id, $count)
		{
			$data = array('enrolled' => $count);
			$this->db->where('id', $id);
			$this->db->update('tbl_classallocation', $data);
		}
		function getEnrolled($id)
		{
			$this->db->where('id', $id);
			$this->db->select('enrolled');
			return $this->db->get('tbl_classallocation')->row_array();
		}
		function getUnit($cur, $level, $term)
		{
			$q = $this->db->query("SELECT SUM(units) as unit FROM tbl_curriculumdetail, `tbl_subject`
														 WHERE curriculum = '$cur' AND yearlevel = '$level' AND term = '$term' AND
 													 	 tbl_curriculumdetail.subject = tbl_subject.id AND nonacademic = 0");
														 return $q->row_array();
		}
		function checkEvaluation($pid, $term)
		{
			$this->db->where('academicterm', $term);
			$this->db->where('student', $pid);
			$res = $this->db->get('tbl_enrolment');
			return $res->row_array();
		}
		function getEvaluation($id)
		{
			$this->db->where('enrolment', $id);
			$res = $this->db->get('tbl_studentgrade');
			return $res->result_array();
		}
		function deleteEvaluation($id)
		{
			$this->db->where('enrolment', $id);
			$this->db->delete('tbl_studentgrade');
		}

		function updateEnrolment($id, $unit, $subCount)
		{
			$data = array('totalunit' => $unit, 'numberofsubject' => $subCount);
			$this->db->where('id', $id);
			$this->db->update('tbl_enrolment', $data);
		}		

	    function checkNSTP($student, $subject){
	    	$q = $this->db->query("SELECT e.value as gr, e.description
	    		FROM tbl_studentgrade a, tbl_enrolment b, tbl_classallocation c, tbl_subject d, tbl_grade e
	    		WHERE b.id = a.enrolment AND a.classallocation = c.id AND c.subject = d.id
	    		AND (e.id = a.semgrade OR e.id = a.reexamgrade) AND b.student = '$student' AND d.id = '$subject'
	    	");
	    }
	}
