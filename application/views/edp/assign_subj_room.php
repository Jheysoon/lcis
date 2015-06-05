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
					<div class="col-md-4">
					
					</div>
					<div class="col-md-4">
						<select class="form-control">
						<?php 
							$cl 		= $this->edp_classallocation->find($cid);
							$classroom 	= $cl['classroom'];
							$day 		= array();
							$start_time	= array();
							$end_time	= array();
							$isDay		= FALSE;
							$isTime		= FALSE;
							$dayPeriod	= $this->edp_classallocation->getDayPeriod($cid);
							foreach($dayPeriod as $dp)
							{
								$day[]			= $dp['day'];
								$time 			= $this->edp_classallocation->getPeriodId($dp['period']);
								$start_time[] 	= $time['from_time'];
								$end_time[]		= $time['to_time'];
							}
							$r 			= $this->classroom->all();
							foreach($r as $room)
							{
								$cc = $this->edp_classallocation->roomUsed($room['id']);
								if($cc > 0)
								{
									$clid = $this->edp_classallocation->getClid($room['id']);
									foreach($clid as $cl1)
									{
										$dd = $this->edp_classallocation->getDays($cl1['id']);
										foreach($dd as $dd1)
										{
											if(in_array($dd1['day'], $day))
												$isDay = TRUE;
										}
										if($isDay == FALSE)
										{
											?>
											<option value="<?php echo $room['id']; ?>"><?php echo $room['legacycode']; ?></option>
									<?php
										}
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
					</div>
					<div class="col-md-4">
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>