	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Academic Scholarship Information</h4>
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Student Id">
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
					<br><h3>Scholar Information</h3><hr><br>



					<div class="form-group">
						<div class="col-md-6">

							<label class="label-control add-label" for="sid">Student Id<small class="required">(required)</small></label>
							<input class="form-control" maxlength="3" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="2013-00465">

							<label class="label-control add-label" for="sid">Student Name<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="LEONCIO PAGAMUTAN">
	
							<label class="label-control add-label" for="sid">Course<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="B.S. CRIMINOLOGY">

							<label class="label-control add-label" for="sid">Year Level<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="2ND YEAR">
	
							<label class="label-control add-label" for="sid">General Weighted Average<small class="required">(required)</small></label>
							<input class="form-control small-box" maxlength="10" type="text"  readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="1.2">

							<label class="label-control add-label" for="sid">Term Discount Applicable<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text"  readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="1ST SEMESTER">

							<label class="label-control add-label" for="sid">School Year Discount Applicable<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text"  readonly  name="sid" placeholder="(e.g. 2014-00001)" required value="2014-2015">

							</div>	

							<div class="col-md-6">

							<label class="label-control add-label" for="course">Academic Scholarship <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> ACADEMIC SCHOLARSHIP</option>
								<option> BOARD MEMBER DEPENDENT</option>
								<option> EMPLOYEE DEPENDENT</option>
								<option> ATHLETIC SCHOLARSHIP</option>
								<option> CULTURAL SCHOLARSHIP</option>
								<option> SSG SCHOLARSHIP</option>
								<option> MISS LEYTE COLLEGES</option>
								<option> POOR BUT DESERVING</option>
							</select>	

							<label class="label-control add-label" for="sid">% Discount Applicable<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-00001)" required value="100">

							<div class="form-group">
				                <div class="col-sm-12">
				                  <br/>
				                  <button type="submit" class="btn btn-primary">Save</button>
				                  <a href="index.php?page=viewAcademicGWA" class="btn btn-default">View GWA</a>
				                  <a href="index.php?page=addStudent" class="btn btn-default">Clear</a>
				                </div>
				             </div>
							</div>	
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>

</div>