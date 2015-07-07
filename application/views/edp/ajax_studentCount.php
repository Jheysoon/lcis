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
			$nnxt 	= $this->academicterm->findById($curr['nextacademicterm']);
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
		$curs = $this->db->get('tbl_course')->result_array();
		foreach($curs as $cu)
		{
			$yearL = array(0 => 0,1 => 0,2 => 0,3 => 0);
			$course = $cu['id'];

			$cid 	= $cu['id'];
			$count 	= 0;

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

				$yearlevel = $this->api->yearLevel($stud['student'], $course);

				// API return curriculum not found if the course does not have a curriculum
				if ($yearlevel != CUR_NOT_FOUND)
				{
					if($yearlevel > 1)
					{
						if($yearlevel > 4)
							$yearL[3] += 1;
						else
							$yearL[$yearlevel - 1] += 1;
					}
				}
				// else
				// 	break;
			}

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

				$yearlevel = $this->api->yearLevel($stud['student'], $course);

				// API return curriculum not found if the course does not have a curriculum
				if ($yearlevel != CUR_NOT_FOUND)
				{
					if ($yearlevel == 1)
					{
						$yearL[0] += 1;
					}
				}
				// else
				// 	break;
			}

			for ($i=1; $i <= 4 ; $i++)
			{
		?>
				<tr>
					<input type="hidden" name="coursemajor[]" value="<?php echo $cu['id']; ?>">
					<input type="hidden" name="year_level[]" value="<?php echo $i; ?>">
					<td><?php echo $cu['description']; ?></td>
					<td><?php echo $i; ?></td>
					<td><?php echo $yearL[$i - 1]; ?></td>
					<input type="hidden" name="count[]" value="<?php echo $yearL[$i - 1]; ?>">
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
