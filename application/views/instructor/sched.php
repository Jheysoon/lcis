<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Search for Students</h4>
		</div>
		<div class="panel-body">
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
					}
					$ctr++;
				}
			 ?>
		</div>
	</div>
</div>
