<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading hidden-print">
			<h4>Room Schedule</h4>
		</div>
		<div class="panel-body">
		<div class="col-md-12">
			<a href="/preview/<?php echo $roomId; ?>" class="btn btn-primary btn-sm pull-right">Print Preview</a>
			<span class="clearfix"></span>
			<div class="col-md-12 col-bg hidden-print">
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
						$day1 = $this->db->get('tbl_day')->result_array();
						$day = array();

						foreach($day1 as $d)
						{
							if ($d['id'] != 8)
								$day[] = $d['id'];
						}

						$class = $this->edp_classallocation->allocByRoom($roomId);

						$monday 	= array();
						$tuesday 	= array();
						$wednesday 	= array();
						$thursday 	= array();
						$friday 	= array();
						$saturday 	= array();
						$sunday 	= array();
						$color 		= array('#0050EF','#1BA1E2',
											'#AA00FF','#FA6800',
											'#76608A','#6D8764',
											'#F0A30A','#6A00FF',
											'#00ABA9','#008A00',
											'#87794E','#E3C800');
						$ctr = 0;
						foreach($class as $cl)
						{
							if($ctr >= 11)
							{
								$ctr = 0;
							}
							$cc_count = $this->edp_classallocation->countDayPer($cl['id'],$roomId);
							if($cc_count > 0)
							{
								//determine the color of the subject
								$dd = $this->edp_classallocation->getDayPeriod($cl['id'],$roomId);
								foreach ($dd as $per)
								{

									if($per['day'] == 1)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
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
									elseif($per['day'] == 2)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
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
												$tuesday[$i] = array('day'=>'Tuesday');
											}
										}
									}
									elseif ($per['day'] == 3)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
										{
											if($i == $from)
											{
												$wednesday[$i] = array('day' 		=> 'Wednesday',
																		'rowspan' 	=> $span,
																		'subject' 	=> $s['code'],
																		'course'	=> $cc,
																		'color'		=> $color[$ctr]);
											}
											else
											{
												$wednesday[$i] = array('day'=>'Wednesday');
											}
										}
									}
									elseif ($per['day'] == 4)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
										{
											if($i == $from)
											{
												$thursday[$i] = array('day' 	=> 'Thursday',
																	'rowspan' 	=> $span,
																	'subject' 	=> $s['code'],
																	'course' 	=> $cc,
																	'color' 	=> $color[$ctr]);
											}
											else
											{
												$thursday[$i] = array('day'=>'Thursday');
											}
										}
									}
									elseif ($per['day'] == 5)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
										{
											if($i == $from)
											{
												$friday[$i] = array('day' 		=> 'Friday',
																	'rowspan' 	=> $span,
																	'subject' 	=> $s['code'],
																	'course' 	=> $cc,
																	'color' 	=> $color[$ctr]);
											}
											else
											{
												$friday[$i] = array('day'=>'Friday');
											}
										}
									}
									elseif ($per['day'] == 6)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
										{
											if($i == $from)
											{
												$saturday[$i] = array('day' 	=> 'Saturday',
																	'rowspan' 	=> $span,
																	'subject' 	=> $s['code'],
																	'course' 	=> $cc,
																	'color' 	=> $color[$ctr]);
											}
											else
											{
												$saturday[$i] = array('day'=>'Saturday');
											}
										}
									}
									elseif ($per['day'] == 7)
									{
										$from 	= $per['from_time'];
										$to 	= $per['to_time'];
										$span 	= $to-$from;
										$tt 	= $to - 1;
										$s 		= $this->subject->find($cl['subject']);
										$cc 	= $this->edp_classallocation->getCourseShort($cl['coursemajor']);
										for($i = $from;$i <= $tt;$i++)
										{
											if($i == $from)
											{
												$sunday[$i] = array('day' 		=> 'Sunday',
																	'rowspan' 	=> $span,
																	'subject' 	=> $s['code'],
																	'course' 	=> $cc,
																	'color' 	=> $color[$ctr]);
											}
											else
											{
												$sunday[$i] = array('day'=>'Sunday');
											}
										}
									}
								}
								$ctr++;
							}
						}

						$table_day['1'] = $monday;
						$table_day['2']	= $tuesday;
						$table_day['3'] = $wednesday;
						$table_day['4'] = $thursday;
						$table_day['5'] = $friday;
						$table_day['6'] = $saturday;
						$table_day['7'] = $sunday;

						for($i = 0;$i < 27;$i++)
						{
							?>
					<tr>
						<td style="text-align:center;"><strong><?php echo $time[$i].' - '.$time[$i+1]; ?></strong></td>
						<?php
							// if($time[$i] != '12:00' AND $time[$i+1] != '1:00')
							// {
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
		</div>
	</div>
</div>
