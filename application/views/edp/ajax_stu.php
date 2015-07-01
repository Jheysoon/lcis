<form class="form-horizontal add-user" method="post" action="/edp/studentcount" role="form">
<?php 
	$curr = $this->api->systemValue();
	$current_academicterm = $curr['currentacademicterm'];
	$t = $this->academicterm->findById($current_academicterm);
	$term = $t['term'];

	// not applicable for summer
	if($term != 2)
	{
 ?>
<input type="hidden" name="acam" value="<?php echo $current_academicterm; ?>">
<table class="table">
	<caption>
		<strong>
		Preparation Statistics for Academicterm SY:
		<?php 
			$nxt = $this->api->systemValue();
			$nnxt = $this->academicterm->findById($nxt['nextacademicterm']);
			echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$nnxt['term'];
		 ?>
		 </strong>
	</caption>
	<tr>
		<td>Course</td>
		<td>Year Level</td>
		<td>Number of Student</td>
		<td>student</td>
	</tr>

	<?php 
		$coursemajor = $this->course->getAllCourse();
		foreach($coursemajor as $c)
		{
			$cid = $c['id'];
			$course = $this->course->getCourse($cid);
			if($c['major'] == 0)
			{
				$major = '';
			}
			else
			{
				$major = '('.$this->course->getMajor($c['major']).')';
			}

			$c_count = 0;
			for($i = $current_academicterm;$i > 0;$i--)
			{
				$cur = $this->curriculum->getCur($i,$c['id']);
				if($cur != 'repeat')
				{
					break;
				}
				$c_count++;
			}

			
			// another loop
			if($cur != 'repeat')
			{
				$cc = $this->curriculumdetail->getAllYear($cur);
				foreach($cc as $cc1)
				{
					$year_l = $cc1['yearlevel'];
					?>
				<tr>
					<input type="hidden" name="coursemajor[]" value="<?php echo $cid; ?>">
					<input type="hidden" name="year_level[]" value="<?php echo $year_l; ?>">
					<td><?php echo $course.' '.$major; ?></td>
					<td><?php echo $year_l; ?></td>
					<td>
						<?php 
							//$r = $current_academicterm - 12;
							if($year_l != 1)
							{
								$cc_count = 0;
								
								if($term == 3)
								{
									$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm - 1 AND school = 1 GROUP BY student")->result_array();
								}
								else
								{
									$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
								}
								$st = '';
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment,tbl_academicterm WHERE coursemajor = $cid AND student = $stu_id AND school = 1 AND tbl_enrolment.academicterm = tbl_academicterm.id AND tbl_academicterm.term != 3 GROUP BY academicterm")->num_rows();
									
									if(($s == 1 OR $s == 2) AND $year_l == 1)
									{
										if ($term == 3) 
										{
											$ss = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id AND academicterm >= $current_academicterm - 2  AND school = 1 GROUP BY academicterm")->num_rows();
											if($ss > 0)
											{
												$cc_count++;
												$st .= $stu_id.'/';
											}	
										}
										else
										{
											$cc_count++;
											$st .= $stu_id.'/';
										}
									}
									elseif(($s == 3 OR $s == 4) AND $year_l == 2)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
									elseif(($s == 5 OR $s == 6) AND $year_l == 3)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
									elseif(($s == 7 OR $s >= 8) AND $year_l ==4)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
								}
								echo $cc_count;
						?>
							<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
						<?php
							/*elseif($term == 3)
							{
								$cc_count = 0;
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm-1 AND school = 1 GROUP BY student")->result_array();
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id AND school = 1 GROUP BY academicterm")->num_rows();
									

									if(($s == 1 OR $s == 2) AND $year_l == 1)
									{
										$cc_count++;
									}
									elseif(($s == 3 OR $s == 4) AND $year_l == 2)
									{
										$cc_count++;
									}
									elseif(($s == 5 OR $s == 6) AND $year_l == 3)
									{
										$cc_count++;
									}
									elseif(($s == 7 OR $s >= 8) AND $year_l ==4)
									{
										$cc_count++;
									}
								}
								echo $cc_count;*/
							}
							else
							{
								$cc_count = 0;
								if($term == 3)
								{
									$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm - 2 AND school = 1 GROUP BY student")->result_array();
								}
								else
								{
									$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
								}
								$st = '';
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment,tbl_academicterm WHERE coursemajor = $cid AND student = $stu_id AND school = 1 AND tbl_enrolment.academicterm = tbl_academicterm.id AND tbl_academicterm.term != 3 GROUP BY academicterm")->num_rows();
									
									if(($s == 1 OR $s == 2) AND $year_l == 1)
									{
										if ($term == 3) 
										{
											$ss = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id AND academicterm >= $current_academicterm - 2  AND school = 1 GROUP BY academicterm")->num_rows();
											if($ss > 0)
											{
												$cc_count++;
												$st .= $stu_id.'/';	
											}
										}
										else
										{
											$cc_count++;
											$st .= $stu_id.'/';
										}
									}
									elseif(($s == 3 OR $s == 4) AND $year_l == 2)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
									elseif(($s == 5 OR $s == 6) AND $year_l == 3)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
									elseif(($s == 7 OR $s >= 8) AND $year_l ==4)
									{
										$cc_count++;
										$st .= $stu_id.'/';
									}
								}
								echo $cc_count;
							?>
								<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
							<?php
							}
						?>
					</td>
					<td>
						<?php echo $st; ?>
					</td>
				</tr>
				<?php
				}
			}
		}
	}
	else
	{
		?>
		<div class="alert alert-danger">
			Not applicable for summer term
		</div>
<?php
	}
 ?>
</table>
<button type="submit" class="btn btn-success pull-right">Save</button>
</form>