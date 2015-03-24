	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit School Table</h4>
				</div>
			<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="School Name">
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
					<br><h3 class="col-sm-offset-1">School Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Name of School <small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="LEYTE NORMAL UNIVERSITY">
							
							</br>
							<div class="form-group">
							<fieldset>
									<label class=" col-md-12 label-control add-label">Teaching Level <small class="required">(required)</small></label>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="py" value="primary" checked>
									    	Primary
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="sy" value="secondary" checked>
									    	Secondary
									  	</label>
									</div>
									<div class="radio col-sm-offset-1 col-sm-7">
									  	<label>
									    	<input type="radio" name="ty" value="tertiaryondary" checked>
									    	Tertiary
									  	</label>
									</div>
							</fieldset>
							</div>
						
							<label class="label-control add-label2" for="lastname">Address <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="PATERNO STREET, TACLOBAN CITY, LEYTE">
						
							<label class="label-control add-label2" for="lastname">Registrar <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="GARY A. PINOTE">
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