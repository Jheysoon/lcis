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
						<table class="table">
							<tr>
								<td>Subject</td>
								<td>Course</td>
								<td>Year Level</td>
								<td>Count</td>
								<td>Section</td>
							</tr>
							<?php 
								$cur_acam = 40;
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
														if($o['studentcount'] != 0 AND $o['studentcount'] > 30)
														{
															echo (int) ($o['studentcount']/30);
														}
												 	?>
												 </td>
												</tr>
												<?php
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
													if($o['studentcount'] != 0 AND $o['studentcount'] > 30)
													{
														echo (int) ($o['studentcount']/30);
													}
												 ?>
												 </td>
											</tr>
											<?php
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

