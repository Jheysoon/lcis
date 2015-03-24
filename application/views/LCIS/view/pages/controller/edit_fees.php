	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit School Fees</h4>
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Fees">
			        </div>
			        <button type="submit" class="btn btn-warning">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
				     </form>
				</div>

			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Fees Information</h3><hr><br>



					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="course">Fee Type <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> LIBRARY</option>
								<option> ATHLETICS</option>
								<option> DENTAL AND MEDICAL</option>
								<option> TEST SUPPLIES</option>
								<option> GUIDANCE AND COUNSELING</option>
								<option> BSP/GSP</option>
								<option> RED CROSS</option>
								<option> PRISAA</option>
								<option> RESEARCH FUND</option>
								<option> COMMUNITY EXTENSION SERVICE FUND</option>
								<option> LABORATORY</option>
							</select>	


							<label class="label-control add-label" for="sid">Criminology Fee<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="150.00">

							<label class="label-control add-label" for="course">Criminology Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>631 - LIBRARY FEE - COLLEGE OF CRIMINOLOGY</option>
								<option>631 - LIBRARY FEE - COLLEGE OF LAW</option>
								<option>631 - LIBRARY FEE - COLLEGE OF EDUCATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF ARTS AND SCIENCE</option>
								<option>631 - LIBRARY FEE - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Law Fee<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="300.00">

							<label class="label-control add-label" for="course">Law Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>631 - LIBRARY FEE - COLLEGE OF LAW</option>
								<option>631 - LIBRARY FEE - COLLEGE OF CRIMINOLOGY</option>
								<option>631 - LIBRARY FEE - COLLEGE OF EDUCATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF ARTS AND SCIENCE</option>
								<option>631 - LIBRARY FEE - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Education Fee<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="150.00">

							<label class="label-control add-label" for="course">Education Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>631 - LIBRARY FEE - COLLEGE OF EDUCATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF CRIMINOLOGY</option>
								<option>631 - LIBRARY FEE - COLLEGE OF LAW</option>
								<option>631 - LIBRARY FEE - COLLEGE OF ARTS AND SCIENCE</option>
								<option>631 - LIBRARY FEE - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Arts & Sciences Fee<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="150.00">

							<label class="label-control add-label" for="course">Arts & Sciences Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>631 - LIBRARY FEE - COLLEGE OF ARTS AND SCIENCE</option>
								<option>631 - LIBRARY FEE - COLLEGE OF CRIMINOLOGY</option>
								<option>631 - LIBRARY FEE - COLLEGE OF LAW</option>
								<option>631 - LIBRARY FEE - COLLEGE OF EDUCATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	
		
							<label class="label-control add-label" for="sid">Business Administration Fee<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="150.00">

							<label class="label-control add-label" for="course">Business Administration Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>631 - LIBRARY FEE - COLLEGE OF BUSINESS ADMINISTRATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF CRIMINOLOGY</option>
								<option>631 - LIBRARY FEE - COLLEGE OF LAW</option>
								<option>631 - LIBRARY FEE - COLLEGE OF EDUCATION</option>
								<option>631 - LIBRARY FEE - COLLEGE OF ARTS AND SCIENCE</option>
							</select>	
		
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