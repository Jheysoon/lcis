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
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
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
									elseif(($s == 7 OR $s == 8) AND $year_l ==4)
									{
										$cc_count++;
									}
									
									/*$ss = $s / 2;
									$s = (int) ($s/2);

									if(($ss == .5 AND $year_l == 1) OR ($year_l == 1 AND $s == 1))
									{
										$cc_count++;
									}
									elseif(($ss == 1.5 AND $year_l == 2) OR ($year_l == 2 AND $s == 2))
									{
										$cc_count++;
									}
									elseif(($ss == 2.5 AND $year_l == 3) OR ($year_l == 3 AND $s == 3))
									{
										$cc_count++;
									}
									elseif(($ss == 3.5 AND $year_l == 4) OR ($year_l == 4 AND $s == 4))
									{
										$cc_count++;
									}*/
									/*if($s == $year_l)
									{
										$cc_count += 1;
									}*/

									/*$s = $s / 2;
									if(($s == .5 AND $year_l == 1) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 1.5 AND $year_l == 2) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 2.5 AND $year_l == 3) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 3.5 AND $year_l == 4) OR $year_l == $s)
									{
										$cc_count += 1;
									}*/
								}
								echo $cc_count;
						?>
							<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
						<?php
							}
							elseif($term == 3)
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
									elseif(($s == 7 OR $s == 8) AND $year_l ==4)
									{
										$cc_count++;
									}

									/*$ss = $s / 2;
									$s = (int) ($s/2);

									if(($ss == .5 AND $year_l == 1) OR ($year_l == 1 AND $s == 1))
									{
										$cc_count++;
									}
									elseif(($ss == 1.5 AND $year_l == 2) OR ($year_l == 2 AND $s == 2))
									{
										$cc_count++;
									}
									elseif(($ss == 2.5 AND $year_l == 3) OR ($year_l == 3 AND $s == 3))
									{
										$cc_count++;
									}
									elseif(($ss == 3.5 AND $year_l == 4) OR ($year_l == 4 AND $s == 4))
									{
										$cc_count++;
									}*/

									/*$s = (int) ($s/2);
									if($s == $year_l)
									{
										$cc_count += 1;
									}*/
									/*$s = $s / 2;
									if(($s == .5 AND $year_l == 1) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 1.5 AND $year_l == 2) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 2.5 AND $year_l == 3) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 3.5 AND $year_l == 4) OR $year_l == $s)
									{
										$cc_count += 1;
									}*/
								}
								echo $cc_count;
							?>
							<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
						<?php
							}
							else
							{
								$cc_count = 0;
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id AND school = 1 GROUP BY academicterm")->num_rows();
									/*$ss = $s / 2;
									$s = (int) ($s/2);*/
									/*if($s == $year_l)
									{
										$cc_count += 1;
									}*/
									// 3
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
									elseif(($s == 7 OR $s == 8) AND $year_l ==4)
									{
										$cc_count++;
									}
									/*$ss = $s / 2;
									$s = (int) ($s/2);

									if(($ss == .5 OR $s == 1) AND $year_l == 1)
									{
										$cc_count++;
									}
									elseif(($ss == 1.5 OR $s == 2) AND $year_l == 2)
									{
										$cc_count++;
									}
									elseif(($ss == 2.5  OR $s == 3) AND $year_l == 3)
									{
										$cc_count++;
									}
									elseif(($ss == 3.5 OR $s == 4) AND $year_l == 4)
									{
										$cc_count++;
									}*/

									/*
										if($s == $year_l)
										{
											$cc_count += 1;
										}
									*/
									/*$s = $s / 2;
									if(($s == .5 AND $year_l == 1) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 1.5 AND $year_l == 2) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 2.5 AND $year_l == 3) OR $year_l == $s)
									{
										$cc_count += 1;
									}
									elseif(($s == 3.5 AND $year_l == 4) OR $year_l == $s)
									{
										$cc_count += 1;
									}*/
								}
								echo $cc_count;
							?>
								<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
							<?php
							}
						?>
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