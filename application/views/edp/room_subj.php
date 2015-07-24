<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

			<div class="col-md-12">
				<?php
					$this->load->view('edp/cl_status');

					$nxt = $this->api->systemValue();
					if($nxt['classallocationstatus'] == 4)
					{
						$this->db->where('academicterm', $nxt['currentacademicterm']);
						$this->db->where('stage', 4);
						$this->db->where('status', 'O');
						$c = $this->db->get('tbl_completion')->num_rows();
						if($c == COLLEGE_COUNT)
						{
				 ?>
			<table class="table table-bordered">
				<caption>
					<strong>
						Academicterm SY:
						<?php

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

						$this->db->where('classallocation',$room['id']);
						$this->db->where('classroom',0);
						$rr = $this->db->count_all_results('tbl_dayperiod');
						if($rr > 0)
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
							$style = 'disabled';
					?>
					<a href="/assign_room/<?php echo $room['id']; ?>" <?php echo $style; ?> class="btn btn-primary btn-xs">Assign Room</a>
					</td>
					<td>
						<?php
							if($room['status'] == 'O')
								echo 'Room Assigned';
						 ?>
					</td>
				</tr>
				<?php
							}
						}
					}
				 ?>
			</table>
			<form action="/edp/cl_inc" method="post">
				<input type="hidden" name="name" value="99">
				<input type="submit" value="Attest All" class="btn btn-primary pull-right">
			</form>
			<?php
					}
					else {
						$message = 'You cannot continue';
						$this->load->view('edp/dean_activity',array('stage' => 4,'message' => $message));
					}
				}
				else {
					if($nxt['classallocationstatus'] == 3)
					{
						$message = 'You cannot continue';
						$this->load->view('edp/dean_activity',array('stage' => 4,'message' => $message));
					}
					else {
					?>
						<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
							The process is not yet here ...
						</div>
				<?php
					}
				}
			?>
			</div>

		</div>
	</div>
