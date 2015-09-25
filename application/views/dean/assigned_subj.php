<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Assign Day/Period</h4>
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
					 <form action="/add_day_period/<?php echo $cid; ?>" method="post">

					 <div class="col-md-4 col-md-offset-4">
						<label>Select how many days</label>
						<select class="form-control" name="days_count" data-classId="<?php echo $cid; ?>">
							<option value="1" <?php echo set_select('days_count','1'); ?>>1</option>
							<option value="2" <?php echo set_select('days_count','2'); ?>>2</option>
							<option value="3" <?php echo set_select('days_count','3'); ?>>3</option>
						</select>
					 </div>
					 <div class="col-md-4">

					 </div>
					 <div class="col-md-12">

						<input type="hidden" name="url" value="<?php echo current_url(); ?>">
						<input type="hidden" name="class_id" value="<?php echo $cid; ?>">
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
											if($time['id'] != 1)
											{
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
						<input type="submit" class="btn btn-primary pull-right" value="Submit">
					 </div>
					 </form>
				</div>
			</div>
		</div>
	</div>
</div>
