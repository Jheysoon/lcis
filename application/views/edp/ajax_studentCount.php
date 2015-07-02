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
<input type="hidden" name="acam" value="<?php echo $curr['nextacademicterm']; ?>">
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
			$course = $cu['id'];
			for($i=1;$i<=4;$i++)
			{
				$cid 	= $cu['id'];
				$year_l = $i;

				// if year level is for 2nd, 3rd, 4th year students
				if ($year_l != 1)
				{
					//create a function to check if the course have a curriculum


					// check if the term is summer
					if ($term == 3)
					{
						// if term is summer . get the students enrolled in last 2nd sem.
						$acam 	= $current_academicterm - 1;
						$e 		= $this->edp_classallocation->getStudEnrol($cid, $acam);
					}
					else
					{
						// if not get the students in enrolled in current academicterm
						$e = $this->edp_classallocation->getStudEnrol($cid, $current_academicterm);
					}
					foreach ($e as $stud)
					{
						$count = 0;

						$yearlevel = $this->api->yearLevel($stud['student'], $course);

						// API return curriculum not found if the course does not have a curriculum
						if ($yearlevel != CUR_NOT_FOUND)
						{
							if ($yearlevel == $year_l)
							{
								$count++;
							}
						}
					}
		?>
					<tr>
						<input type="hidden" name="coursemajor[]" value="<?php echo $cu['id']; ?>">
						<input type="hidden" name="year_level[]" value="<?php echo $year_l; ?>">
						<td><?php echo $cu['description']; ?></td>
						<td><?php echo $i; ?></td>
						<td><?php echo $count; ?></td>
						<input type="hidden" name="count[]" value="<?php echo $count; ?>">
					</tr>
		<?php
				}
				else
				{
					$count = 0;
					if($term == 3)
					{
						$acam = $current_academicterm - 2;
						$e = $this->edp_classallocation->getStudEnrol($cid, $acam);
					}
					else {
						$e = $this->edp_classallocation->getStudEnrol($cid, $current_academicterm);
					}
					foreach ($e as $stud)
					{
						$count = 0;

						$yearlevel = $this->api->yearLevel($stud['student'], $course);

						// API return curriculum not found if the course does not have a curriculum
						if ($yearlevel != CUR_NOT_FOUND)
						{
							if ($yearlevel == $year_l)
							{
								$count++;
							}
						}
					}
			?>
			<tr>
				<input type="hidden" name="coursemajor[]" value="<?php echo $cu['id']; ?>">
				<input type="hidden" name="year_level[]" value="<?php echo $year_l; ?>">
				<td><?php echo $cu['description']; ?></td>
				<td><?php echo $i; ?></td>
				<td><?php echo $count; ?></td>
				<input type="hidden" name="count[]" value="<?php echo $count; ?>">
			</tr>
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
