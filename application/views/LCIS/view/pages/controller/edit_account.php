	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Account Information</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Account Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">
							<label class="label-control add-label" for="course">Account Root <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> 0000001 - LEYTE COLLEGES</option>
								<option> 0500001 - LAND BANK OF THE PHILIPPINES</option>
								<option> 0500001 - EAST WEST BANK- MARASBARAS BRANCH</option>
								<option> 0101121 - MICHAEL LAUDICO</option>
								<option> 0101214 - LAURA FABI</option>
								<option> 0101144 - JOSE MARCO REYES</option>
								<option> 0100184 - JAIME FRANCISCO</option>
							</select>	

							<label class="label-control add-label" for="course">Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> 020 - CASH ON HAND</option>
								<option> 040 - CASH IN BANK</option>
								<option> 101 - RECEIVABLES - ENROLMENT</option>
								<option> 102 - RECEIVABLES - SALARY LOANS</option>
								<option> MATRICULATION - COLLEGE OF CRIMINOLOGY</option>
								<option> TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option> FEES - LIBRARY</option>
								<option> FEES - ATHLETICS</option>
								<option> FEES - DENTAL</option>
								<option> OTHER FEES - TRANSCRIPT OF RECORDS</option>
							</select>		

							<label class="label-control add-label" for="sid">Account Sequence<small class="required">(required)</small></label>
							<input class="form-control" maxlength="3" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="000">

							<label class="label-control add-label" for="sid">Account Currency<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="001">

							<label class="label-control add-label" for="sid">Account Description<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="CASHIER WINDOW 1">

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