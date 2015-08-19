	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<h4>Manage Section</h4>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-12">
						<?php
							$this->load->view('edp/cl_status');

							$nxt 	= $this->api->systemValue();
							if($nxt['classallocationstatus'] == 1)
							{
								$this->db->where('academicterm', $nxt['currentacademicterm']);
								$this->db->where('stage', 2);
								$this->db->where('completedby', $this->session->userdata('uid'));
								$c = $this->db->get('tbl_completion')->num_rows();
								if($c < 1)
								{
						 ?>
						<a href="/non_exist" class="btn btn-primary btn pull-right">Add Non - Existing Subject</a>
						<span class="clearfix"></span>
						<br/>
						<table class="table table-bordered">
							<caption>
								<strong>
								Preparation for Academicterm SY:
								<?php
									$nnxt 	= $this->academicterm->findById($nxt['nextacademicterm']);
									echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$this->academicterm->getLongName($nnxt['term']);
								 ?>
								 </strong>
							</caption>
							<tr>
								<th>Subject</th>
								<th>Description</th>
								<th>Course</th>
								<th>Year Level</th>
								<th>No. of Student</th>
								<th>Apprx. Section <br/>(<?php echo $nxt['numberofstudent']; ?> students)</td>
								<th>Section</th>
								<th>Action</th>
							</tr>
							<?php
								$all_s = $this->subject->getSubject();
								foreach($all_s as $subj)
								{
							?>
							<tr>
								<td>
									<?php echo $subj['code']; ?>
								</td>
								<td><?php echo $subj['descriptivetitle']; ?></td>
								<td>
									<?php
										$cc = $this->db->query("SELECT shortname FROM tbl_course WHERE id={$subj['coursemajor']}")->row_array();
										echo $cc['shortname'];
									 ?>
								</td>
								<td><?php echo $subj['yearlevel']; ?></td>
								<td><?php echo $subj['studentcount']; ?></td>
								<td><?php echo round($subj['section']); ?></td>

								<form class="addClassAllocation">
								<td>
									<input type="number" min="1" class="form-control input-sm" name="sections" value="<?php echo $subj['section']; ?>" required>
									<input type="hidden" name="out_section_id" value="<?php echo $subj['id']; ?>">
								</td>
								<td>
									<input type="submit" value="Update" class="btn btn-primary btn-sm">
								</td>
								</form>
							</tr>
							<?php
								}
							 ?>
						</table>
						<a href="/dean/add_task_comp/2/O" class="btn btn-primary pull-right">Attest all</a>
					<?php
							}
							else {
					?>
						<div class="alert alert-danger center-block" style="max-width:400px;text-align:center;">
							You have attested this
						</div>
					<?php
							}
						}
						else {
							?>
						<div class="alert alert-danger center-block" style="max-width:400px;">
							Cannot run this program. The EDP must complete the step 1.
						</div>
					<?php
						}
					?>
					</div>
	            </div>
			</div>
		</div>
	</div>
