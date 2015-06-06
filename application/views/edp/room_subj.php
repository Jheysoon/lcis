<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

			<div class="col-md-12">
			<table class="table">
				<caption>
					<strong>
						Academicterm SY:
						<?php 
							$nxt = $this->api->systemValue();
							$nnxt = $this->academicterm->findById($nxt['nextacademicterm']);
							echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$nnxt['term'];
						 ?>
					</strong>
				</caption>
				<tr>
					<th style="text-align:center;">Subject</th>
					<th style="text-align:center;">Course</th>
					<th style="text-align:center;">Day</th>
					<th style="text-align:center;">Period</th>
					<th style="text-align:center;">Action</th>
					<th style="text-align:center;">Status</th>
				</tr>
				<?php 
					$r = $this->edp_classallocation->getEmptyRoom();
					foreach($r as $room)
					{
						if($this->edp_classallocation->chkDayPeriod($room['id']) > 0)
						{
						?>
				<tr>
					<td>
						<?php 
							$s = $this->subject->find($room['subject']);
							echo $s['code'];
						 ?>
					</td>
					<td>
						<?php 
							echo $this->api->getCourseMajor($room['coursemajor']);
						 ?>
					</td>
					<td style="text-align:center;">
						<?php echo $this->edp_classallocation->getDayShort($room['id']); ?>
					</td>
					<td style="text-align:center;">
						<?php echo $this->edp_classallocation->getPeriod($room['id']); ?>
					</td>
					
					<td>
					<?php 
						$style = '';
						if(!empty($room['status']))
						{
							$style = 'disabled';
						}
					?>
					<a href="/assign_room/<?php echo $room['id']; ?>" <?php echo $style; ?> class="btn btn-primary btn-xs">Assign Room</a></td>
					<td>
						<?php 
							if($room['status'] == 'O')
							{
								echo 'Room Assigned';
							}
						 ?>
					</td>
				</tr>
				<?php
						}
					}
				 ?>
			</table>

			</div>
			
		</div>
	</div>
</div>