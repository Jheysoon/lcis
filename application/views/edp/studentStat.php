	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<h4>Student Statistics</h4>
				</div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal add-user" method="post" action="/edp/studentcount" role="form">
					<div class="form-group">
						<div class="col-sm-12">
						<?php 
							set_time_limit(22222222222);
							ini_set('memory_limit', '-1');
							$current_academicterm = 40;
							$t = $this->academicterm->findById($current_academicterm);
							$term = $t['term'];

							// not applicable for summer
							if($term != 2)
							{
						 ?>
						<table class="table">
							<tr>
								<td>Course</td>
								<td>Year Level</td>
								<td>Effective Year</td>
								<td>Number of Student</td>
							</tr>
						
							<?php 
								$coursemajor = $this->course->getAllCourse();
								foreach($coursemajor as $c)
								{
									$cid = $c['id'];
									$course = $this->course->getCourse($cid);
									if($c['major'] == 0)
									{
										$major = '';
									}
									else
									{
										$major = '('.$this->course->getMajor($c['major']).')';
									}

									//@todo this loop is for the latest curriculum
									$c_count = 0;
									for($i = $current_academicterm;$i > 0;$i--)
									{
										$cur = $this->curriculum->getCur($i,$c['id']);
										if($cur != 'repeat')
										{
											break;
										}
										$c_count++;
									}
									$c_count = (int) ($c_count / 3);
									echo $c_count.' ';
									// another loop
									if($cur != 'repeat')
									{
										$cc = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum=$cur GROUP BY yearlevel")->result_array();
										foreach($cc as $cc1)
										{
											$year_l = $cc1['yearlevel'];
											?>
										<tr>
											<td><?php echo $course.' '.$major; ?></td>
											<td><?php echo $year_l; ?></td>
											<td></td>
											<td>
												<?php 
													if($year_l != 1)
													{
														echo $this->db->query("SELECT * FROM tbl_enrolment WHERE yearlevel = $year_l AND coursemajor = $cid AND academicterm = $current_academicterm GROUP BY student")->num_rows();
													}
													elseif($term == 3)
													{
														$c_acam = $current_academicterm - 2;
														echo $this->db->query("SELECT * FROM tbl_enrolment WHERE yearlevel = 1 AND coursemajor = $cid AND academicterm = $c_acam GROUP BY student")->num_rows();
													}
													else
													{
														$c_acam = $current_academicterm;
														echo $this->db->query("SELECT * FROM tbl_enrolment WHERE yearlevel = 1 AND coursemajor = $cid AND academicterm = $c_acam GROUP BY student")->num_rows();
													}
												?>
											</td>
										</tr>
										<?php
										}
									}
								}
							}
							else
							{
								?>
								<div class="alert alert-danger">
									Not applicable for summer term
								</div>
						<?php
							}
						 ?>
						</table>
						</div>
		            </div>
		            <!-- <div class="form-group">
		                <div class="col-sm-offset-1 col-sm-6"> -->
		                  <button type="submit" class="btn btn-success pull-right">Save</button>
		              	<!-- </div>
		            </div> -->

				</form>
			</div>
		</div>
	</div>

