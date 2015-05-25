<form class="form-horizontal add-user" method="post" action="/edp/studentcount" role="form">
<?php 
	$current_academicterm = 40;
	$t = $this->academicterm->findById($current_academicterm);
	$term = $t['term'];
	// not applicable for summer
	if($term != 2)
	{
 ?>
<input type="hidden" name="acam" value="<?php echo $current_academicterm; ?>">
<table class="table">
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

			//@todo this loop is for the latest curriculum
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
				/*$r = $current_academicterm - 12;
				$r = $this->db->query("SELECT * FROM tbl_curriculum WHERE academicterm BETWEEN ($r AND $current_academicterm) AND coursemajor = $cid")->num_rows();
				echo $r.' - '.$cid;*/


				$cc = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum=$cur GROUP BY yearlevel")->result_array();
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
							$r = $current_academicterm - 12;
							if($year_l != 1)
							{
								$cc_count = 0;
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm GROUP BY student")->result_array();
								foreach($e as $ee)
								{
									
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id GROUP BY academicterm")->num_rows();
									$s = (int) ($s/2);
									if($s == $year_l)
									{
										$cc_count += 1;
									}
								}
								echo $cc_count;
						?>
							<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
						<?php
							}
							elseif($term == 3)
							{
								$cc_count = 0;
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm-1 GROUP BY student")->result_array();
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id GROUP BY academicterm")->num_rows();
									$s = (int) ($s/2);
									if($s == $year_l)
									{
										$cc_count += 1;
									}
								}
								echo $cc_count;
							?>
							<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
						<?php
							}
							else
							{
								$cc_count = 0;
								$e =  $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid and academicterm = $current_academicterm GROUP BY student")->result_array();
								foreach($e as $ee)
								{
									$stu_id = $ee['student'];
									$s = $this->db->query("SELECT * FROM tbl_enrolment WHERE coursemajor = $cid AND student = $stu_id GROUP BY academicterm")->num_rows();
									$s = (int) ($s/2);
									if($s == $year_l)
									{
										$cc_count += 1;
									}
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