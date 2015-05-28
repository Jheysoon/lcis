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
	        $q = $this->db->query("SELECT lastname, firstname, tbl_coursemajor.major as major, tbl_course.description as description, tbl_coursemajor.id as cid
	        					   FROM tbl_registration, tbl_coursemajor, tbl_course, tbl_party 
	        						 WHERE tbl_registration.coursemajor = tbl_coursemajor.id 
	        						 AND tbl_coursemajor.course = tbl_course.id 
	        						 AND tbl_party.id = tbl_registration.student 
	        						 AND tbl_party.legacyid = '$id'
	        						 ");
	        return $q->row_array();
	    }

		function calculatebill($enid){
			$getEnrolment = $this->db->query("SELECT * FROM tbl_studentgade WHERE enrolment = '$enid'");
			$g = $getEnrolment->result_array();
			foreach ($g as $key => $value) {
				extract($value);
			}
		function getCalculation($enid){
			$computer = 0;
			$booklet = 0;
			$netenrol = 0;
			$tuition = 0;
			$mat = 0;
			$totalbook = 0;
			$this->db->where('id', $enid);
			extract($this->db->get('tbl_enrolment')->row_array());
			$where = "tbl_feetype.id = tbl_fee.feetype AND tbl_fee.coursemajor = " . $coursemajor;
			$this->db->where($where);
			$this->db->select('`tbl_fee.id`, `description`, `code`, `accounttype`, `rate`');
			 echo "
			        <table>
			                <tr>
			                	<th style='border: 1px solid; padding: 5px;'>ID</th>
			                    <th style='border: 1px solid; padding: 5px;'>Account Type</th>
			                    <th style='border: 1px solid; padding: 5px;'>Code</th>
			                    <th style='border: 1px solid; padding: 5px;'>Description</th>
			                    <th style='border: 1px solid; padding: 5px;'>Rate</th>
			                    <th style='border: 1px solid; padding: 5px;'>Total Units</th>
			                    <th style='border: 1px solid; padding: 5px;'>Rate * Total Units</th>
			                </tr>
			    ";
			foreach ($this->db->get('tbl_fee, tbl_feetype')->result_array() as $key => $val) {
					extract($val);
					
		 							 if ($accounttype == 23){
		 							 	$m = $this->getEn($enid);
		 							 	foreach ($m as $key => $value) {
		 							 		extract($value);
				 							 			$x = $this->getSubs($classallocation);
							 							 		if($x['computersubject'] == 0) {
							 							 				echo "	
																				<tr>
																			     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
																				 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
																				 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
													 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
													 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
													 							 $computer = $rate;
													 							 break;
		 							 							}
												}
		 							 }elseif($accounttype == 24){
						 							 	$m = $this->getEn($enid);
						 							 	foreach ($m as $key => $ms) {
						 							 		extract($ms);
								 							 			$xl = $this->getSubs($classallocation);
											 							 		
											 							 		if($xl['bookletcharge'] == 0) {
											 							 				echo "	
																								<tr>
																							     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
																								 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
																								 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
																	 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
																	 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
																	 							 $booklet = $rate;
																	 							  break;
						 							 							}
						 							 					}

		 							 }	elseif ($accounttype == 19) {
		 							 	if ($coursemajor == 5) {
		 							 			echo "	
													<tr>
												     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
													 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
													 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
						 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
						 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
						 							 $netenrol += $rate;
		 							 	}
		 							 }else{
		 							 	echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
			 							 if ($accounttype == 6) {
			 							 		echo  "<td style='border: 1px solid; padding: 5px;'>".$totalunit."</td>";
			 							 		echo "<td style='border: 1px solid; padding: 5px;'>".$rate * $totalunit."</td>";	
			 							 		$tuition = $rate * $totalunit;		

			 							 }elseif ($accounttype == 7 ) {
			 							 		echo  "<td style='border: 1px solid; padding: 5px;'>".$totalunit."</td>";
				 							 	echo  "<td style='border: 1px solid; padding: 5px;'>".$rate * $totalunit."</td>";
				 							 	$mat = $rate * $totalunit;
			 							 }else{
			 							 	$netenrol += $rate;
			 							 }
		 							 }		 							
	 						echo "</tr>";				
			}
		}
			echo "</table>";
			echo $computer . "<br />";
			echo $totalbook = $booklet * $numberofsubject * 4 . "<br />";
			echo $netenrol + $mat + $tuition + $totalbook + $computer;
		}
		function getEn($enid){
			return $this->db->query("SELECT * FROM tbl_studentgrade WHERE enrolment = '$enid'")->result_array();
		}
		function getSubs($classallocation){
			return $xl = $this->db->query("SELECT * FROM `tbl_subject` WHERE tbl_subject.id = (SELECT subject FROM tbl_classallocation WHERE tbl_classallocation.id = '$classallocation')")->row_array();
		}

		function getAcTerm($id){
			$this->db->where("id", $id);
			$q = $this->db->get("tbl_academicterm");
			return $q->row_array();
		}

		function getYearLevel($id){
			$q = $this->db->query("SELECT * FROM tbl_enrolment, tbl_academicterm, tbl_party
								   WHERE tbl_enrolment.student = tbl_party.id 
								   AND tbl_enrolment.academicterm = tbl_academicterm.id
								   AND tbl_academicterm.term != 3
								   AND tbl_party.legacyid = '$id'");
			return $q->num_rows();
		}

		function getAllCur($cid){
			$this->db->where("coursemajor", $cid);
			$this->db->select("id");
			$q = $this->db->get("tbl_curriculum");
			return $q->result_array();
		}
	}

	
