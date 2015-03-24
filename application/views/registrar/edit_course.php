	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Course Table</h4>
				</div>
				<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Course Name">
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
					<br><h3 class="col-sm-offset-1">Course Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Course Description <small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)">
							
							<label class="label-control add-label2" for="lastname">Major <small class="required">(optional)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="lastname" required value="-">
						
							<label class="label-control add-label2" for="lastname">Short Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="AB POL SCI">

							<label class="label-control add-label2" for="course">College <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> COLLEGE OF ARTS AND SCIENCES</option>
								<option> COLLEGE OF CRIMINOLOGY</option>
								<option> COLLEGE OF EDUCATION</option>
								<option> COLLEGE OF LAW</option>
								<option> COLLEGE OF BUSINESS ADMINISTRATION</option>
							</select>	

							<label class="label-control add-label2" for="Units">Total Units <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="Units" width="100" required value="130">

							
						</div>

		            </div>
		              <div class="form-group">
		                <div class="col-sm-offset-1 col-sm-6">
		                  <button type="submit" class="btn btn-success">Save</button>
		                  <button type="reset" class="btn btn-warning">Clear</button>
		             
		              	</div>
		            </div>

				</form>
			</div>
		</div>
	</div>

