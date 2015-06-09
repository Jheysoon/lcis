<?php 
	$res = $this->student->getClassAloc($term, $student, $coursemajor);
	$legid = $id;
	$registration = $this->student->getRegID($student);
 ?>
<div class="table-responsive" id="evaluation">
				<form class="form" action="/dean/evaluation/<?php echo $legid; ?>" method="post" role="form">
					<input type="hidden" name="student" value="<?php echo $student; ?>">
					<input type="hidden" name="coursemajor" value="<?php echo $coursemajor; ?>">
					<input type="hidden" name="registration" value="<?php echo $registration; ?>">
					<input type="hidden" name="academicterm" value="<?php echo $term; ?>">
						<tr>
							<td colspan="5">
								<input style="width: 70px;" class="pull-right form-control" name="counter" readonly type="number" value ='<?php echo $units; ?>'>
								<label class="pull-right">Max Units &nbsp;&nbsp;&nbsp;</label>
							</td>
						</tr><br/><br/>
					<table class="table table-bordered table-hover" id = "tabletest">
						<tr>
							<th width="25"></th>
							<th>Days</th>
							<th>Period</th>
							<th>Room</th>
							<th>Location</th>
						</tr>
						<?php 
							$ctr = 1;
							$ctr2 = 1;
							foreach ($res as $aloccation) { 
								$sub = $this->student->getSubDetail($aloccation['subject']);
						?>
								<tr>
									<td class="tbl-header" colspan="2"><strong>Code: </strong><?php echo $sub['code']; ?></td>
									<td class="tbl-header" colspan="2"><strong>Subject: </strong><?php echo $sub['descriptivetitle']; ?></td>
									<td class="tbl-header"><strong>Units: </strong><?php echo $sub['units']; ?></td>
								</tr>
						<?php	

								$sched = $this->student->getSched($term, $aloccation['subject']);
								foreach ($sched as $aloc) { 
									$p = $this->edp_classallocation->getPeriod($aloc['id']);
									$d = $this->edp_classallocation->getDayShort($aloc['id']);
									

									$cl = $this->student->getRoom($aloc['classroom']);
								?>
									<tr onclick="clickRow(<?php echo $ctr.','.$ctr2.','.$sub['units']; ?>)">
										<td  id = 'r-<?php echo "$ctr"; ?>' >
										    <input 
										    	class="rad-<?php echo $ctr; ?>" 
										    	type="radio" 
										    	name = "rad-<?php echo $ctr; ?>" 
										    	id = "rad-<?php echo $ctr2; ?>"
										    	value = "<?php echo $aloc['id']; ?>"
										    	<?php echo  set_radio('rad-'.$ctr, $aloc['id']); ?>
										    >
										</td>
										<td><?php echo $d; ?></td>
										<td><?php echo $p; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['legacycode']; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['loc']; ?></td>
									</tr>
						<?php	
								$ctr2++;}$ctr++;
							}
						 ?>

					</table>
					<input type='hidden' name='count' value = '<?php echo $ctr; ?>'>
					<input type='hidden' name='legid' value = '<?php echo $legid; ?>'>
					<div class="form-group">
						<!-- <a class="btn btn-info" href="/dean/calculatebill/50">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></a> -->
						<button type="submit" name="btn" value="1" class="btn btn-info">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></button>
					</div>
				</form>
			</div>