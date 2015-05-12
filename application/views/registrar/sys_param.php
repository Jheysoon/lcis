<?php 
	$sch   = '';
	$name  = '';
	$add   = '';
	$name  = '';
	$short = '';
 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading">					
			<h4>System Parameter: Schools</h4>
		</div>

			<div class="panel-body">
				<form class="form" method="post" role="form" action="">
					<div class="form-group col-md-6">
						<label for="school">School Name</label>
						<input class="form-control" type="text" name="school" required placeholder="School Name" value="<?php echo $sch; ?>">

						<label for="address">Address</label>
						<input class="form-control" type="text" name="address" required placeholder="Address" value="<?php echo $add; ?>">
					
						<label for="name">Registrars Name</label>
						<input class="form-control" type="text" name="name" required placeholder="Registrars Name" value="<?php echo $name; ?>">
					</div>

					<div class="form-group col-md-6">
						<label for="short">Shortname</label>
						<input class="form-control" type="text" name="short" required placeholder="Shortname" value="<?php echo $short; ?>">
						<br/><label>School Level/s</label>
						<div class="checkbox">
						  <label>
						    <input type="checkbox" id="blankCheckbox" value="option1" aria-label="">
						    Primary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" value="option1" aria-label="">
						    Elementary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" value="option1" aria-label="">
						    Secondary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" value="option1" aria-label="">
						    Tertiary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						</div>
						<button class="btn btn-primary pull-right" type="submit">Save</button>
					</div>
						
				</form>
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th>School Name</th>
						<th>Short Name</th>
						<th>Registrar's Name</th>
						<th>Action</th>
					</tr>
					<?php 
						$result = $this->common->get_schools();
						foreach ($result as $res) { ?>
							<tr>
								<td><?php echo $res['firstname']; ?></td>
								<td><?php echo $res['shortname']; ?></td>
								<td><?php echo $res['registrarname']; ?></td>
								<td>
									<a class="a-table label label-info" href="">Update <span class="glyphicon glyphicon-pencil"></span></a>
								</td>
							</tr>
					 <?php	}
					 ?>
				</table>
			</div>
		</div>
	</div>
</div>