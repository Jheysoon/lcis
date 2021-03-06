<?php

				$info = $this->assesment->getstudinfo($legacyid);
				extract($info);
				$acadinfo = $this->assesment->getAcadinfo($id);
				extract($acadinfo);
				$getcoursemajor = $this->api->getCourseMajor($coursemajor);
				$getyear = $this->api->getYearLevel($student);
				//$units = 0;


 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-12">
				<h4>STUDENT'S BILLING INFORMATION</h4>
			</div>
		</div>
		<div class="panel-body">
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
		</div>
		<?php
			$inf = $this->assesment->getTuition($enrolid);
		 	$tui = $this->assesment->getTotal($enrolid);
		 	$get_units = $this->assesment->get_unit($enrolid);
		 	$units = $get_units;
		;
		 ?>


		<div class="panel-body">
			<div class="col-md-12">
		<div class="table-responsive">
			<?php
				echo $this->session->flashdata('message');
			 ?>
			<?php
				 $checkInpayment = $this->assesment->checkP($enrolid);
				 if ($checkInpayment <= 0) {
				 	$fullpay = 1;
			 }else{
				$fullpay = $this->assesment->getThisBal($student);
				$check_enrolled = $this->assesment->get_enrolled($enrolid);
			}
 			?>
 <?php if ($fullpay != 0 OR $check_enrolled > 0): ?>
		<?php if ($type == 'installment'): ?>
			<?php
			
						$co = $this->assesment->checkExisting($enrolid);
						if ($co > 0): ?>

		<?php
		$phase = $this->api->systemValue();
		if ($phase['phase'] == 1): ?>
	<?php
		$ph = $this->api->systemValue();
		$phT = $ph['phase'];
	?>
				<form action="/billing/posting" method="POST">
					<div class="col-md-12">
						<table class="table table-bordered">
								<label>Full Payment</label>
								<tr>
									<th>FEES</th>
									<th class="tblNum">Amount</th>
							</tr>
							<tr>
								<td>
									Amound Due
								</td>
								<td style="text-align:right">
										<?php
										
											$m  = $this->assesment->getDiscount($student);
											echo $this->assesment->getT($m, $enrolid) ;
										?>
								</td>
							</tr>
							<tr>
										<td>
											Previous Ballance
										</td>
										<td style="text-align:right">
												<?php
														echo $this->assesment->balanceenrolment($student);
												?>
										</td>
									</tr>
							<tr>
										<td>
												Amount Paid
										</td>
										<td style="text-align:right">
													<?php
															echo '	('.$this->assesment->getAmountPaid($student, $enrolid).')';
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
									echo	$fullpay = $this->assesment->getT($m, $enrolid) + $this->assesment->balanceenrolment($student) - $this->assesment->getAmountPaid($student, $enrolid);
									?>
								</td>
						</tr>
						</table>
					</div>
									<div class="col-md-12">
										<table class="table table-bordered">
												<label>INSTALLMENT</label>
												<tr>
													<th>ENROLMENT</th>
													<th class="tblNum">Amount</th>
											</tr>
													<tr>
														<td>
															Previous Ballance
														</td>
														<td style="text-align:right">
																<?php
																	echo $this->assesment->balanceenrolment($student);
																?>
														</td>
													</tr>
													<tr>
														<td>
															Amound Due
														</td>
														<td style="text-align:right">
																<?php
																		echo $this->assesment->getAmount($enrolid);
																 ?>
														</td>
													</tr>
														<tr>
															<td>
																	Amount Paid
															</td>
															<td style="text-align:right">
																		<?php
																				echo '	('.$this->assesment->getAmountPaid($student, $enrolid) .')';
																		 ?>
															</td>
														</tr>
														<tr>
															<td>
																Amount Override
															</td>
															<td style="text-align:right">
																
																	<?php
																		echo $over = $this->assesment->get_override($student, $enrolid);
																 	?>
															
															</td>
														</tr>
														<tr>
														<td>
															Total Due
														</td>
														<td style="text-align:right">
															<?php
																	$minusenrolment = $this->assesment->getifExistpayment($enrolid);
																	$total_dues = $this->assesment->getAmount($enrolid) + $this->assesment->balanceenrolment($student) - $this->assesment->getAmountPaid($student, $enrolid);
																	$ts = $total_dues;
																	echo number_format($total_dues,2, '.', ',');
															?>
														</td>
													</tr>

										</table>
									</div>
									<div class="col-md-3 pull-right">
												<input type="text" class="col-md-4 form-control"  placeholder="Enter Amount" style="text-align:right;font-size:20px" name="amount_paid" required autocomplete="off">
									</div>
									<div class="col-md-3 pull-right">
												<input type="text" class="col-md-4 form-control"  placeholder="Enter OR No." style="text-align:right;font-size:20px" name="or_no" required>
									</div>
									<input type="hidden" name="fullpay" value="<?php echo $fullpay; ?>">
									<input type="hidden" name="type" value="<?php echo $type ?>">
									<input type="hidden" name="enrolid" value="<?php echo $enrolid ?>">
									<input type="hidden" name="total_due" value="<?php echo $ts ?>">
									<input type="hidden" name="override" value="<?php echo $over ?>">
									<input type="hidden" name="legacyid" value="<?php echo $legacyid ?>">
									<div class="col-md-12">
											<br />
										<a class="pull-right btn btn-primary" href="#" style="margin-left:5px;">Cancel</a>
											<input type="submit" class="pull-right btn btn-primary" href="#" style="margin-left:5px;" value="Save">
								</div>
						</form>
					<a href="/billing/endphase">End of Phase</a>
						<?php else: ?>
							<form action="/billing/posting" method="POST">
									<div class="col-md-12">
										<table class="table table-bordered">
											<?php
											$ph = $this->api->systemValue();
											$phT = $ph['phase'];
											 ?>
												<label>INSTALLMENT</label>
												<tr>
													<th>
													<?php
														echo	$this->assesment->get_ph($phT);
													?>
													</th>
													<th class="tblNum">Amount</th>
											</tr>

													<tr>
														<td>
															Previous Ballance
														</td>
														<td style="text-align:right">
																<?php

																		$bal = $this->assesment->balance($student) - $this->assesment->getAmountNetPre($enrolid);
																		if ($bal >= 0) {
																			echo $bal;
																		}else{
																			echo $bal = 0;
																		}
																?>
														</td>
													</tr>
													<tr>
														<td >
															Amount Due
														</td>
														<td style="text-align:right">
															<?php
																	echo $this->assesment->getAmountNetPre($enrolid);
															 ?>
														</td>
													</tr>
													<tr>
														<tr>
															<td>
																	Amount Paid
															</td>
															<td style="text-align:right">
																		<?php
																				echo '	('.$this->assesment->getAmountPaid($student, $enrolid) .')';
																		 ?>
															</td>
														</tr>
														<tr>
															<td>
																Amount Override
															</td>
															<td style="text-align:right">
															<?php 
															
																	echo $over = $this->assesment->get_override($student, $enrolid);
																 ?>
															
															</td>
														</tr>
														<td>
															Total Due
														</td>
														<td style="text-align:right">
															<?php
																	$total_dues = $this->assesment->balance($student);// - $this->assesment->getAmountPaid($student, $enrolid);//$this->assesment->getAmountNetPre($enrolid) + $bal - $this->assesment->getAmountPaid($student, $enrolid);
																	$ts = $total_dues;
																	echo number_format($total_dues,2, '.', ',');
															?>
														</td>
													</tr>
											</table>
											</div>
											<div class="col-md-3 pull-right">
														<input type="text" class="col-md-4 form-control"  placeholder="Enter Amount" style="text-align:right;font-size:20px" name="amount_paid" required autocomplete="off">
											</div>
											<div class="col-md-3 pull-right">
														<input type="text" class="col-md-4 form-control"  placeholder="Enter OR No." style="text-align:right;font-size:20px" name="or_no" required>
											</div>
											<input type="hidden" name="type" value="<?php echo $type ?>">
											<input type="hidden" name="enrolid" value="<?php echo $enrolid ?>">
											<input type="hidden" name="total_due" value="<?php echo $ts ?>">
											<input type="hidden" name="override" value="<?php echo $over ?>">
											<input type="hidden" name="legacyid" value="<?php echo $legacyid ?>">
											<div class="col-md-12">
													<br />
												<a class="pull-right btn btn-primary" href="#" style="margin-left:5px;">Cancel</a>
													<input type="submit" class="pull-right btn btn-primary" href="#" style="margin-left:5px;" value="Save">
										</div>
										<a href="/billing/endphase">End of Phase</a>
									</form>
								<?php endif ?>
									<?php else: ?>
										<form action="/billing/posting" method="POST">
												<div class="col-md-12">
													<table class="table table-bordered">
														<?php
														$ph = $this->api->systemValue();
														$phT = $ph['phase'];
														 ?>
															<tr>
																<th>
																	Back Accounts
																</th>
																<th class="tblNum">Amount</th>
														</tr>

																<tr>
																	<td>
																		Previous Ballance
																	</td>
																	<td style="text-align:right">
																			<?php

																					$bal = $this->assesment->balance($student) - $this->assesment->getAmountNetPre($enrolid);
																					if ($bal >= 0) {
																						echo $bal;
																					}else{
																						echo $bal = 0;
																					}
																			?>
																	</td>
																</tr>
																<tr>
																	<td >
																		Amount Due
																	</td>
																	<td style="text-align:right">
																		<?php
																				echo $this->assesment->getAmountNetPre($enrolid);
																		 ?>
																	</td>
																</tr>
																<tr>
																	<tr>
																		<td>
																				Amount Paid
																		</td>
																		<td style="text-align:right">
																					<?php
																							echo '	('.$this->assesment->getAmountPaid($student, $enrolid) .')';
																					 ?>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			Amount Override
																		</td>
																		<td style="text-align:right">
																		
																				<?php
																					echo $over = $this->assesment->get_override($student, $enrolid);
																			 	?>
																			
																		</td>
																	</tr>
																	<td>
																		Total Due
																	</td>
																	<td style="text-align:right">
																		<?php
																				$total_dues = $this->assesment->balance($student);// - $this->assesment->getAmountPaid($student, $enrolid);//$this->assesment->getAmountNetPre($enrolid) + $bal - $this->assesment->getAmountPaid($student, $enrolid);
																				$ts = $total_dues;
																				echo number_format($total_dues,2, '.', ',');
																		?>
																	</td>
																</tr>
													</table>
												</div>
												<div class="col-md-3 pull-right">
															<input type="text" class="col-md-4 form-control"  placeholder="Enter OR No." style="text-align:right;font-size:20px" name="or_no" required>
															<br /><br />
															<input type="text" class="col-md-4 form-control"  placeholder="Enter Amount" style="text-align:right;font-size:20px" name="amount_paid" required autocomplete="off">
		 														
												</div>
												<!-- <div class="col-md-3 pull-right">
															<input type="text" class="col-md-4 form-control"  placeholder="Enter Amount" style="text-align:right;font-size:20px" name="amount_paid" required autocomplete="off">
												</div>
												<div class="col-md-3 pull-right">
															<input type="text" class="col-md-4 form-control"  placeholder="Enter OR No." style="text-align:right;font-size:20px" name="or_no" required>
												</div> -->
												<input type="hidden" name="type" value="<?php echo $type ?>">
												<input type="hidden" name="enrolid" value="<?php echo $enrolid ?>">
												<input type="hidden" name="total_due" value="<?php echo $ts ?>">
												<input type="hidden" name="override" value="<?php echo $over ?>">
												<input type="hidden" name="legacyid" value="<?php echo $legacyid ?>">
												<div class="col-md-12">
														<br />
													<a class="pull-right btn btn-primary" href="#" style="margin-left:5px;">Cancel</a>
														<input type="submit" class="pull-right btn btn-primary" href="#" style="margin-left:5px;" value="Save">
											</div>
											<a href="/billing/endphase">End of Phase</a>
										</form>

											<?php endif ?>
											<?php endif ?>
				<?php else: ?>
					<a href="/billing/endphase">End of Phase</a>
						<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>All Back Accunts Paid</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
