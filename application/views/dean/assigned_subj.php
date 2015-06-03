<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Assign Day/Period</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
				<?php echo $this->session->flashdata('message'); ?>
					<?php 
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
									$c = $this->api->getCourse($cl['coursemajor']);
									$m = $this->api->getMajor($cl['coursemajor']);
									$ms = '';
									if($m->num_rows() > 0)
									{
										$mm = $m->row_array();
										$ms = '('.$mm['description'].')';
									}
									echo $c.' '.$ms;
								 ?>
							</td>
					 	</tr>
					 </table>
					 <div class="col-md-4">
					 	
					 </div>
					 <div class="col-md-4">
					 	<label>Select how many days</label>
					 	<select class="form-control" name="days_count" data-classId="<?php echo $cid; ?>">
					 		<option value="1">1</option>
					 		<option value="2">2</option>
					 		<option value="3">3</option>
					 	</select>
					 </div>
					 <div class="col-md-4">
					 	
					 </div>
					 <div class="col-md-12">
					 	<form action="/dean/ass_subj" method="post">
					 		<input type="hidden" name="url" value="<?php echo current_url(); ?>">
					 		<input type="hidden" name="class_id" value="<?php echo $cid; ?>">
						 	<table class="table" id="table_day">
						 		<tr>
						 			<th>Day</th>
						 			<th>Start Period</th>
						 			<th>End Period</th>
						 		</tr>
						 		<tr>
						 			<td>
						 				<select class="form-control" name="day[]">
						 				<?php 
						 					$d = $this->db->get('tbl_day')->result_array();
						 					foreach($d as $day){
						 				?>
						 					<option value="<?php echo $day['id'] ?>"><?php echo $day['day']; ?></option>
						 				<?php } ?>
						 				</select>
						 			</td>
						 			<td>
						 				<select class="form-control" name="start_time[]">
						 				<?php 
						 					$t = $this->db->get('tbl_time')->result_array();
						 					foreach($t as $time){
						 				 ?>
						 				 	<option value="<?php echo $time['id'] ?>"><?php echo $time['time'] ?></option>
						 				 <?php } ?>
						 				 </select>
						 			</td>
						 			<td>
						 				<select class="form-control" name="end_time[]">
						 				<?php 
						 					//$t = $this->db->get('tbl_time')->result_array();
						 					foreach($t as $time)
						 					{
						 						if($time['id'] != 1){
						 				 ?>
						 				 	<option value="<?php echo $time['id'] ?>"><?php echo $time['time'] ?></option>
						 				 <?php 
						 				 		} 
						 				 	}
						 				 	?>
						 				 </select>
						 			</td>
						 		</tr>
						 	</table>
						 	<input type="submit" class="btn btn-primary pull-right" value="Submit">
						 </form>
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>