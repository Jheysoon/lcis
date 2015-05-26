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
							<tr>
								<td>Subject</td>
								<td>Year Level</td>
								<td>Course</td>
								<td>No. of Student</td>
								<td>Apprx. Section</td>
								<td>Section</td>
								<td>Action</td>
							</tr>
							<?php
								// get the system value
								$systemVal = $this->api->systemValue();
								$stud_num = $systemVal['numberofstudent'];

								$cur_acam = $systemVal['currentacademicterm'];
								
								$owner = $this->api->getUserCollege();
								$acam = $this->db->query("SELECT * FROM tbl_academicterm WHERE id = $cur_acam")->row_array();
								$term = $acam['term'];
								$course = $this->out_studentcount->getGroup();

								

								foreach($course as $cc)
								{
									for($i = $cur_acam;$i > 0;$i--)
									{
										$a = $this->curriculum->getCur($i,$cc['coursemajor']);
                                        if($a != 'repeat')
                                        {
                                            break;
                                        }
									}
									$cmajor = $cc['coursemajor'];
									$cur_range1 = $cur_acam - 12;

									$cours_m = $this->api->getCourse($cmajor);
									$cours_major = $this->api->getMajor($cmajor);

									if($cours_major->num_rows() > 0)
									{
										$c1 = $cours_major->row_array();
										$cours_major1 = '('.$c1['description'].')';
									}
									else
									{
										$cours_major1 = '';
									}

									//find if there are many active curriculum
									$cur_range = $this->db->query("SELECT * FROM tbl_curriculum WHERE academicterm between $cur_range1 and $cur_acam and coursemajor = $cmajor")->num_rows();

									if($cur_range > 0)
									{
										$cur = $this->db->query("SELECT * FROM tbl_curriculum WHERE academicterm between $cur_range1 and $cur_acam and coursemajor = $cmajor")->result_array();
										foreach($cur as $cur1)
										{
											$cus = $cur1['id'];
											$cur_detail = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum = $cus AND term = $term")->result_array();
											foreach($cur_detail as $c_detail)
											{ 
												$ss = $this->subject->whereCode_owner($owner,$c_detail['subject']);

												if($ss > 0)
												{
													$count_alloc = $this->classallocation->chkClassAlloc($c_detail['subject'],$systemVal['nextacademicterm'],$cmajor);
													if($count_alloc < 1)
													{
												?>
												<tr>
													<td>
													<?php 
														$t = $this->subject->find($c_detail['subject']);
														echo $t['code'];
													?>
													</td>
													<td><?php echo $y = $c_detail['yearlevel']; ?></td>
													<td><?php echo $cours_m.' '.$cours_major1; ?></td>
													<td>
														<?php 
															$o = $this->db->query("SELECT * FROM out_studentcount Where coursemajor = $cmajor and yearlevel = $y")->row_array();
															echo $o['studentcount'];
														 ?>
													</td>
													<td>
													<?php 
														if($o['studentcount'] != 0 AND $o['studentcount'] > $stud_num)
														{
															echo (int) ($o['studentcount'] / $stud_num);
														}
														else
														{
															echo 0;
														}
												 	?>
												 	</td>

												 	<form class="addClassAllocation">
													<td>
														<input type="hidden" name="is_ajax" value="1">
														<input type="hidden" name="subject" value="<?php echo $t['id']; ?>">
														<input type="hidden" name="course_major" value="<?php echo $cmajor; ?>">
												 		<input type="number" min="1" class="form-control input-sm" name="sections" required>
												 	</td>
												 	<td>
												 		<input type="submit" class="btn btn-primary btn-sm" value="Add">
												 	</td>
												 	</form>
												 	
												</tr>
												<?php
													}
												}
										
											}
										}
									}
									elseif($a != 'repeat')
									{
										$cus = $a;
										$cur_detail = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum = $cus AND term = $term")->result_array();
										foreach($cur_detail as $c_detail)
										{
											$ss = $this->subject->whereCode_owner($owner,$c_detail['subject']);

											if($ss > 0)
											{
												$count_alloc = $this->classallocation->chkClassAlloc($c_detail['subject'],$systemVal['nextacademicterm'],$cmajor);
												if($count_alloc < 1)
												{
											?>
											<tr>
												<td>
												<?php 
													$t = $this->subject->find($c_detail['subject']);
													echo $t['code'];
												?>
												</td>
												<td><?php echo $y = $c_detail['yearlevel']; ?></td>
												<td><?php echo $cours_m; ?></td>
												<td>
													<?php 
														$o = $this->db->query("SELECT * FROM out_studentcount Where coursemajor = $cmajor and yearlevel = $y")->row_array();
														echo $o['studentcount'];
													 ?>
												</td>
												<td>
												<?php 
													if($o['studentcount'] != 0 AND $o['studentcount'] > $stud_num)
													{
														echo (int) ($o['studentcount'] / $stud_num);
													}
													else
													{
														echo 0;
													}
												 ?>
												 </td>
												<form class="addClassAllocation">
												<td>
													<input type="hidden" name="is_ajax" value="1">
													<input type="hidden" name="studentcount" value="<?php echo $o['studentcount']; ?>">
													<input type="hidden" name="subject" value="<?php echo $t['id']; ?>">
													<input type="hidden" name="course_major" value="<?php echo $cmajor; ?>">
											 		<input type="number" min="1" class="form-control input-sm" name="sections" required>
											 	</td>
											 	<td>
											 		<input type="submit" class="btn btn-primary btn-sm" value="Add">
											 	</td>
											 	</form>
											</tr>
											<?php
												}
											}
									
										}
									}
									//else
									//{
										//set the academicterm to zero
										//fallback function
									//}
									
								}
							 ?>
						</table>
					</div>
	            </div>
			</div>
		</div>
	</div>

