	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading"><h4>Account Settings</h4></div>
			<div class="panel-body">
				<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<h3>Change Username</h3><br>
					<input type="hidden" name="page" value="changeUsername">
					<div class="form-group">
						<label class="col-sm-2 label-control add-label" for="uname">Username</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="uname" placeholder="username" required value="<?php echo $_SESSION['uname'];?>">
						</div>
					</div>
		              <div class="form-group">
		                <div class="col-sm-offset-2 col-sm-6">
		                  <button type="submit" class="btn btn-success" ons>Save</button>
		                  <button type="reset" class="btn btn-warning">Reset</button>
		                </div>
		              </div>
				</form>
				<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<hr><h3>Change Password</h3><br>
					<input type="hidden" name="page" value="changePassword">
					<div class="form-group">
						<label class="col-sm-2 label-control add-label" for="op">Old Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="op" placeholder="password" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 label-control add-label" for="np">New Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="np" placeholder="password" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 label-control add-label" for="rp">Repeat Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="rp" placeholder="repeat password" required>
						</div>
					</div>
		              <div class="form-group">
		                <div class="col-sm-offset-2 col-sm-6">
		                  <button type="submit" class="btn btn-success">Save</button>
		                  <button type="reset" class="btn btn-warning">Clear</button>
		                </div>
		              </div>
				</form>
			</div>
		</div>
	</div>

</div>