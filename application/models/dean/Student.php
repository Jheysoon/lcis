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
	        $q = $this->db->query("SELECT lastname, firstname, tbl_coursemajor.major as major, tbl_course.description as 
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

		/*function calculatebill($enid){
			$getEnrolment = $this->db->query("SELECT * FROM tbl_studentgade WHERE enrolment = '$enid'");
			$g = $getEnrolment->result_array();
			foreach ($g as $key => $value) {
				extract($value);
			}
		}
			}*/
		//}
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
			 							 		if($x['computersubject'] == 1) {
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
			 							 		
			 							 		if($xl['bookletcharge'] == 1) {
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
					 							 $laboratory = $rate;
		 							 	}
	 							 }else{
	 							 	 if($accounttype == 6) {
	 							 	 	echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$totalunit."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate * $totalunit."</td>";

		 							 		/*echo  "<td style='border: 1px solid; padding: 5px;'>".$totalunit."</td>";
		 							 		echo "<td style='border: 1px solid; padding: 5px;'>".$rate * $totalunit."</td>";	*/
		 							 		$mat = $rate * $totalunit;		

		 							 }elseif ($accounttype == 7 ) {
		 							 		echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$totalunit."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate * $totalunit."</td>";
			 							 	$tuition = $rate * $totalunit;
		 							 }elseif($accounttype == 20){
		 							 		echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
		 							 			$leytetymes = $rate;
		 							 }elseif($accounttype == 22){
		 							 		echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
		 							 		$internetfee = $rate;
		 							 }elseif($accounttype == 21){
		 							 	$m = $this->getEn($enid);
			 							 	foreach ($m as $key => $value) {
								 				extract($value);
		 							 			$x = $this->getSubs($classallocation);
					 							 		if($x['computersubject'] == 1) {
					 							 				echo "	
																		<tr>
																	     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
																		 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
																		 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
											 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
											 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
											 							 $nstp = $rate;
											 							 break;
								 							}
													}
		 							 }else{
		 							 	echo "	
										<tr>
									     <td style='border: 1px solid; padding: 5px;'>".$id."</td>	
										 <td style='border: 1px solid; padding: 5px;'>".$accounttype."</td>
										 <td style='border: 1px solid; padding: 5px;'>".$code."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$description."</td>
			 							 <td style='border: 1px solid; padding: 5px;'>".$rate."</td>";
		 							 	$miscellaneous += $rate;
		 							 }
	 							 }		 							
 						echo "</tr>";				
			}
			echo "</table>";
		//	echo $computer . "<br />";
		//	echo $totalbook = $booklet * $numberofsubject * 4 . "<br />";
		//	echo $netenrol + $tuition + $mat + $totalbook + $computer + $laboratory;
			//$dis = $this->db->query("SELECT percent FROM `tbl_discount`, tbl_billdiscount WHERE student = '$student' AND tbl_discount.id = discount")->row_array();
			// $where = "tbl_discount.id = tbl_billdiscount.discount";
			// $this->db->where('student', $student);
			// $this->db->where($where);
			// $this->db->select('percent');
			// $dis = $this->db->get('tbl_discount, tbl_billdiscount')->row_array();
			//$discount = $dis['percent']/100;
/*
			$discount = 0.1;
			echo "Discount |".  $discount  . "<br />";
			echo "Computer |" . $computer . "<br />";
			echo "Booklet |" . $booklet . "<br />";
			echo "Laboratory |" . $laboratory . "<br />";
			echo "Matriculation |" . $mat . "<br />";
			echo "Leyte Times |" . $leytetymes . "<br />";
			echo "Internet Fee |" . $internetfee . "<br />";
			echo "NSTP |" . $nstp . "<br />";
			echo "Miscellaneous |" . $miscellaneous . "<br />";
			echo "Tuition|" . $tuition . "<br />";

			echo "Discount|" . $netfull = $tuition * $discount . "<br />";
			echo "Discounted Tuition|" . $discounted = $tuition - $netfull . "<br />";*/
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
			echo "<table>
					<th style='border: 1px solid; padding: 5px;'>Description</th>
					<th style='border: 1px solid; padding: 5px;'>Total</th>";
					echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Discount</td>
							<td style='border: 1px solid; padding: 5px;'>".$discount."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Computer</td>
							<td style='border: 1px solid; padding: 5px;'>".$computer."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Booklet</td>
							<td style='border: 1px solid; padding: 5px;'>".$booklet."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Laboratory</td>
							<td style='border: 1px solid; padding: 5px;'>".$laboratory."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Matriculation</td>
							<td style='border: 1px solid; padding: 5px;'>".$mat."</td>
						</tr>";
							echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Leyte Times</td>
							<td style='border: 1px solid; padding: 5px;'>".$leytetymes."</td>
						</tr>";
							echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Internet Fee</td>
							<td style='border: 1px solid; padding: 5px;'>".$internetfee."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>NSTP</td>
							<td style='border: 1px solid; padding: 5px;'>".$nstp."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Miscellaneous</td>
							<td style='border: 1px solid; padding: 5px;'>".$miscellaneous."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Tuition</td>
							<td style='border: 1px solid; padding: 5px;'>".$tuition."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Discount</td>
							<td style='border: 1px solid; padding: 5px;'>".$tuition * $discount."</td>
						</tr>";
						echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Discounted</td>
							<td style='border: 1px solid; padding: 5px;'>".($tuition - $netfull)."</td>
						</tr>";
							echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Total</td>
							<td style='border: 1px solid; padding: 5px;'>".$netfullpayment."</td>
						</tr>";
							echo "<tr>
							<td style='border: 1px solid; padding: 5px;'>Installment</td>
							<td style='border: 1px solid; padding: 5px;'>".$installment."</td>
						</tr>";
			echo "</table>";
			$q = $this->db->query("SELECT COUNT(*) as counted FROM tbl_billclass WHERE enrolment = '$enid'")->row_array();
			if ($q['counted'] == 0){
					$this->db->query("INSERT INTO tbl_bill SET requestedby = '0'");
					$billid = $this->db->insert_id();
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
			}else{
				$data = array(
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
				$this->db->update('tbl_billclass', $data);
			}
		}
		function rounded($val){
			return $x = round($val, 0, PHP_ROUND_HALF_UP);
		}
		function getEn($enid){
			$this->db->where('enrolment', $enid);
			return $this->db->get('tbl_studentgrade')->result_array();
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
			$where = 'tbl_curriculum.academicterm = tbl_academicterm.id AND coursemajor ='.$cid;
			$this->db->order_by('systart', 'DESC');
			$this->db->where($where);
			$this->db->select("`tbl_curriculum.id`, `systart`, `syend`");
			$q = $this->db->get("tbl_curriculum, tbl_academicterm");
			return $q->result_array();
		}

		function getClassAloc($academicterm, $student, $coursemajor){


			$q = $this->db->query("SELECT * FROM tbl_classallocation
								   WHERE academicterm = '$academicterm'
								   AND coursemajor = '$coursemajor'
								   AND subject NOT IN(SELECT subject FROM 
								   	tbl_studentgrade, tbl_classallocation, tbl_enrolment 
								   	WHERE tbl_studentgrade.classallocation = tbl_classallocation.id 
								   	AND tbl_enrolment.id = tbl_studentgrade.enrolment 
								   	AND tbl_classallocation.id != '$academicterm'
								   	AND tbl_enrolment.id = '$student')
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
	}
