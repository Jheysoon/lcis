<?php 
	if(!isset($_SESSION['data'])){
		$sch   = '';
		$name  = '';
		$add   = '';
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
				<?php if (empty($param)): ?>
					<input type="hidden" name="action" value='add'>
				<?php else: ?>
					<?php 
						$res = $this->common->get_school_detail($param);
						$sch   = $res['firstname'];
						$name  = $res['registrarname'];
						$add   = $res['address1'];
						$short = $res['shortname'];
						$lvl1  = $res['primary'];
						$lvl2  = $res['elementary'];
						$lvl3  = $res['secondary'];
						$lvl4  = $res['tertiary'];
						
					 ?>
					<input type="hidden" name="action" value='update'>
					<input type="hidden" name="id" value='<?php echo $param; ?>'>
					<input type="hidden" name="sname" value='<?php echo $sch; ?>'>
				<?php endif ?>
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
						<?php if (empty($param)): ?>
							<a class="btn btn-default pull-right" href="/menu/registrar-sys_param">Clear</a>
							<button style="margin-right: 10px;" class="btn btn-primary pull-right" type="submit">Save</button>
						<?php else: ?>
							<a class="btn btn-default pull-right" href="/menu/registrar-sys_param">Cancel</a>
							<button style="margin-right: 10px;" class="btn btn-primary pull-right" type="submit">Update</button>
						<?php endif ?>
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
									<a class="a-table label label-info" href="/menu/registrar-sys_param/<?php echo $res['sch_id']; ?>">Update <span class="glyphicon glyphicon-pencil"></span></a>
									&nbsp;&nbsp;
									<a class="a-table label label-danger" onclick="return confirm('Are you sure you want to delete selected school?')" href="/registrar/delete_school/<?php echo $res['sch_id']; ?>">Delete <span class="glyphicon glyphicon-trash"></span></a>
								</td>
							</tr>
					 <?php	}
					 ?>
				</table>
			</div>
		</div>
	</div>
</div>