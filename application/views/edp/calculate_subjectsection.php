	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-6">
					<h4>Generate Sections Using Previous Enrolment's Count</h4>
				</div>
			</div>

			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">GENERATING DATA FOR:</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">SCHOOL YEAR<small class="required"></small></label>
							<input class="form-control" maxlength="10" type="text" name="sid" placeholder="(e.g. 2014-00001)" required value="2014 - 2015">
							
							<label class="label-control add-label2" for="lastname">TERM <small class="required"></small></label>
							<select class="form-control" name='course' required>
								<option> SECOND SEMESTER</option>
								<option> FIRST SEMESTER</option>
							</select>	
						</div>
		            </div>

		            <div class="form-group">
		            	<div class="col-sm-offset-1 col-sm-6">
							<a class="btn btn-success" href="index.php?page=">Generate Data <span class="glyphicon glyphicon-pencil"></span></a>
							<a class="btn btn-warning" href="index.php?page=viewSubjectSection">View Result <span class="glyphicon glyphicon-search"></span></a>
		            	</div>
		            </div>

			</div>
		</div>
	</div>
</div>
