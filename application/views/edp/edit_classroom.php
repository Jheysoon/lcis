	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Classroom Table</h4>
				</div>
				<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Classroom Id">
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
					<br><h3 class="col-sm-offset-1">Classroom Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">ROOM NUMBER<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="PT001">
							
							<label class="label-control add-label2" for="lastname">CAMPUS <small class="required">(optional)</small></label>
							<select class="form-control" name='course' required>
								<option> PATERNO</option>
								<option> SAN JOSE</option>
							</select>	
						
							<label class="label-control add-label2" for="capacity">CAPACITY <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="40">

							<label class="label-control add-label2" for="course">FLOOR LEVEL <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> GROUND/FIRST FLOOR</option>
								<option> SECOND FLOOR</option>
								<option> THIRD FLOOR</option>
							</select>	

							<label class="label-control add-label2" for="Units">DIMENSION <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="Units" width="100" required value="10m x 10M">
							<label class="label-control add-label2" for="Units">REMARKS <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="remarks" placeholder="Units" width="100" required value="">
							<label class="label-control add-label2" for="course">STATUS <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
									<option> OK</option>
									<option> FOR/UNDER REPAIR</option>
							</select>	
								
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

