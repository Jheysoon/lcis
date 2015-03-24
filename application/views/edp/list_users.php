<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>User Access Management</h4>						
			</div>
			<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="User Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>

			     </form>
			</div>
		</div>

		<div class="panel-body">
		<div class="col-md-6 ">	
		<div class="form-group">
					<label for="sy">DEPARTMENT</label>
					<select class="form-control">
						<option>ALL</option>
						<option>FINANCE</option>
						<option>REGISTRAR</option>
						<option>AUDIT</option>
						<option>HUMAN RESOURCE</option>
						<option>ADMINISTRATIVE SUPPORT GROUP</option>
						<option>OPERATIONS SUPPORT GROUP</option>
						<option>COLLEGE OF ARTS AND SCIENCES</option>
						<option>COLLEGE OF BUSINESS ADMINISTRATION</option>
						<option>COLLEGE OF EDUCATION</option>
						<option>COLLEGE OF CRIMINOLOGY</option>
						<option>COLLEGE OF LAW</option>
					</select>
		</div>
		</div>
		</div>

		<div class="panel-body">
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>EMPLOYEE ID</th>
						<th>EMPLOYEE NAME</th>
						<th>DEPARTMENT</th>
						<th>DESIGNATION</th>						
						<th>USER ID</th>
						<th>ACTION</th>
					</tr> 

					<tr>
						<td>000001012</td>
						<td>GLENDA ROBLES</td>
						<td>FINANCE</td>
						<td>CASHIER</td>
						<td>roblesgl</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					<tr>
						<td>000001004</td>
						<td>JOANNA ALCOBAR</td>
						<td>FINANCE</td>
						<td>CASHIER</td>
						<td>alcobajo</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					<tr>
						<td>000000851</td>
						<td>ELIZABETH OCAMPO</td>
						<td>FINANCE</td>
						<td>COMPTROLLER</td>
						<td>ocampoel</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					<tr>
						<td>000000804</td>
						<td>REYNALDO VALDEZ</td>
						<td>REGISTRAR</td>
						<td>REGISTRAR CLERK</td>
						<td>valdezre</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					<tr>
						<td>000001006</td>
						<td>GINA LORENZANA</td>
						<td>REGISTRAR</td>
						<td>REGISTRAR CLERK</td>
						<td>lorenagi</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					<tr>
						<td>000000963</td>
						<td>ROWENA GENERAL</td>
						<td>COLLEGE OF ARTS AND SCIENCES</td>
						<td>DEAN</td>
						<td>generaro</td>
						<td><a class="a-table label label-info" href="index.php?page=editUser">Edit<span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>

				</table>

			</div>
		</div>
		</div>
	</div>
</div>