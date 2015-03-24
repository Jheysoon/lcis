<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">
				<h4>PAYMENT: ENROLMENT</h4>
			</div>
			<div class="col-md-6">
			<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Student Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
			</form>
			</div>
		</div>

		<div class="panel-body">
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT ID</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="2014-01268">							
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT NAME</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="MICHAEL R. LAUDICO">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="2014 - 2015">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">TERM</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="FIRST SEMESTER">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">COURSE</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="BACHELOR OF SCIENCE IN CRIMINOLOGY">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">YEAR LEVEL</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="FIRST YEAR">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">PAYMENT OPTION</label>
				<select class="form-control" name='payment' required>
								<option>INSTALLMENT</option>
								<option>FULL PAYMENT</option>
				</select>	
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">DATE</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="05.26.2014">							
			</div>
		</div>
		
		<div class="panel-body">
		<div class="col-md-12">
		<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th>INSTALLMENT OPTION: ENROLMENT DUES BREAKDOWN</th>
						<th class="tblNum"></th>
					</tr>
					<tr>
						<td>1/5 TUITION</td>
						<td class="tblNum">1,930.24</td>
					</tr>
					<tr>
						<td>MATRICULATION</td>
						<td class="tblNum">176.90</td>
					</tr>
					<tr>
						<td>OTHER FEES</td>
						<td class="tblNum">1,607.85</td>
					</tr>

					<tr>
						<td>LESS SCHOLARSHIP DISCOUNT</td>
						<td class="tblNum">(0.00)</td>
					</tr>
					<tr>
						<td>ADD PREVIOUS BALANCE</td>
						<td class="tblNum">0.00</td>
					</tr>
					<tr>
						<th class="td-total tblNum">NET DUE ON ENROLMENT</th>
						<th class="tblNum td-total">3,714.99</th>
					</tr>
					<tr>
						<td class="input-enrol">AUDIT OVERRIDE </td>
						<td class="tblNum input-enrol">NONE</td>
					</tr>
					<tr>
						<td class="input-enrol">OFFICIAL RECEIPT NUMBER </td>
						<td><strong><input class="form-control input-enrol" type="numeric" name="payment" placeholder="enter amount" value="                                              01456"></strong>
					</tr>

					<tr>
						<td class="input-enrol">AMOUNT RECEIVED </td>
					<td><strong><input class="form-control input-enrol" type="numeric" name="payment" placeholder="enter amount" value="                                              2,000.00"></strong></td>
					</tr>
					</table>
			</div>
			<button class="btn btn-success pull-right">Receive Payment</button>
			</div>


		</div>
	</div>
</div>