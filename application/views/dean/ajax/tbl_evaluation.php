<?php 

	$res = $this->student->getClassAloc($term, $student, $coursemajor);
 ?>
<div class="table-responsive" id="evaluation">
				<form class="form" role="form">
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
									$dp = $this->student->getDP($aloc['dayperiod']);
									extract($dp);
									$date1 = new DateTime($from);
									$t1 = $date1->format('h:i');
									$date2 = new DateTime($to);
									$t2 = $date2->format('h:i');


									$cl = $this->student->getRoom($aloc['classroom']);

									$dp = $this->student->getDP($aloc['dayperiod']);
								?>
									<tr onclick="clickRow(<?php echo $ctr.','.$ctr2; ?>)">
										<td  id = 'r-<?php echo "$ctr"; ?>' >
										    <input class="rad-<?php echo $ctr; ?>" type="checkbox" name = "rad-<?php echo $ctr2; ?>" id = "rad-<?php echo $ctr2; ?>">
										</td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $shortname; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $t1.'-'.$t2; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['legacycode']; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['loc']; ?></td>
									</tr>
						<?php	
								$ctr2++;}$ctr++;
							}
						 ?>

					</table>
					<div class="form-group">
						<a class="btn btn-info" href="/dean/calculatebill/50">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></a>
					</div>
				</form>
			</div>