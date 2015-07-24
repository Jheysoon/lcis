<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Assign Subject to Room</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<?php echo $this->session->flashdata('message'); ?>
					<div class="col-md-12 col-bg">
						<form action="/dean/ass_subj" method="post">
							<input type="hidden" name="class_id" value="<?php echo $cid; ?>">
							<input type="hidden" name="edp" value="1">
							<?php
								$dp_count 	= $this->db->count_all_results('tbl_dayperiod');
								if($dp_count > 0){
							?>
							<label class="center-block" style="max-width:200px;"><strong>Override Dean's Day and Period</strong></label>
							<?php
								}
								else {
									?>
							<table class="table">
								<label class="center-block" style="max-width:200px;"><strong>Add Day and Period</strong></label>
								<tr>
									<th>Subject</th>
								</tr>
								<tr>
									<td>
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
							<div class="col-md-4">

							</div>
							<div class="col-md-4">
								<label>Select how many days</label>
								<select class="form-control" name="days_count" data-classId="<?php echo $cid; ?>">
									<option value="1" <?php echo set_select('days_count','1'); ?>>1</option>
									<option value="2" <?php echo set_select('days_count','2'); ?>>2</option>
									<option value="3" <?php echo set_select('days_count','3'); ?>>3</option>
								</select>
								<br/>
							</div>
							<div class="col-md-4"></div>
							<div class="col-md-12">
								<table class="table" id="table_day">
									<tr>
										<th>Day</th>
										<th>Start Period</th>
										<th>End Period</th>
									</tr>
									<?php for($i = 0;$i <= $num;$i++) {?>
										<tr>
										<td>
											<select class="form-control" name="day[]">
											<?php
												$d = $this->db->get('tbl_day')->result_array();
												foreach($d as $day){
											?>
												<option value="<?php echo $day['id'] ?>" <?php echo set_select('day['.$i.']',$day['id']); ?>><?php echo $day['day']; ?></option>
											<?php } ?>
											</select>
										</td>
										<td>
											<select class="form-control" name="start_time[]">
											<?php
												$t = $this->db->get('tbl_time')->result_array();
												foreach($t as $time){
											 ?>
												<option value="<?php echo $time['id'] ?>" <?php echo set_select('start_time['.$i.']',$time['id']); ?>><?php echo $time['time'] ?></option>
											 <?php } ?>
											 </select>
										</td>
										<td>
											<select class="form-control" name="end_time[]">
											<?php
												foreach($t as $time)
												{
													if($time['id'] != 1){
											 ?>
												<option value="<?php echo $time['id'] ?>" <?php echo set_select('end_time['.$i.']',$time['id']); ?>><?php echo $time['time'] ?></option>
											 <?php
													}
												}
												?>
											 </select>
										</td>
									</tr>
									<?php } ?>
								</table>
								<input type="submit" value="Add / Change" class="btn btn-primary btn-sm pull-right">
								<br/><br/>
							</div>
						</form>
						<hr/>
					</div>
				</div>
				<div class="col-md-12">
					<?php if($dp_count > 0){ ?>
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
									echo  $this->edp_classallocation->getPeriodRange($dp['from_time'],$dp['to_time']);
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
													$st 	= $this->db->get_where('tbl_time',array('id' => $qq['from_time']))->row_array();
													$dp12 	= $this->db->get_where('tbl_time',array('id'=> $dp['from_time']))->row_array();
													$dp22 	= $this->db->get_where('tbl_time',array('id'=> $dp['to_time']))->row_array();
													$en 	= $this->db->get_where('tbl_time',array('id' => $qq['to_time']))->row_array();
													$con 	= $this->api->intersectCheck($dp12['time'],$st['time'],$dp22['time'],$en['time']);
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
