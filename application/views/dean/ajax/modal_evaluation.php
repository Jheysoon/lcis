<?php
    	if ($subject != '') {
			$res2 = $this->student->getClassAloc2($subject, $term); ?>
			<?php if ($res2): ?>
				<div class="table-responsive col-md-12">
					<table class="table table-bordered">
							<tr>
								<th>Code</th>
								<th>Subject</th>
								<th>Units</th>
								<th>Action</th>
							</tr>
							<?php
								foreach ($res2 as $sub) {
                                    $check = $this->student->checkEnrolment($sub['id'], $student);
                                if ($check == 0) { ?>
									<tr class="md">
										<td><?php echo $sub['code']; ?></td>
										<td><?php echo $sub['descriptivetitle']; ?></td>
										<td><?php echo $sub['units']; ?></td>
										<td>
                                            <a type="button" class="a-table label label-primary view_sched" data-subject = "<?php echo $sub['id']; ?>" data-term = "<?php echo $term; ?>"
                                            >View Schedules <span class="glyphicon glyphicon-eye"></span></a>
                                        </td>
									</tr>
							<?php } } ?>
	            	</table>
				</div>
			<?php else: ?>
				<?php echo "error"; ?>
			<?php endif ?>
    <?php	}
     ?>
