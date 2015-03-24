<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">
				<h4>CASH OUT</h4>
			</div>
		</div>

		<div class="panel-body">
			<div class="col-md-6 ">
				<label class="lbl-data">CASHIER ID</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="000123456">							
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">CASHIER NAME</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="CASHIER">							
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">DATE</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="07.10.2014">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">TIME</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="12:00:00">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">CASH OUT TYPE</label>
				<select class="form-control" name='payment' required>
								<option>PAYMENT OF EXPENSE</option>
								<option>FOR DEPOSIT</option>
								<option>SAFE KEEP</option>
				</select>	
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">AMOUNT</label>
				<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-2015)" required value="10,000.00">							
			</div>

			</div>
			<div class="col-md-6 ">
			<button class="btn btn-success">Process Cash Out</button>
			</div>
		</div>
	</div>
</div>