<form class="form-horizontal add-user" method="post" action="/edp/studentcount" role="form">
<?php
	$curr 					= $this->api->systemValue();
	$current_academicterm 	= $curr['currentacademicterm'];
	$t 						= $this->academicterm->findById($current_academicterm);
	$term 					= $t['term'];

	// not applicable for summer
	if($term != 2)
	{
 ?>
<input type="hidden" name="acam" value="<?php echo $current_academicterm + 1; ?>">
<table class="table">
	<caption>
		<strong>
		Preparation Statistics for Academicterm SY:
		<?php
			$nxt 	= $this->api->systemValue();
			$nnxt 	= $this->academicterm->findById($nxt['nextacademicterm']);
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

		$curs = $this->db->query("SELECT * FROM tbl_course")->result_array();
		foreach($curs as $cu)
		{
			/*$cid = $cu['id'];
			$this->db->query("SELECT * FROM tbl_curriculum WHERE coursemajor = (SELECT id FROM tbl_coursemajor WHERE course=$cid)")->result_array();*/
			for($i=1;$i<=4;$i++)
			{
				$year_l = $i;
	?>
	<tr>
		<input type="hidden" name="coursemajor[]" value="<?php echo $cu['id']; ?>">
		<input type="hidden" name="year_level[]" value="<?php echo $year_l; ?>">
		<td><?php echo $cu['description']; ?></td>
		<td><?php echo $i; ?></td>
		<td>
			<?php
				$cid = $cu['id'];
				if($year_l != 1)
				{
					$cc_count = 0;

					if($term == 3)
					{
						$e =  $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid and academicterm = $current_academicterm - 1 AND school = 1 GROUP BY student")->result_array();
					}
					else
					{
						$e =  $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
					}

					foreach($e as $ee)
					{
						$stu_id = $ee['student'];
						$s = $this->db->query("SELECT * FROM tbl_enrolment,tbl_academicterm WHERE student = $stu_id AND school = 1 AND tbl_enrolment.academicterm = tbl_academicterm.id AND tbl_academicterm.term != 3 GROUP BY academicterm")->num_rows();

						if(($s == 1 OR $s == 2) AND $year_l == 1)
						{
							if ($term == 3)
							{
								$ss = $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE student = $stu_id AND academicterm >= $current_academicterm - 2  AND school = 1 GROUP BY academicterm")->num_rows();
								if($ss > 0)
								{
									$cc_count++;
								}
							}
							else
							{
								$cc_count++;
							}
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
					echo $cc_count;
					?>
					<input type="hidden" name="count[]" value="<?php echo $cc_count; ?>">
					<?php
				}
				else
				{
					$cc_count = 0;
					if($term == 3)
					{
						$e =  $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid and academicterm = $current_academicterm - 2 AND school = 1 GROUP BY student")->result_array();
					}
					else
					{
						$e =  $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid and academicterm = $current_academicterm AND school = 1 GROUP BY student")->result_array();
					}

					foreach($e as $ee)
					{
						$stu_id = $ee['student'];
						$s = $this->db->query("SELECT * FROM tbl_enrolment,tbl_academicterm,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid AND student = $stu_id AND school = 1 AND tbl_enrolment.academicterm = tbl_academicterm.id AND tbl_academicterm.term != 3 GROUP BY academicterm")->num_rows();

						if(($s == 1 OR $s == 2) AND $year_l == 1)
						{
							if ($term == 3)
							{
								$ss = $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor and tbl_coursemajor.course = $cid AND student = $stu_id AND academicterm >= $current_academicterm - 2  AND school = 1 GROUP BY academicterm")->num_rows();
								if($ss > 0)
								{
									$cc_count++;
								}
							}
							else
							{
								$cc_count++;
							}
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
