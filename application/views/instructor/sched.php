<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4><?php echo $name['firstname'].', '.$name['lastname'].' '.$name['middlename'] ?></h4>
		</div>
		<?php
			$this->db->where('id', $owner);
			$col = $this->db->get('tbl_college')->row_array();

			$this->db->where('id', $acam);
			$sy = $this->db->get('tbl_academicterm')->row_array();

			$this->db->where('id', $sy['term']);
			$this->db->select('abbreviation');
			$term = $this->db->get('tbl_term')->row_array();
		 ?>
		<div class="panel-body">
			<a href="/instructor_sched" class="btn btn-success pull-right">Back</a>
			<table class="table table-bordered">
				 <caption>
					 <strong>
					 School Year: <?php echo $sy['systart'].'-'.$sy['syend'] ?> Term: <?php echo $term['abbreviation'] ?>
					 <br><?php echo $col['description'] ?>
					 </strong>
				 </caption>
				<tr>
					<th style="text-align:center;width: 120px;">Time \ Day</th>
					<th style="text-align:center">Monday</th>
					<th style="text-align:center">Tuesday</th>
					<th style="text-align:center">Wednesday</th>
					<th style="text-align:center">Thursday</th>
					<th style="text-align:center">Friday</th>
					<th style="text-align:center">Saturday</th>
					<th style="text-align:center">Sunday</th>
				</tr>
            <?php

				$time 	= array();
				$day 	= array();

				foreach($time1 as $t)
				{
					$time[] = $t['time'];
				}

				foreach($day1 as $d)
				{
					if($d['id'] != 8)
						$day[] = $d['id'];
				}

				$monday 	= array();
				$tuesday 	= array();
				$wednesday 	= array();
				$thursday 	= array();
				$friday 	= array();
				$saturday 	= array();
				$sunday 	= array();
				$color 		= array(
									'#BA68C8','#0097A7',
									'#F06292','#039BE5',
									'#E57373','#00C853',
									'#7986CB','#689F38',
									'#9575CD','#43A047',
									'#009688','#EF6C00'
							);
				$ctr = 0;

				foreach ($class as $cl) {
					$this->db->where('classallocation', $cl['id']);
					$dd = $this->db->get('tbl_dayperiod')->result_array();


					foreach ($dd as $dd1) {

						if($dd1['day'] == 8 OR $dd1['from_time'] == 0 OR $dd1['to_time'] == 0)
							continue;

						$from 	= $dd1['from_time'];
						$to 	= $dd1['to_time'];
						$span	= $to - $from;
						$limit	= $to - 1;
						$s 		= $this->subject->find($cl['subject']);
						$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
						$this->db->where('id', $dd1['classroom']);
						$this->db->select('legacycode');
						$room = $this->db->get('tbl_classroom')->row_array();

						if ($dd1['day'] == 1) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$monday[$i] = array('day'		=> 'Monday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$monday[$i] = array('day'=>'Monday');
								}

							}

						} elseif ($dd1['day'] == 2) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$tuesday[$i] = array('day'		=> 'Tuesday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$tuesday[$i] = array('day' => 'Tuesday');
								}

							}
						} elseif($dd1['day'] == 3) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$wednesday[$i] = array('day'		=> 'Wednesday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$wednesday[$i] = array('day' => 'Wednesday');
								}

							}

						} elseif ($dd1['day'] == 4) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$thursday[$i] = array('day'		=> 'Thursday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$thursday[$i] = array('day' => 'Thursday');
								}

							}

						} elseif ($dd1['day'] == 5) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$friday[$i] = array('day'		=> 'Friday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$friday[$i] = array('day' => 'Friday');
								}

							}

						} elseif ($dd1['day'] == 6) {
							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$saturday[$i] = array('day'		=> 'Saturday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$saturday[$i] = array('day' => 'Saturday');
								}

							}

						} elseif ($dd1['day'] == 7) {

							for ($i = $from; $i <= $limit; $i++) {

								if ($i == $from) {
									$sunday[$i] = array('day'		=> 'Sunday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr],
														'room'		=> $room['legacycode']);
								} else {
									$sunday[$i] = array('day' => 'Sunday');
								}

							}

						}

					}
					$ctr++;
					if ($ctr > 11)
						$ctr = 0;

				}
				$table_day['1'] = $monday;
				$table_day['2']	= $tuesday;
				$table_day['3'] = $wednesday;
				$table_day['4'] = $thursday;
				$table_day['5'] = $friday;
				$table_day['6'] = $saturday;
				$table_day['7'] = $sunday;

				for ($i = 0;$i < 27;$i++) {
					?>
			<tr>
				<td style="text-align:center;"><strong><?php echo $time[$i].' - '.$time[$i+1]; ?></strong></td>
				<?php
					// if($time[$i] != '12:00' AND $time[$i+1] != '1:00')
					// {
						foreach ($day as $d) {

							//checks if there is scheduled subject
							if (!empty($table_day[$d][$i+1])) {

								if (!empty($table_day[$d][$i+1]['rowspan'])) {
								?>
								<td rowspan="<?php echo $table_day[$d][$i+1]['rowspan']; ?>" class="colspan" style="background-color:<?php echo $table_day[$d][$i+1]['color']; ?>;">
									<span>
										<?php echo $table_day[$d][$i+1]['subject']; ?>
										<br/>
										<?php echo $table_day[$d][$i+1]['course']; ?>

										<?php echo $table_day[$d][$i+1]['room']; ?>
									</span>
								</td>
								<?php
								}

							} else {
					?>
							<td style="height:5px;">&nbsp;</td>
					<?php
							}
						}
					// }
					// else
					// {
					// 	echo '<td colspan="7" style="text-align:center;">LUNCH BREAK</td>';
					// }
				 ?>

			</tr>
			<?php
				}
			 ?>
		 	</table>
		</div>
	</div>
</div>
