<?php
    	if ($subject != '') {
			$res2 = $this->student->getClassAloc2($term, $student, $subject); ?>
			<?php if ($res2): ?>
				<div class="table-responsive col-md-12">
					<table class="table table-bordered">
							<tr>
								<th width="25"></th>
								<th>Days</th>
								<th>Period</th>
								<th>Room</th>
								<th>Location</th>
								<th width="10">Reserved</th>
								<th width="10">Enrolled</th>
							</tr>
							<?php
								$ctr = 1;
								$ctr2 = 1;
								foreach ($res2 as $aloccation) {
									$sub = $this->student->getSubDetail($aloccation['subject']);
							?>
									<tr class="md">
										<td class="tbl-header" colspan="2"><strong>Code: </strong><?php echo $sub['code']; ?></td>
										<td class="tbl-header" colspan="4"><strong>Subject: </strong><?php echo $sub['descriptivetitle']; ?></td>
										<td class="tbl-header"><strong>Units: </strong><?php echo $sub['units']; ?></td>
									</tr>
							<?php
									$sched = $this->student->getSched2($term, $aloccation['subject']);
									foreach ($sched as $aloc) {
										$p = $this->edp_classallocation->getPeriod($aloc['id']);
										$d = $this->edp_classallocation->getDayShort($aloc['id']);

						                $cl = $this->edp_classallocation->getRoom($aloc['id']);
										// $cl = array('location'=> '','room'=>'');
										$reserved = $this->student->getReserved($aloc['id']);
										$enrolled = $this->student->getEnrolled($aloc['id']);
									?>
										<tr class="md">
											<td  id = 'r-<?php echo "$ctr"; ?>' >
											    <input
											    	class="rad-<?php echo $ctr; ?>"
											    	type="radio"
											    	name = "choose"
											    	value = "<?php echo $aloc['id']; ?>"
											    >
											</td>
											<td><?php echo $d; ?></td>
											<td><?php echo $p; ?></td>
											<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['room']; ?></td>
											<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['location']; ?></td>
											<td style="text-align: center;"><?php echo $reserved['reserved']; ?></td>
											<td style="text-align: center;"><?php echo $enrolled['enrolled']; ?></td>
										</tr>
							<?php
									$ctr2++;}$ctr++;
								}
							 ?>
	            	</table>
				</div>
			<?php else: ?>
				<?php echo "error"; ?>
			<?php endif ?>
    <?php	}
     ?>
