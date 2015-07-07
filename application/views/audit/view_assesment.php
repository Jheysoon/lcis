<div class="col-md-3"></div>
		<div class="col-md-9 body-container">
				<div class="panel p-body">
						<div class="panel-heading">
							<h4>Assesment</h4>
						</div>

						<div class="panel-body">
						<?php
								$info = $this->assesment->getstudinfo($legacyid);
								extract($info);
								$student  = $id;
								$acadinfo = $this->assesment->getAcadinfo($id);
								extract($acadinfo);
								$getcoursemajor = $this->api->getCourseMajor($coursemajor);
								$getyear = $this->api->getYearLevel($student);
								$units = 0;
						 ?>
							<div class="col-md-6 ">
								<label class="lbl-data">STUDENT ID</label>
								<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $legacyid ?>" disabled>
							</div>
							<div class="col-md-6 ">
								<label class="lbl-data">STUDENT NAME</label>
								<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $firstname . ' ' . $middlename . '. ' . $lastname?>" disabled>
							</div>

							<div class="col-md-6 ">
								<label class="lbl-data">SCHOOL YEAR</label>
								<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $sy; ?>" disabled>
							</div>

							<div class="col-md-6 ">
								<label class="lbl-data">TERM</label>
									<?php
										if ($sem == 1) {
											$semester = 'First Semester';
										}elseif ($sem == 2) {
											$semester = 'Second Semester';
										}else{
											$semester = 'Summer';
										}
									 ?>
								<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $semester; ?>" disabled>
							</div>

							<div class="col-md-6 ">
								<label class="lbl-data">COURSE</label>
								<input class="form-control" maxlength="10" type="text" name="sid" required value="<?php echo $getcoursemajor; ?>" disabled>
							</div>

							<div class="col-md-6 ">
								<label class="lbl-data">YEAR LEVEL</label>
								<?php
									if ($getyear == 1) {
										$yearlevel = 'First Year';
									}elseif ($getyear == 2) {
										$yearlevel = 'Second Year';
									}elseif ($getyear == 3) {
										$yearlevel = 'Third Year';
									}elseif ($getyear == 4) {
										$yearlevel = 'Fourth Year';
									}else{
										$yearlevel = 'Not Defined';
									}
								 ?>
								<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $yearlevel; ?>" disabled>
							<br />
							</div>
									<div class="col-md-12">
										<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
																<th>SUBJ CODE</th>
																<th colspan="2">DESCRIPTIVE TITLE</th>
																<th class="tblNum">UNITS</th>
													</tr>
													<?php foreach ($this->assesment->getSubInfo($enrolid) as $res): ?>
													 		<tr>
																<td><?php echo $res['code']; ?></td>
																<td colspan="2"><?php echo $res['descriptivetitle']; ?></td>
																<td class="tblNum">
																<?php

																echo $res['units'];
																$units += $res['units'];
																?></td>
															</tr>
													 <?php endforeach ?>
												</table>
											</div>
										</div>

										<div class="col-md-12">
											<table class="table table-bordered">
												<label>Full Payment</label>
												 	<tr>
													<th>FEES</th>
													<th class="tblNum">RATE</th>
													<th class="tblNum">Units</th>
													<th class="tblNum">Amount</th>
												</tr>
												<?php


												 ?>
											</table>
										</div>

							</div>
							<div class="col-md-12">
								<a class="pull-right btn btn-primary" href="/billing/view_studentbilling/installment/<?php echo $legacyid; ?>" style="margin-left:5px;">Installment</a>
								<a class="pull-right btn btn-primary" href="/billing/view_studentbilling/fullpayment/<?php echo $legacyid; ?>" style="margin-left:5px;">Fullpayment</a>
								<br /><br />	<br />	<br />
							</div>

					</div>
			</div>
	</div>
