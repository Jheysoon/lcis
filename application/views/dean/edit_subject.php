	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Subject Table</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Subject Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Subject Code <small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="ENGL 01">
							
							<label class="label-control add-label2" for="lastname">Descriptive Title <small class="required">(optional)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="lastname" required value="ENGLISH ENRICHMENT">
						
							<label class="label-control add-label2" for="lastname">Short Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="ENGLISH ENRICHMENT">

							<label class="label-control add-label2" for="lastname">Units <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="3">

							<label class="label-control add-label2" for="lastname">Semester Offered <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="FIRST SEMESTER">

							<label class="label-control add-label2" for="lastname">Hours <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="100">

							<label class="label-control add-label2" for="lastname">Prerequisite <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="NONE">

							<label class="label-control add-label2" for="lastname">Minimum Number of Students to Open <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="15">
							
							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label2">Type <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="ac" value="yes" checked>
									    	ACADEMIC
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="ac" value="no">
									    	NON-ACADEMIC
									  	</label>
									</div>
							</fieldset>
							</div>

							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label2">Class <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="cl" value="yes" checked>
									    	GENERAL EDUCATION
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="cl" value="no">
									    	NON-GENERAL EDUCATION
									  	</label>
									</div>
							</fieldset>
							</div>

							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label2">Weight <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="wg" value="yes" checked>
									    	MINOR
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="wg" value="no">
									    	MAJOR
									  	</label>
									</div>
							</fieldset>
							</div>

							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label2">Institutional Subject? <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="in" value="yes" checked>
									    	INSTITUTIONAL
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="in" value="no">
									    	REGULAR
									  	</label>
									</div>
							</fieldset>
							</div>
							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label">Computer Subject <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="is" value="yes" checked>
									    	YES
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="is" value="no">
									    	NO
									  	</label>
									</div>
							</fieldset>
							</div>
							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label2">Examination Booklet Required? <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="ex" value="yes" checked>
									    	YES
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="ex" value="no">
									    	NO
									  	</label>
									</div>
							</fieldset>
							</div>

							<label class="label-control add-label" for="course">Subject Grouping <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> ENGLISH</option>
								<option> LABORATORY SUBJECTS</option>
								<option> NON-LABORATORY</option>
								<option> FILIPINO</option>
								<option> ELECTIVE</option>
								<option> SOCIAL SCIENCE</option>
								<option> PROFESSIONAL SUBJECT</option>
								<option> RIZAL</option>
								<option> NSTP</option>
								<option> DEFENSE TACTICS/PHYSICAL EDUCATION</option>
							</select>	


							<label class="label-control add-label2" for="lastname">Managed By</label>
							<input class="form-control" type="text" name="firstname" readonly placeholder="firstname" required value="COLLEGE OF ARTS AND SCIENCES">

						</div>
						</div>
		              <div class="form-group">
		              <div class="col-sm-offset-1 col-sm-6">
		                  <button type="submit" class="btn btn-success">Save</button>
		                  <button type="reset" class="btn btn-warning">Clear</button>
		             
		              	</div>
		            </div>

		            </div>

				</form>
			</div>
		</div>
	</div>

