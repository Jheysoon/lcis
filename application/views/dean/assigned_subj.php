<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Subject Schedule</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
				<?php
					echo $this->session->flashdata('message');
					echo $error;
					$cl = $this->edp_classallocation->find($cid);
				?>
					 <table class="table">
						<tr>
							<th>Subject</th>
							<th>Course</th>
						</tr>
						<tr>
							<td>
							<?php
								$sub = $this->subject->find($cl['subject']);
								echo $sub['code'];
							 ?>
							</td>
							<td>
								<?php
									$this->db->where('id', $cl['coursemajor']);
									$t = $this->db->get('tbl_course')->row_array();
									echo $t['description'];
								 ?>
							</td>
						</tr>
					 </table>
				</div>

				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<form action="/add_day_period/<?php echo $cid; ?>" method="post">
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
								<input type="submit" class="btn btn-primary pull-right" value="Submit">
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
