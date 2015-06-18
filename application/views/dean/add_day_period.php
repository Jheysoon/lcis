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
						echo $this->session->flashdata('message'); 
					
						$systemVal 	= $this->api->systemValue();
						$this->db->where('academicterm',$systemVal['nextacademicterm']);
						$cc = $this->db->count_all_results('tbl_classallocation');
						if($cc > 0)
						{
							?>
							<a href="/add_classalloc" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_classalloc">Add</a>
					<table class="table">
						<caption>
						<?php 
							$systemVal 	= $this->api->systemValue();
							$acam 		= $this->academicterm->findById($systemVal['nextacademicterm']);
							echo $acam['systart'].' - '.$acam['syend'].' Term:'.$this->academicterm->getLongName($acam['term']); 
						 ?>
						 </caption>
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
											echo $this->api->getCourseMajor($subj['coursemajor']);
										 ?>
									</td>
									<td>
									<?php 
										$style = '';
										if(!empty($subj['status']))
											$style = 'disabled'
									 ?>
										<a href="/add_day_period/<?php echo $subj['id']; ?>" <?php echo $style; ?> class="btn btn-primary btn-xs">Add Day/Period</a> |
										<a href="/delete_classalloc/<?php echo $subj['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure you want to delete ?');">Delete</a>
										</td>
									<td>
										<?php 
										if(empty($subj['status']))
											echo 'Checking';
										else{
											if($subj['status'] == 'O')
												echo 'OK';
										}
											
										 ?>
									</td>
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