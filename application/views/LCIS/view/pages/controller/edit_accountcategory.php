	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Account Category</h4>
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Account Category">
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
					<br><h3 class="col-sm-offset-1">Account Category Information</h3><hr><br>



					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="course">Account Class <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> ASSET</option>
								<option> LIABILITY</option>
								<option> EQUITY</option>
								<option> INCOME</option>
								<option> EXPENSE</option>
							</select>	


							<label class="label-control add-label" for="sid">Account Category<small class="required">(required)</small></label>
							<input class="form-control" maxlength="3" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="001">

							<label class="label-control add-label" for="sid">Description<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="CASH ON HAND - CASHIER 1">

							<label class="label-control add-label" for="course">Account Level <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> SUMMARY</option>
								<option> DETAILED</option>
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