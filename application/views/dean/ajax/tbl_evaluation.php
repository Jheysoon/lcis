<?php 

	$res = $this->student->getClassAloc($term, $student, $coursemajor);
 ?>
<div class="table-responsive" id="evaluation">
				<form class="form" action="/dean/saveEvaluation" method="post" role="form">
						<tr>
							<td colspan="5">
								<input style="width: 70px;" class="pull-right form-control" name="counter" readonly type="number" value ='0'>
								<label class="pull-right">Total Units &nbsp;&nbsp;&nbsp;</label>
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
										    >
										</td>
										<td><?php echo $d; ?></td>
										<td><?php echo $p; ?></td>
										<!-- <td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $shortname; ?></td> -->
										<!-- <td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $t1.'-'.$t2; ?></td> -->
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['legacycode']; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['loc']; ?></td>
									</tr>
						<?php	
								$ctr2++;}$ctr++;
							}
						 ?>

					</table>
					<input type='hidden' name='count' value = '<?php echo $ctr; ?>'>
					<div class="form-group">
						<!-- <a class="btn btn-info" href="/dean/calculatebill/50">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></a> -->
						<button type="submit" class="btn btn-info">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></button>
					</div>
				</form>
			</div>