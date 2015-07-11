<?php

	$for_c = 0
 ?>
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

							<?php if ($this->assesment->getBi($student) > 0):  ?>
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
																	<th class="tblNum">Amount</th>
															</tr>
															<?php foreach ($this->assesment->getAllPayments($enrolid) as $key => $value):
																	extract($value);
																?>
																	<tr>
																		<td>
																			<?php echo $description ?>
																		</td>
																	<td style="text-align:right">
																		<?php echo $amount; ?>
																	</td>
																	</tr>
																	<tr>
																		<?php endforeach ?>
																		<td>
																			MISCELLANEOUS
																		</td>
																		<td style="text-align:right">
																			 <?php
																					echo $this->assesment->getMiscellaneouse($enrolid);
																			 ?>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			Previous Ballance
																		</td>
																		<td>
																				<?php
																				//	echo $student;
																					echo $this->assesment->balance($student);
																			  ?>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			Total Due
																		</td>
																		<td style="text-align:right">
																				<?php
																					$m  = $this->assesment->getDiscount($student);
																				//	echo "<br />";
																					echo	$this->assesment->getT($m, $enrolid) ;
																				//	echo "<br />";
																				//	echo $enrolid;
																				 ?>
																		</td>
																	</tr>
														</table>
													</div>

													<?php

													//Checking of the phase if it is enrolment or in prelims, midterm, semis, finals.
													$ph = $this->api->systemValue();
													$phT = $ph['phase'];
													if ($phT == 1):
														?>
																			<div class="col-md-12">
																				<table class="table table-bordered">
																						<label>INSTALLMENT</label>
																						<tr>
																							<th>FEES ENROLMENT</th>
																							<th class="tblNum">Amount</th>
																					</tr>
																					<?php foreach ($this->assesment->getAllPayments($enrolid) as $key => $value):
																							extract($value);
																						?>
																							<tr>
																								<?php if ($accounttype == 7 || $accounttype == 23): ?>
																										<td>
																											<?php echo $description ?>
																										</td>
																										<td style="text-align:right">
																											<?php echo $amount / 5; ?>
																										</td>
																								<?php elseif($accounttype != 22 && $accounttype != 24): ?>
																											<td>
																												<?php echo $description ?>
																											</td>
																											<td style="text-align:right">
																												<?php echo $amount; ?>
																											</td>
																								<?php endif; ?>
																							</tr>
																							<tr>
																								<?php endforeach ?>
																								<td>
																									MISCELLANEOUS
																								</td>
																								<td style="text-align:right">
																									<?php
																											echo $this->assesment->getMiscellaneouse($enrolid);
																									?>
																								</td>
																							</tr>
																							<tr>
																								<td>
																									Previous Ballance
																								</td>
																								<td style="text-align:right">
																										<?php
																											echo $student;
																											echo $this->assesment->balance($student);
																										?>
																								</td>
																							</tr>
																							<tr>
																								<td>
																									Total Due
																								</td>
																								<td style="text-align:right">
																									<?php
																											$total_dues = $this->assesment->getAmount($enrolid); + $this->assesment->balance($student);
																											echo number_format($total_dues,2, '.', ',');
																									 ?>
																								</td>
																							</tr>
																				</table>
																			</div>
												<?php else: ?>
																<div class="col-md-12">
																	<table class="table table-bordered">
																			<label>INSTALLMENT</label>
																			<tr>
																				<th>FEES
																				<?php
																					echo	$this->assesment->get_ph($phT);
																				 ?>
																				</th>
																				<th class="tblNum">Amount</th>
																		</tr>
																		<?php foreach ($this->assesment->getAllPayments($enrolid) as $key => $value):
																				extract($value);
																			?>
																				<tr>
																							<?php if ($accounttype == 7 || $accounttype == 23): ?>
																									<td>
																										<?php echo $description ?>
																									</td>
																									<td style="text-align:right">
																										<?php echo $amount / 5; ?>
																									</td>
																							<?php elseif($accounttype == 21 || $accounttype == 20 || $accounttype == 19 || $accounttype == 6): ?>

																							<?php else: ?>

																								<?php if ($accounttype == 22 || $accounttype == 24): ?>
																										<td>
																											<?php echo $description ?>
																										</td>
																										<td style="text-align:right">
																											<?php echo $amount / 4; ?>
																										</td>
																										<?php else: ?>
																											<td>
																												<?php echo $description ?>
																											</td>
																											<td style="text-align:right">
																												<?php echo $amount / 5; ?>
																											</td>
																								<?php endif; ?>
																							<?php endif; ?>

																							<?php endforeach ?>
																				</tr>

																				<tr>
																					<td>
																						Previous Ballance
																					</td>
																					<td style="text-align:right">
																							<?php
																								echo $this->assesment->balance($student);
																							?>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						Total Due
																					</td>
																					<td style="text-align:right">
																						<?php
																						$total_dues = $this->assesment->getAmountNetPre($enrolid) + $this->assesment->balance($student);
																						echo number_format($total_dues,2, '.', ',');
																						?>
																					</td>
																				</tr>
																	</table>
																</div>
													<?php endif; ?>
							<?php else: ?>
								<div class="col-md-12">
									<label>BACK ACCOUNT</label>
									<table class="table table-bordered">
												<tr>
													<th>Balance</th>
													<th class="tblNum">Amount</th>
											</tr>
											<tr>
												<td>
													Previous Balance
												</td>
												<td>
													<?php
															echo $this->assesment->balance($student);
													 ?>
												</td>
											</tr>
												<tr>
													<th class="td-total tblNum">NET DUE</th>
													<th class="tblNum td-total" colspan="2"><?php echo number_format($this->assesment->balance($student), 2, '.', ',') ?></th>
											</tr>
											<tr>
												<td>
													Amount Override
												</td>
												<td>
													<?php
														echo	$this->assesment->get_override($student, $enrolid);
													?>
												</td>

											</tr>
									</table>
								</div>
								<?php
									$for_c = 1;
								 ?>
							<?php endif; ?>





							<?php if ($for_c == 0): ?>
								<div class="col-md-12">
									<a class="pull-right btn btn-primary" href="/billing/view_studentbilling/installment/<?php echo $legacyid; ?>" style="margin-left:5px;">Installment</a>
									<a class="pull-right btn btn-primary" href="/billing/view_studentbilling/fullpayment/<?php echo $legacyid; ?>" style="margin-left:5px;">Fullpayment</a>
									<br /><br />	<br />	<br />
								</div>
							<?php endif; ?>

</div>
					</div>
			</div>
