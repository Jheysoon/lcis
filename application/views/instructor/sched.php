<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Search for Students</h4>
		</div>
		<div class="panel-body">
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

				$time 	= array();
				$day 	= array();
				foreach($day1 as $d)
				{
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
									'#0050EF','#1BA1E2',
									'#AA00FF','#FA6800',
									'#76608A','#6D8764',
									'#F0A30A','#6A00FF',
									'#00ABA9','#008A00',
									'#87794E','#E3C800'
							);
				$ctr = 0;
				foreach($class as $cl)
				{
					$this->db->where('classallocation', $cl['id']);
					$dd = $this->db->get('tbl_dayperiod')->result_array();
					foreach($dd as $dd1)
					{
						$from 	= $dd1['from_time'];
						$to 	= $dd1['to_time'];
						$span	= $to - $from;
						$limit	= $to - 1;
						$s 		= $this->subject->find($cl['subject']);
						$cc 	= $this->edp_classallocation->getCourseShort($dd1['coursemajor']);
						if($dd1['day'] == 1)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$monday[$i] = array('day'		=> 'Monday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$monday[$i] = array('day'=>'Monday');
								}
							}
						}
						elseif($dd1['day'] == 2)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$tuesday[$i] = array('day'		=> 'Tuesday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$tuesday[$i] = array('day' => 'Tuesday');
								}
							}
						}
						elseif($dd1['day'] == 3)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$wednesday[$i] = array('day'		=> 'Wednesday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$wednesday[$i] = array('day' => 'Wednesday');
								}
							}
						}
						elseif($dd1['day'] == 4)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$thursday[$i] = array('day'		=> 'Thursday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$thursday[$i] = array('day' => 'Thursday');
								}
							}
						}
						elseif($dd1['day'] == 5)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$friday[$i] = array('day'		=> 'Friday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$friday[$i] = array('day' => 'Friday');
								}
							}
						}
						elseif($dd1['day'] == 6)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$saturday[$i] = array('day'		=> 'Saturday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$saturday[$i] = array('day' => 'Saturday');
								}
							}
						}
						elseif($dd1['day'] == 7)
						{
							for($i = $from; $i <= $limit; $i++)
							{
								if($i == $from)
								{
									$sunday[$i] = array('day'		=> 'Sunday',
														'rowspan' 	=> $span,
														'subject' 	=> $s['code'],
														'course' 	=> $cc,
														'color'		=> $color[$ctr]);
								}
								else
								{
									$sunday[$i] = array('day' => 'Sunday');
								}
							}
						}

					}
					$ctr++;
				}
				$table_day['1'] = $monday;
				$table_day['2']	= $tuesday;
				$table_day['3'] = $wednesday;
				$table_day['4'] = $thursday;
				$table_day['5'] = $friday;
				$table_day['6'] = $saturday;
				$table_day['7'] = $sunday;

				for($i = 0;$i < 26;$i++)
				{
					?>
			<tr>
				<td style="text-align:center;"><strong><?php echo $time[$i].' - '.$time[$i+1]; ?></strong></td>
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
								<td rowspan="<?php echo $table_day[$d][$i+1]['rowspan']; ?>" class="colspan" style="background-color:<?php echo $table_day[$d][$i+1]['color']; ?>;">
									<span>
										<?php echo $table_day[$d][$i+1]['subject']; ?>
										<br/>
										<?php echo $table_day[$d][$i+1]['course']; ?>
									</span>
								</td>
								<?php
								}
							}
							else
							{
					?>
							<td style="height:5px;">&nbsp;</td>
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
