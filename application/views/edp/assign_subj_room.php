<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Assign Subject to Room</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<?php
						echo $this->session->flashdata('message');
						echo $error;
					?>
					<div class="col-md-12 col-bg">
						<a href="<?php echo base_url('menu/edp-room_subj') ?>" class="btn btn-primary">Back</a>
						<form action="/edp_override/<?php echo $cid ?>" method="post">
							<input type="hidden" name="class_id" value="<?php echo $cid; ?>">
							<?php
								$this->db->where('classallocation', $cid);
								$dp_count 	= $this->db->count_all_results('tbl_dayperiod');
								if($dp_count > 0) {
							?>
							<label class="center-block" style="max-width:200px;"><strong>Override Dean's Day and Period</strong></label>
							<?php
								}
								else {
									?>
							<table class="table">
								<label class="center-block" style="max-width:200px;"><strong>Add Day and Period</strong></label>
								<tr>
									<th style="text-align:center;">Subject</th>
								</tr>
								<tr>
									<td style="text-align:center;">
										<?php
											$c = $this->edp_classallocation->getSubjectByCl($cid);
											echo $c['code'].' | '.$c['descriptivetitle'];
										 ?>
									</td>
								</tr>
							</table>
							<?php
								}
							// get day/period of the subject suggested by dean
							$this->db->where('classallocation', $cid);
							$dayPeriod	= $this->edp_classallocation->getDayPeriod1($cid);
						?>

							<input type="hidden" name="class_id" value="<?php echo $cid; ?>">
							<table class="table">
								<tr>
									<th style="text-align:center;">Days</th>
									<th style="text-align:center;">Start Time</th>
									<th style="text-align:center;">End Time</th>
								</tr>
								<?php
									$d = $this->db->get('tbl_day')->result_array();
									$t = $this->db->get('tbl_time')->result_array();
									foreach($d as $day)
									{
										?>
										<tr>
											<td>
												<div class="checkbox">
													<label>
														<input type="checkbox" style="margin-top:8px;" name="day[]" value="<?php echo $day['id'] ?>" <?php echo set_checkbox('day', $day['id']) ?>>
														<strong style="font-size:18px"><?php echo $day['day'] ?></strong>
													</label>
												</div>
											</td>
											<td>
												<select class="form-control" name="start_time<?php echo $day['id'] ?>">
													<?php foreach ($t as $time) { ?>
														<option value="<?php echo $time['id'] ?>" <?php echo set_select('start_time'.$day['id'], $time['id']) ?>><?php echo $time['time'] ?></option>
													<?php } ?>
												</select>
											</td>
											<td>
												<select class="form-control" name="end_time<?php echo $day['id'] ?>">
													<?php foreach ($t as $time) { ?>
														<option value="<?php echo $time['id'] ?>" <?php echo set_select('end_time'.$day['id'], $time['id']) ?>><?php echo $time['time'] ?></option>
													<?php } ?>
												</select>
											</td>
										</tr>
								<?php
									}
								 ?>
							</table>
							<input type="submit" class="btn btn-primary pull-right" value="Add / Change">

						</form>
						<hr/>
					</div>
				</div>
				<div class="col-md-12">
					<?php if($dp_count > 0) { ?>
					<form action="/edp/add_room_class" method="post">
						<input type="hidden" name="cid" value="<?php echo $cid; ?>">
						<table class="table">
							<tr>
								<th>Subject</th>
								<th>Course</th>
								<th>Day</th>
								<th>Period</th>
								<th>Room</th>
							</tr>
						<?php
							$cl 		= $this->edp_classallocation->find($cid);
							$conflict	= FALSE;
							$systemVal 	= $this->api->systemValue();

							$r = $this->edp_classallocation->getAllRoom();

							foreach($dayPeriod as $dp)
							{
						?>
							<tr>
								<input type="hidden" name="dayperiodId[]" value="<?php echo $dp['id']; ?>">
								<input type="hidden" name="day[]" value="<?php echo $dp['day']; ?>">
								<input type="hidden" name="from_time[]" value="<?php echo $dp['from_time']; ?>">
								<input type="hidden" name="to_time[]" value="<?php echo $dp['to_time']; ?>">
								<td>
									<?php
										$s = $this->subject->find($cl['subject']);
										echo $s['code'];
									 ?>
								</td>
								<td><?php echo $this->api->getCourseMajor($cl['coursemajor']); ?></td>
								<td>
								<?php
									$d = $this->edp_classallocation->findDay($dp['day']);
									echo $d['shortname'];
								?>
								</td>
								<td>
								<?php
									echo  $this->edp_classallocation->getPeriodRange($dp['from_time'], $dp['to_time']);
								 ?>
								</td>
								<td>
									<select class="form-control" name="room[]">
									<?php
										foreach($r as $room)
										{
											$dd 	= $dp['day'];
											$classr = $room['id'];
											$ss 	= $systemVal['nextacademicterm'];
											$q 		= $this->db->query("SELECT * FROM tbl_dayperiod,tbl_classallocation WHERE academicterm = $ss AND classallocation = tbl_classallocation.id AND classroom = $classr AND day = $dd");
											if($q->num_rows() > 0)
											{
												foreach($q->result_array() as $qq)
												{
													$st 	= $this->db->get_where('tbl_time', array('id' 	=> $qq['from_time']))->row_array();
													$dp12 	= $this->db->get_where('tbl_time', array('id'	=> $dp['from_time']))->row_array();
													$dp22 	= $this->db->get_where('tbl_time', array('id'	=> $dp['to_time']))->row_array();
													$en 	= $this->db->get_where('tbl_time', array('id' 	=> $qq['to_time']))->row_array();
													$con 	= $this->api->intersectCheck($dp12['time'], $st['time'], $dp22['time'], $en['time']);
													if($con == TRUE)
													{
														$conflict = TRUE;
													}
												}
												if($conflict == FALSE)
												{
													?>
													<option value="<?php echo $room['id']; ?>"><?php echo $room['legacycode'].' | '.$room['location']; ?></option>
													<?php
												}
											}
											else
											{
									?>
											<option value="<?php echo $room['id']; ?>"><?php echo $room['legacycode'].' | '.$room['location']; ?></option>
									<?php
											}
										}
									 ?>
									</select>
								</td>
							</tr>
						<?php
							}
						?>
						</table>
						<input type="submit" value="Assign Room" class="btn btn-primary btn-sm pull-right" style="margin-top:5px;">
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
