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

				<div class="modal fade" id="modal_classalloc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-sm">
				    <div class="modal-content">

				    <form action="/add_classalloc" method="post">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h5 class="modal-title" id="myModalLabel">ADD</h5>
				      </div>
				      <div class="modal-body">
				        <select name="subj" class="form-control">
				        	<?php
								$owner = $this->api->getUserCollege();
	            				$s = $this->subject->subjectOwner($owner);
	            				foreach($s as $ss)
	            				{
	            					?>
	            				<option value="<?php echo $ss['id']; ?>"><?php echo $ss['code'].' | '.$ss['descriptivetitle'];?></option>
	            			<?php
	            				}
	            			 ?>
				        </select>
				        <br/>
				        <select class="form-control" name="course_major">
	            			<?php
	            				$c = $this->course->getAllCourse();
	            				foreach($c as $cc)
	            				{
	            					?>
	            					<option value="<?php echo $cc['id'] ?>">
	            					<?php
	            						echo $this->api->getCourseMajor($cc['id']);
	            					 ?>
	            					</option>
	            			<?php
	            				}
	            			 ?>
	            		</select>
				      </div>
				      <div class="modal-footer">
				      	<button type="button" class="btn btn-primary">Save</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </form>

				    </div>
				  </div>
				</div>

				<div class="col-md-12">
					<?php
						$this->load->view('edp/cl_status');

						echo $this->session->flashdata('message');

						$systemVal 	= $this->api->systemValue();
						$user_id 	= $this->session->userdata('uid');
						if($systemVal['classallocationstatus'] == 3)
						{
							$this->db->where('stage', 4);
							$this->db->where('completedby', $user_id);
							$t = $this->db->count_all_results('tbl_completion');
							if($t < 1)
							{
							?>
					<a href="/add_classalloc" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_classalloc">Add</a>
					<table class="table">
						<caption>
						<?php
							$acam 		= $this->academicterm->findById($systemVal['nextacademicterm']);
							echo $acam['systart'].' - '.$acam['syend'].' Term:'.$this->academicterm->getLongName($acam['term']);
						 ?>
						 </caption>
						<tr>
							<th style="text-align:center;">Subject</th>
							<!-- this must be college -->
							<th style="text-align:center;">Course</th>
							<th style="text-align:center;">Action</th>
							<th style="text-align:center;">Status</th>
						</tr>
						<?php
							//$user 		= $this->api->getUserCollege();
							$sub 		= $this->edp_classallocation->getAlloc($systemVal['nextacademicterm']);

							foreach($sub as $subj)
							{
								if($user_id == $systemVal['employeeid'])
								{
									$this->db->where('computersubject', 1);
									$this->db->where('id', $subj['subject']);
								}
								elseif($owner == 1)
								{
									//$this->db->where('owner', $owner);
									$this->db->where('id', $subj['subject']);
									$this->db->where('gesubject',1);
								}
								else
								{
									$this->db->where('owner', $owner);
									$this->db->where('id', $subj['subject']);
									$this->db->where('gesubject',0);
								}

								$q = $this->db->count_all_results('tbl_subject');
								if($q > 0)
								{
							?>
								<tr>
									<td style="text-align:center;">
										<?php
											$s = $this->subject->find($subj['subject']);
											echo $s['code'];
										 ?>
									</td>
									<td style="text-align:center;">
										<?php
											$this->db->where('id',$subj['coursemajor']);
											$t = $this->db->get('tbl_course')->row_array();
											echo $t['description'];
										 ?>
									</td>
									<td style="text-align:center;">
									<?php
										$style = '';
										if(!empty($subj['status']))
											$style = 'disabled'
									 ?>
										<a href="/add_day_period/<?php echo $subj['id']; ?>" <?php echo $style; ?> class="btn btn-primary btn-xs">Add Day/Period</a> |
										<a href="/delete_classalloc/<?php echo $subj['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure you want to delete ?');">Delete</a>
										</td>
									<td style="text-align:center;">
										<?php
										// if(empty($subj['status']))
										// 	echo 'Checking';
										// else{
										// 	if($subj['status'] == 'O')
										// 		echo 'OK';
											$this->db->where('classallocation', $subj['id']);
											$tt = $this->db->count_all_results('tbl_dayperiod');
											if($tt > 0)
											{
												echo 'Added day and period';
											}
											else {
												echo 'No assigned day and period';
											}
										}
										 ?>
									</td>
								</tr>
							<?php
								}
							}
							?>
						</table>
						<a href="/dean/add_task_comp/4/O" class="btn btn-primary pull-right">Attest All</a>
					<?php
							}
							else {
						?>
							<div class="alert alert-danger center-block" style="text-align:center;max-width:400px;">
								You have attested this..
							</div>
						<?php
							}
						}
						else
						{
					 ?>
						<div class="alert alert-danger center-block" style="max-width:400px;text-align:center">
							Class Allocation is not been iniatialized
							</div>
					 <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
