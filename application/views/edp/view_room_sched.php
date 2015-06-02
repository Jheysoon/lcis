<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading">
			<h4>Room Schedule</h4>
		</div>
		<div class="panel-body">
		<div class="col-md-12">
			<div class="col-md-12 col-bg">
				<strong class="strong">Room : </strong>
				<label class="lbl-data"> <?php echo $room_name; ?></label>
				<strong class="strong">Location : </strong>
				<label class="lbl-data"> <?php echo $location; ?></label>
			</div>
		</div>
		<div class="col-md-12">
			<div>
			
				<table class="table table-bordered">
					<tr>
						<th>Time \ Day</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>

					<?php 
						// get all time periods
						$time1 = $this->db->get('tbl_time')->result_array();
						$time = array();

						foreach($time1 as $t)
						{
							$time[] = $t['time'];
						}

						//get all the days
						$day1 = $this->db->get('tbl_day1')->result_array();
						$day = array();

						foreach($day1 as $d)
						{
							$day[] = $d['id'];
						}

						// sample data room id
						$room_id = 1;

						$class = $this->edp_classallocation->allocByRoom($room_id);

						$monday = array();
						$tuesday = array();
						$wednesday = array();
						$thursday = array();
						$friday = array();
						$saturday = array();
						$sunday = array();

						foreach($class as $cl)
						{
							$d = $this->edp_classallocation->getDayPeriod($cl['id']);
							foreach($d as $day)
							{
								if($day['day'] == 1)
								{
									
								}
								elseif ($day['day'] == 2) {
									# code...
								}
								elseif ($day['day'] == 3) {
									# code...
								}
								elseif ($day['day'] == 4) {
									# code...
								}
								elseif ($day['day'] == 5) {
									# code...
								}
								elseif ($day['day'] == 6) {
									# code...
								}
								elseif ($day['day'] == 7) {
									# code...
								}
							}
						}

						
						$monday[5] = array('day'=>'Monday');
						$monday[6] = array('day'=>'Monday');
						$monday[7] = array('day'=>'Monday');
						$table_day['1'] = $monday;
						$table_day['1'][5]['rowspan'] = 3;

						
						$tuesday[6] = array('day'=>'Monday');
						$tuesday[7] = array('day'=>'Monday');
						$tuesday[8] = array('day'=>'Monday');
						$tuesday[9] = array('day'=>'Monday');
						$tuesday[10] = array('day'=>'Monday');
						$table_day['2'] = $tuesday;
						$table_day['2'][6]['rowspan'] = 5;

						for($i = 0;$i < 25;$i++)
						{
							?>
					<tr>
						<th><?php echo $time[$i].' - '.$time[$i+1]; ?></th>
						<?php 
							if($time[$i] != '12:00' AND $time[$i+1] != '1:00')
							{
								foreach($day as $d)
								{
									//checks if there is scheduled subject
									if(!empty($table_day[$d][$i+1]))
									{
										if(!empty($table_day[$d][$i+1]['rowspan']))
										{
										?>
										<td rowspan="<?php echo $table_day[$d][$i+1]['rowspan']; ?>" class="colspan" style="background-color:#3c763d;">
											<span>Subject</span>
										</td>
										<?php
										}
									}
									else
									{
							?>
									<td>&nbsp;</td>
							<?php
									}
								}
							}
							else
							{
								echo '<td colspan="7" style="text-align:center;">LUNCH BREAK</td>';
							}
						 ?>

					</tr>

					<?php
						}
					 ?>
				</table>
			</div>

			</div>
		</div>
		</div>
	</div>
</div>