	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Holiday Table</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">School Holiday Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Date <small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="06.12.2014">
							
							<label class="label-control add-label2" for="lastname">Holiday <small class="required">(optional)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="lastname" required value="Independence Day">
						
							<label class="label-control add-label2" for="course">Type <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> NATIONAL HOLIDAY</option>
								<option> LOCAL HOLIDAY</option>
								<option> COMMON NON-WORKING HOLIDAY</option>
								<option> SPECIAL NON-WORKING HOLIDAY</option>
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