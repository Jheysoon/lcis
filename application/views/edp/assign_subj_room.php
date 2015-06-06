<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Assign Subject to Room</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="col-md-12 col-bg">

					</div>
				</div>
				<div class="col-md-12">
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
							/*$day 		= array();
							$start_time	= array();
							$end_time	= array();
							$isDay		= FALSE;
							$isTime		= FALSE;*/
							$conflict	= FALSE;

							$r = $this->edp_classallocation->getAllRoom();

							// get day/period of the subject suggested by dean
							$dayPeriod	= $this->edp_classallocation->getDayPeriod($cid);

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
											$q = $this->db->get_where('tbl_dayperiod',array('classroom' => $room['id'],'day' => $dp['day']));
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
													<option value="<?php echo $room['id']; ?>"><?php echo $room['legacycode']; ?></option>
													<?php
												}
											}
											else
											{
									?>
											<option value="<?php echo $room['id']; ?>"><?php echo $room['legacycode']; ?></option>
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
				</div>
			</div>
		</div>
	</div>
</div>