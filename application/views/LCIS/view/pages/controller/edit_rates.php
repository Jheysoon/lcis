	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Tuition and Matriculation Rates</h4>
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Rates">
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
					<br><h3 class="col-sm-offset-1">Rates Information</h3><hr><br>



					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="course">Fee Type <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> TUITION</option>
								<option> MATRICULATION</option>
							</select>	


							<label class="label-control add-label" for="sid">Criminology Rate per Unit<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="332.80">

							<label class="label-control add-label" for="course">Criminology Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>621 - TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option>622 - TUITION - COLLEGE OF LAW</option>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>624 - TUITION - COLLEGE OF ARTS AND SCIENCE</option>
								<option>625 - TUITION - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Law Rate per Unit<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="537.90">

							<label class="label-control add-label" for="course">Law Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>622 - TUITION - COLLEGE OF LAW</option>
								<option>621 - TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>624 - TUITION - COLLEGE OF ARTS AND SCIENCE</option>
								<option>625 - TUITION - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Education Rate per Unit<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="332.80">

							<label class="label-control add-label" for="course">Education Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>622 - TUITION - COLLEGE OF LAW</option>
								<option>621 - TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>624 - TUITION - COLLEGE OF ARTS AND SCIENCE</option>
								<option>625 - TUITION - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label" for="sid">Arts & Sciences Rate per Unit<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="332.80">

							<label class="label-control add-label" for="course">Arts & Sciences Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>624 - TUITION - COLLEGE OF ARTS AND SCIENCE</option>								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>622 - TUITION - COLLEGE OF LAW</option>
								<option>621 - TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>625 - TUITION - COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	
		
							<label class="label-control add-label" for="sid">Business Administration Rate per Unit<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="332.80">

							<label class="label-control add-label" for="course">Business Administration Account Category <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option>625 - TUITION - COLLEGE OF BUSINESS ADMINISTRATION</option>
								<option>624 - TUITION - COLLEGE OF ARTS AND SCIENCE</option>								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
								<option>622 - TUITION - COLLEGE OF LAW</option>
								<option>621 - TUITION - COLLEGE OF CRIMINOLOGY</option>
								<option>623 - TUITION - COLLEGE OF EDUCATION</option>
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