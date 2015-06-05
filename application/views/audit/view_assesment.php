<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assesment</h4>
		</div>

		<div class="panel-body">
		<?php
			echo $legacyid;
		 
				$info = $this->assesment->getstudinfo($legacyid);
				extract($info);
				$acadinfo = $this->assesment->getAcadinfo($id);
				extract($acadinfo);
				$getcoursemajor = $this->api->getCourseMajor($coursemajor);
				$getyear = $this->api->getYearLevel($student);
		 ?>
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
		

		<div class="col-md-12">
		<div class="table-responsive">

				<table class="table table-bordered">
					<tr>
						<th>SUBJ CODE</th>
						<th colspan="2">DESCRIPTIVE TITLE</th>
						<th class="tblNum">UNITS</th>
						<!-- <th>FEES</th>
						<th class="tblNum">RATE</th>
						<th class="tblNum">Units</th>
						<th class="tblNum">Amount</th> -->
					</tr>
					<tr>
						<td><?php echo $enrolid; ?></td>
					</tr>
					<tr>
						<td>ENGL 01</td>
						<td colspan="2">ENRICHMENT ENGLISH</td>
						<td class="tblNum">3</td>
						<!--  -->
					</tr>
				</table>
				
			</div>
			</div>
			<div class="col-md-12">
			<label>Full Payment</label>
				<table class="table table-bordered">
						<tr>
						<th>FEES</th>
						<th class="tblNum">RATE</th>
						<th class="tblNum">Units</th>
						<th class="tblNum">Amount</th>
					</tr>
					<tr>
						<td>TUITION</td>
						<td class="tblNum">332.80</td>
						<td class="tblNum">32</td>
						<td class="tblNum">10,649.60</td>
					</tr>
					<tr>
						<td>MATRICULATION</td>
						<td class="tblNum">6.10</td>
						<td class="tblNum">32</td>
						<td class="tblNum">195.20</td>
					</tr>
					<tr>
						<td>MISCELLANEOUS FEE</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">600.00</td>
					</tr>
					<tr>
						<td>LABORATORY FEE</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">292.85</td>
					</tr>
					<tr>
						<td>LEYTE TIMES</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">75.00</td>
					</tr>
					<tr>
						<td>NSTP</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">500.00</td>
					</tr>
					<tr>
						<td>INTERNET</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">100.00</td>
					</tr>
					<tr>
						<td>COMPUTER</td>
						<td class="tblNum"></td>
						<td class="tblNum"></td>
						<td class="tblNum">700.00</td>
					</tr>
					<tr>
						<td>BOOKLET</td>
						<td class="tblNum">2.5</td>
						<td class="tblNum">4</td>
						<td class="tblNum">100</td>
					</tr>
					<tr>
						<th class="tblNum" colspan="3">GROSS TOTAL THIS SEMESTER</th>
						<th class="tblNum"><?php
						setlocale(LC_MONETARY, 'en_US');
						 echo number_format('11232195.95', 2, '.', ',');
						  ?></th>
					</tr>
				</table>
			</div>

			<div class="col-md-12">
		<div class="table-responsive">
			<label>Installment</label>
				<table class="table table-bordered">
					<tr>
						<th>EXAMINATION PAYMENT: PRELIMINARY DUES BREAKDOWN</th>
						<th class="tblNum"></th>
					</tr>
					<tr>
						<td>1/5 TUITION</td>
						<td class="tblNum">1,930.24</td>
					</tr>
					<tr>
						<td>1/5 COMPUTER</td>
						<td class="tblNum">140.00</td>
					</tr>
					<tr>
						<td>1/4 INTERNET</td>
						<td class="tblNum">25.00</td>
					</tr>
					<tr>
						<td>BOOKLET FEE</td>
						<td class="tblNum">25.00</td>
					</tr>

					<tr>
						<td>LESS SCHOLARSHIP DISCOUNT</td>
						<td class="tblNum">(0.00)</td>
					</tr>
					<tr>
						<td>ADD PREVIOUS BALANCE</td>
						<td class="tblNum">1,714.99</td>
					</tr>

					<tr>
						<th class="td-total tblNum">NET DUE ON ENROLMENT</th>
						<th class="tblNum td-total">3,835.23</th>
					</tr>

			 	<tr>
						<td class="td-total tblNum">OVERRIDE AMOUNT DUE THIS EXAM: </td>
						<td><strong><input class="form-control input-enrol" type="numeric" name="payment" placeholder="enter amount" value="1,000.00"></strong></td>
					</tr>
					</table>
			</div>
			</div>
			<div class="col-md-12">
				<a class="pull-right btn btn-primary" href="/billing/view_studentbilling" style="margin-left:5px;">Installment</a>
				<a class="pull-right btn btn-primary">Fullpayment</a>
				<br /><br />	<br />	<br />								
			</div>
			</div>
</div>
		</div>

		</div>
	</div>
</div>