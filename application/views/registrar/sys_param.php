<?php 
	if(!isset($_SESSION['data'])){
		$sch   = '';
		$name  = '';
		$add   = '';
		$name  = '';
		$short = '';
		$lvl1  = '';
		$lvl2  = '';
		$lvl3  = '';
		$lvl4  = '';
	}
	else{
		extract($_SESSION['data']);
		unset($_SESSION['data']);
	}
 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading">					
			<h4>System Parameter: Schools</h4>
		</div>

			<div class="panel-body">
				<?php echo $this->session->flashdata('message'); ?>
				<form class="form" method="post" role="form" action="/registrar/add_school">
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
						    <input type="checkbox" id="blankCheckbox" name='lvl1' value="1" <?php if($lvl1 == 1){echo "checked";} ?>>
						    Primary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" name='lvl2' value="1" <?php if($lvl2 == 1){echo "checked";} ?>>
						    Elementary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" name='lvl3' value="1" <?php if($lvl3 == 1){echo "checked";} ?>>
						    Secondary &nbsp;&nbsp;&nbsp;&nbsp;
						  </label>
						  <label>
						    <input type="checkbox" id="blankCheckbox" name='lvl4' value="1" <?php if($lvl4 == 1){echo "checked";} ?>>
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