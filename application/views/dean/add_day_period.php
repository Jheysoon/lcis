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
				        <h5 class="modal-title" id="myModalLabel">ADD <?php $owner = $this->api->getUserCollege(); ?></h5>
				      </div>
				      <div class="modal-body">
				        <select name="subj" class="form-control">
				        	<?php

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
						if($systemVal['classallocationstatus'] == 3)
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
							<th>Subject</th>
							<th>Course</th>
							<th>Action</th>
							<th>Status</th>
						</tr>
						<?php
							$user 		= $this->api->getUserCollege();
							$sub 		= $this->edp_classallocation->getAlloc($systemVal['nextacademicterm'],$owner);

							foreach($sub as $subj)
							{
								/*$c = $this->db->query("SELECT * FROM tbl_course WHERE id = {$subj['coursemajor']} AND college = $owner")->num_rows();
								if($c > 0)
								{*/
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
											$this->db->where('id',$subj['coursemajor']);
											$t = $this->db->get('tbl_course')->row_array();
											echo $t['description'];
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
							?>
						</table>
						<a href="/dean/add_task_comp/4/O">Attest All</a>
					<?php
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
