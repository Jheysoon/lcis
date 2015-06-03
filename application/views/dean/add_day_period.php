<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
				<h4>Add Day/Period</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="col-md-12 col-bg">
					</div>
				</div>
				<div class="col-md-12">
				<?php echo $this->session->flashdata('message'); ?>
					
				
					<?php 
						$systemVal 	= $this->api->systemValue();
						$this->db->where('academicterm',$systemVal['nextacademicterm']);
						$cc = $this->db->count_all_results('tbl_classallocation');
						if($cc > 0)
						{
							?>
					<table class="table">
						<tr>
							<th>Subject</th>
							<th>Course</th>
							<th>Action</th>
							<th>Status</th>
						</tr>
						<?php
							$user 		= $this->api->getUserCollege();
							$sub 		= $this->edp_classallocation->getAlloc($systemVal['nextacademicterm']);

							foreach($sub as $subj)
							{
								$c = $this->subject->whereCode_owner($user,$subj['subject']);
								if($c > 0)
								{
							?>
								<tr>
									<td>
										<?php 
											$s = $this->subject->find($subj['subject']);
											echo $s['code'];
										 ?>
									</td>
									<td>
										<?php 
											$c = $this->api->getCourse($subj['coursemajor']);
											$m = $this->api->getMajor($subj['coursemajor']);
											$ms = '';
											if($m->num_rows() > 0)
											{
												$mm = $m->row_array();
												$ms = '('.$mm['description'].')';
											}
											echo $c.' '.$ms;
										 ?>
									</td>
									<td><a href="/add_day_period/<?php echo $subj['id']; ?>" class="btn btn-primary btn-xs">Add Day/Period</a></td>
									<td>Checking</td>
								</tr>
							<?php
								}
							}
							?>
						</table>
					<?php
						}
						else
						{
					 ?>
					 	<div class="alert alert-danger">Class Allocation is not been iniatialized</div>
					 <?php } ?>
				 
				</div>
			</div>
		</div>
	</div>
</div>