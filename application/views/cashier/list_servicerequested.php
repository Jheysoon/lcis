<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">						
				<h4>List of Services Requested</h4>						
			</div>
			<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Student Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>

			     </form>
			</div>
		</div>
		<div class="panel-body">
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>Student Id</th>
						<th>Student Name</th>
						<th><select class="form-control" name='course' required>
								<option> All Courses</option>
								<option> BACHELOR OF SECONDARY EDUCATION</option>	
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
								<option> BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</option>
								<OPTION> BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION</OPTION>
								<OPTION> BACHELOR OF LAWS (Ll.B.)</OPTION>
							</select>	
						</th>
						<th><select class="form-control" name='service' required>
								<option> All Services</option>
								<option> PRINTING OF TRANSCRIPT OF RECORDS</option>	
								<option> DIPLOMA - COLLEGE</option>
								<option> DIPLOMA - HIGH SCHOOL</option>
								<option> CERTIFICATION</option>
								<option> AUTHENTICATION</option>
								<OPTION> SCANNING</OPTION>
								<OPTION> INC PROCESSING</OPTION>
							</select>	
						</th>
						<th><select class="form-control" name='Status' required>
								<option> OPEN</option>	
								<option> All Status</option>
								<option> PAID</option>	
								<option> IN PROCESS</option>	
								<option> COMPLETED</option>	
							</select>	
						</th>
						<th>Action</th>
					</tr> 
					<tr>
						<td>2010-000121</td>
						<td>THELMA DE LA CRUZ</td>
						<td>BACHELOR IN SECONDARY EDUCATION</td>
						<td>PRINTING OF TRANSCRIPT OF RECORDS</td>
						<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=addServicePayment">Receive Payment <span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
					<tr>
						<td>2011-000151</td>
						<td>ELLEN TAN</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>INC PROCESSING</td>
						<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=addServicePayment">Receive Payment <span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
					<tr>
						<td>2014-002478</td>
						<td>ARTHUR RAMIREZ</td>
						<td>B.S. CRIMINOLOGY</td>
						<td>SCANNING</td>
						<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=addServicePayment">Receive Payment <span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
					<tr>
						<td>2013-002531</td>
						<td>BETILDA MILAGROSA</td>
						<td>AB POLITICAL SCIENCE</td>
						<td>CERTIFICATION</td>
						<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=addServicePayment">Receive Payment <span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>