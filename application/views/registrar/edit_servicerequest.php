	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Service Request</h4>
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
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Service Request Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Student Id<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="2010-00121">

							<label class="label-control add-label" for="sid">Name of Student<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="THELMA DE LA CRUZ">
							
							<label class="label-control add-label" for="sid">Course<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="BACHELOR IN SECONDARY EDUCATION">
							
							<label class="label-control add-label" for="sid">Year Level<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="FOURTH YEAR">

							<label class="label-control add-label2" for="course">Service Requested <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> TRANSCRIPT OF RECORDS</option>
								<option> DIPLOMA</option>
								<option> CERTIFICATION</option>
								<option> AUTHENTICATION</option>
								<option> SCANNING</option>
								<option> INC PROCESSING</option>
							</select>	

							<label class="label-control add-label" for="sid">Rate<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="75.00">

							<label class="label-control add-label" for="sid">Number of Copies<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="5">
							
							<label class="label-control add-label" for="sid">Total Amount<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="375.00">

							<label class="label-control add-label" for="sid">Date of Request<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="15.AUG.2014">

							<label class="label-control add-label" for="sid">Status<small class="required"></small></label>
							<select class="form-control" name='status' required>
								<option> OPEN</option>
								<option> PAID</option>
								<option> PROCESSING</option>
								<option> COMPLETED</option>
							</select>	

							<label class="label-control add-label" for="sid">Date Paid<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value=" ">
							<label class="label-control add-label" for="sid">Date Completed<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value=" ">
						</div>	
								
					</div>

					 <div class="form-group">
		                <div class="col-sm-8 col-sm-offset-1">
		                  <button type="submit" class="btn btn-primary">Save</button>
		                  <a href="index.php?page=addStudent" class="btn btn-default">Clear</a>
		                </div>
		             </div>
				</div>
					</form>
			</div>
		</div>
	</div>

</div>