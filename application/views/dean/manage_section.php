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
						<a href="/non_exist" class="btn btn-primary btn pull-right">Add Non - Existing Subject</a>
						<span class="clearfix"></span>
						<br/>
						<table class="table">
							<caption>
								<strong>
								Preparation for Academicterm SY:
								<?php 
									$owner 	= $this->api->getUserCollege();
									$nxt 	= $this->api->systemValue();
									$nnxt 	= $this->academicterm->findById($nxt['nextacademicterm']);
									echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$this->academicterm->getLongName($nnxt['term']);
								 ?>
								 </strong>
							</caption>
							<tr>
								<td>Subject</td>
								<td>Description</td>
								<td>Year Level</td>
								<td>Course</td>
								<td>No. of Student</td>
								<td>Apprx. Section <br/>(<?php echo $nxt['numberofstudent']; ?> students)</td>
								<td>Section</td>
								<td>Action</td>
							</tr>
							<?php 
								$this->db->order_by('coursemajor ASC, yearlevel ASC');
								$all_s = $this->db->get('out_section')->result_array();
								foreach($all_s as $subj)
								{
									$ss = $this->subject->whereCode_owner($owner,$subj['subject']);
									if($ss > 0)
									{
							?>
							<tr>
								<td>
									<?php 
										$t = $this->subject->find($subj['subject']);
										echo $t['code'];
									 ?>
								</td>
								<td><?php echo $t['descriptivetitle']; ?></td>
								<td><?php echo $subj['yearlevel']; ?></td>
								<td>
									<?php 
										$cc = $this->db->query("SELECT * FROM tbl_course WHERE id={$subj['coursemajor']}")->row_array();
										echo $cc['shortname'];
									 ?>
								</td>
								<td><?php echo $subj['studentcount']; ?></td>
								<td><?php echo $subj['section']; ?></td>

								<form class="addClassAllocation">
								<td>
									<input type="number" min="1" class="form-control input-sm" name="sections" value="<?php echo $subj['section']; ?>" required>
									<input type="hidden" name="out_section_id" value="<?php echo $subj['id']; ?>">
								</td>
								<td>
									<input type="submit" value="Add" class="btn btn-primary btn-sm">
								</td>
								</form>

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
	</div>

