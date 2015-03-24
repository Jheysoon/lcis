	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit CHED Scholarship Table</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">CHED Scholar Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Student Id<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="2011-00121">

							<label class="label-control add-label" for="sid">Name of Student<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="MILAGROS APACIBLE">
							
							<label class="label-control add-label" for="course">Course <small class="required"></small></label>
							<select class="form-control" readonly name='course' required>
							
								<option> BACHELOR OF SECONDARY EDUCATION</option>	
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
								<option> BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</option>
								<OPTION> BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION</OPTION>
								<OPTION> BACHELOR OF LAWS (Ll.B.)</OPTION>

							</select>	
						
							<label class="label-control add-label" for="course">Year Level <small class="required"></small></label>
							<select class="form-control" readonly name='course' required>
					
								<option> SECOND YEAR</option>
								<option> FIRST YEAR</option>
								<option> THIRD YEAR</option>
								<option> FOURTH YEAR</option>
							</select>	
							
							<label class="label-control add-label" for="course">School Year <small class="required"></small></label>
							<select class="form-control" readonly name='course' required>
								<option> SY 2013-2014</option>
								<option> SY 2014-2015</option>					
								<option> SY 2011-2012</option>
								<option> SY 2012-2013</option>


							</select>	

							<label class="label-control add-label" for="course">Term <small class="required"></small></label>
							<select class="form-control" readonly  name='course' required>
								<option> SECOND SEMESTER</option>
								<option> FIRST SEMESTER</option>					

								
							</select>	
									
							<label class="label-control add-label2" for="lastname">Units <small class="required"></small></label>
							<input class="form-control" type="text" readonly name="firstname" placeholder="firstname" required value="31">
							
							<label class="label-control add-label2" for="lastname">General Weighted Average <small class="required"></small></label>
							<input class="form-control" type="text" readonly name="firstname" placeholder="firstname" required value="1.1">
							
							<label class="label-control add-label" for="course">Program <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> FULL MERIT</option>					
								<option> TULONG DUNONG</option>
								
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