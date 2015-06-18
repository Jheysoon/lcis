<?php 

				$info = $this->assesment->getstudinfo($legacyid);
				extract($info);
				$acadinfo = $this->assesment->getAcadinfo($id);
				extract($acadinfo);
				$getcoursemajor = $this->api->getCourseMajor($coursemajor);
				$getyear = $this->api->getYearLevel($student);
				$units = 0;
		
	
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
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $legacyid ?>">							
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT NAME</label>
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $firstname . ' ' . $middlename . '. ' . $lastname?>">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $sy; ?>">							
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
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $semester; ?>">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">COURSE</label>
				<input class="form-control" maxlength="10" type="text" name="sid" required value="<?php echo $getcoursemajor; ?>">							
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
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $yearlevel; ?>">							
			<br />
			</div>

		</div>
		<?php 
			$inf = $this->assesment->getTuition($enrolid);
		 	$tui = $this->assesment->getTotal($enrolid);
		 ?>
	

		<div class="panel-body">
			<div class="col-md-12">
		<div class="table-responsive">
		<?php if ($type == 'installment'): ?>
				<?php 
				$phase = $this->api->systemValue();
				if ($phase['phase'] == 1): ?>
						<label>Installment</label>
						<table class="table table-bordered">
							<tr>
								<th>Enrolment</th>
								<th class="tblNum">Rate</th>
								<th>Total</th>
							</tr>
							<tr>
								<td>MISCELLANEOUS FEE</td>
								<td class="tblNum"></td>
								<td class="tblNum"><?php echo $tui['miscellaneous']; ?></td>
							</tr>
							<tr>
						<td>Matriculation</td>
						<td class="tblNum"><?php 
							$getRate = $this->assesment->getR($coursemajor, 6);
							echo $getRate['rate'];
						 ?></td>
						<td class="tblNum"><?php echo $tui['matriculation'] ?></td>
					</tr>
							<tr>
								<td>1/5 TUITION</td>
								<td class="tblNum"></td>
								<td class="tblNum"><?php echo $tui['tuition']/5; ?></td>
							</tr>
							<?php if ($tui['computer'] > 0): ?>
								<tr>
									<td>1/5 COMPUTER</td>
								<td class="tblNum"></td>
									<td class="tblNum"><?php echo $tui['computer']/5; ?></td>
								</tr>
							<?php endif ?>
						<!-- 	<?php if ($tui['internet'] > 0): ?>
									<tr>
										<td>1/4 INTERNET</td>
										<td class="tblNum"><?php echo $tui['internet']/4; ?></td>
									</tr>
							<?php endif ?> -->
					<!-- 	<?php if ($tui['booklet'] > 0): ?>
							<tr>
								<td>BOOKLET FEE</td>
								<td class="tblNum"><?php echo $tui['booklet']/5; ?></td>
							</tr>
						<?php endif ?> -->
						<?php if ($tui['laboratory'] > 0): ?>
							<tr>
								<td>LABORATORY FEE</td>
								<td class="tblNum"></td>
								<td class="tblNum"><?php echo $tui['laboratory']; ?></td>
							</tr>
						<?php endif ?>
						<tr>
							<td>LEYTE TIMES</td>
								<td class="tblNum"></td>
							<td class="tblNum"><?php echo $tui['leytetime']; ?></td>
						</tr>
						<?php if ($tui['nstp'] > 0): ?>
							<tr>
								<td>NSTP</td>
								<td class="tblNum"></td>
								<td class="tblNum"><?php echo $tui['nstp']; ?></td>
							</tr>
						<?php endif ?>
							<tr>
								<td>LESS SCHOLARSHIP DISCOUNT</td>

								<td class="tblNum"></td>
								<td class="tblNum">(0.00)</td>
							</tr>
							<tr>
								<td>ADD PREVIOUS BALANCE</td>
								<td class="tblNum"></td>
								<td class="tblNum">0</td>
							</tr>

							<tr>
								<th class="td-total tblNum">NET DUE ON ENROLMENT</th>
								<th class="tblNum td-total" colspan="2"><?php echo number_format($tui['netenrolment'], 2, '.', ',') ?></th>
							</tr>
					 		<tr>
								<td class="td-total tblNum">OVERRIDE AMOUNT DUE THIS EXAM: </td>
								<td colspan="2"><strong><input class="form-control input-enrol" type="numeric" name="payment" placeholder="enter amount" value="1,000.00"></strong></td>
							</tr>  
							</table>
				<?php else: ?>
						<label>Installment</label>
						<table class="table table-bordered">
							<tr>
								<th><?php 
								$x = $this->assesment->getPhase($phase['phase']);
								echo $x['description'];
								 ?></th>
								<th class="tblNum"></th>
							</tr>
							<tr>
								<td>1/5 TUITION</td>
								<td class="tblNum"><?php echo $tui['tuition']/5; ?></td>
							</tr>
							<?php if ($tui['computer'] > 0): ?>
								<tr>
									<td>1/5 COMPUTER</td>
									<td class="tblNum"><?php echo $tui['computer']/5; ?></td>
								</tr>
							<?php endif ?>
							<?php if ($tui['internet'] > 0): ?>
									<tr>
										<td>1/4 INTERNET</td>
										<td class="tblNum"><?php echo $tui['internet']/4; ?></td>
									</tr>
							<?php endif ?>
						<?php if ($tui['booklet'] > 0): ?>
							<tr>
								<td>BOOKLET FEE</td>
								<td class="tblNum"><?php echo $tui['booklet']/5; ?></td>
							</tr>
						<?php endif ?>
							<tr>
								<td>LESS SCHOLARSHIP DISCOUNT</td>
								<td class="tblNum">(0.00)</td>
							</tr>
							<tr>
								<td>ADD PREVIOUS BALANCE</td>
								<td class="tblNum">0</td>
							</tr>

							<tr>
								<th class="td-total tblNum">NET DUE ON ENROLMENT</th>
								<th class="tblNum td-total"><?php echo $tui['netprelim']; ?></th>
							</tr>
					 		<tr>
								<td class="td-total tblNum">OVERRIDE AMOUNT DUE THIS EXAM: </td>
								<td><strong><input class="form-control input-enrol" type="numeric" name="payment" placeholder="enter amount" value="0"></strong></td>
							</tr>  
							</table>

				<?php endif ?>
			
			<?php else: ?>
					<table class="table table-bordered">
					<label>Full Payment</label>
					 	<tr>
						<th>FEES</th>
						<th class="tblNum">RATE</th>
						<th class="tblNum">Units</th>
						<th class="tblNum">Amount</th>
					</tr>
					<tr>
						<td>Tuition</td>
						<td class="tblNum">
						<?php 
							$getRate = $this->assesment->getR($coursemajor, 7);
							echo $getRate['rate']; 
						?></td>
						<td class="tblNum"><?php echo $units ?></td>
						<td class="tblNum"><?php echo $tui['tuition']; ?></td>
					</tr>
					
					<tr>
						<td>Matriculation</td>
						<td class="tblNum"><?php 
							$getRate = $this->assesment->getR($coursemajor, 6);
							echo $getRate['rate'];
						 ?></td>
						<td class="tblNum">32</td>
						<td class="tblNum"><?php echo $tui['matriculation'] ?></td>
					</tr>
					<tr>
						<td>MISCELLANEOUS FEE</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum"><?php echo $tui['miscellaneous']; ?></td>
					</tr>
					<?php if ($tui['laboratory'] > 0): ?>
						<tr>
							<td>LABORATORY FEE</td>
							<td class="tblNum"></td>
							<td class="tblNum"></td>
							<td class="tblNum"><?php echo $tui['laboratory']; ?></td>
						</tr>
					<?php endif ?>
					
					<tr>
						<td>LEYTE TIMES</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum"><?php echo $tui['leytetime']; ?></td>
					</tr>
					<?php if ($tui['nstp'] > 0): ?>
						<tr>
							<td>NSTP</td>
							<td class="tblNum"></td>
							<td class="tblNum"></td>
							<td class="tblNum"><?php echo $tui['nstp']; ?></td>
						</tr>
					<?php endif ?>
					<?php if ($tui['internet']): ?>
						<tr>
							<td>INTERNET</td>
							<td class="tblNum"></td>
							<td class="tblNum"></td>
							<td class="tblNum"><?php echo $tui['internet']; ?></td>
						</tr>
					<?php endif ?>
					<?php if ($tui['computer'] > 0): ?>
						<tr>
							<td>COMPUTER</td>
							<td class="tblNum"></td>
							<td class="tblNum"></td>
							<td class="tblNum"><?php echo $tui['computer']; ?></td>
						</tr>
					<?php endif ?>
					<?php if ($tui['booklet'] > 0): ?>
						<tr>
							<td>BOOKLET</td>
							<td class="tblNum">2.5</td>
							<td class="tblNum">4</td>
							<td class="tblNum"><?php echo $tui['booklet']; ?></td>
						</tr>
					<?php endif ?>
					<tr>
							<td>LESS 10% Discount</td>
							<td class="tblNum"></td>
							<td class="tblNum"></td>
							<td class="tblNum"><?php echo "(" .$tui['fullpaydiscount'] .")"; ?></td>
						</tr>
					
					<tr>
						<th class="tblNum" colspan="3">GROSS TOTAL THIS SEMESTER</th>
						<th class="tblNum"><input type="text" name="netfull" value="<?phps
						 echo number_format($tui['netfullpayment'], 2, '.', ',')
						  ?>"></th>
					</tr>

				</table>
				<div class="col-md-6 ">
				<label class="lbl-data">STUDENT NAME</label>
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="<?php echo $firstname . ' ' . $middlename . '. ' . $lastname?>">							
			</div>

		<?php endif ?>
			</div>
		</div>
	</div>
</div>