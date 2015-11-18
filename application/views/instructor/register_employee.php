	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<div class="col-md-6">
						<h4>Employee Registration</h4>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<?php echo $error ?>
				<form class="form-horizontal add-user" method="post" action="/register_employee" role="form">
					<br><h3 class="col-sm-offset-1">Employee Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="Lastname" required value="<?php echo set_value('lastname') ?>">
							<label class="label-control add-label2" for="firstname">First Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="First Name" required value="<?php echo set_value('firstname') ?>">
							<label class="label-control add-label2" for="middlename">Middle Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="middlename" placeholder="Middle Name" required value="<?php echo set_value('middlename') ?>">
							<br>
							<hr>
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="office">Office <small class="required">(required)</small></label>
							<select class="form-control" name='office' required>
								<option value="">Select Office</option>
								<!-- temporary -->
								<?php
									$res = $this->party->getOffices();
									foreach ($res as $key => $value): ?>
									<option value="<?php echo $value['id'] ?>" <?php echo set_select('office', $value['id']) ?>><?php echo $value['description'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="position">Position <small class="required">(required)</small></label>
							<select class="form-control" name='position' required>
								<option value="">Select Position</option>
								<!-- temporary -->
								<?php
									$res = $this->party->getPositions();
									foreach ($res as $key => $value): ?>
									<option value="<?php echo $value['id'] ?>" <?php echo set_value('position', $value['id']) ?>><?php echo $value['description'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="gender">Gender <small class="required">(required)</small></label>
							<select class="form-control" name='gender' required>
								<option value="M" <?php echo set_select('gender', 'M', true) ?>> MALE</option>
								<option value="F" <?php echo set_select('gender', 'F') ?>> FEMALE</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="maritalstatus">Marital Status <small class="optional">(optional)</small></label>
							<select class="form-control" name='maritalstatus'>
								<option value="0" <?php echo set_select('maritalstatus', 0, true) ?>>SINGLE</option>
								<option value="1" <?php echo set_select('maritalstatus', 1) ?>>MARRIED</option>
								<option value="2" <?php echo set_select('maritalstatus', 2) ?>>SEPARATED</option>
								<option value="3" <?php echo set_select('maritalstatus', 3) ?>>WIDOWED</option>
							</select>
						</div>
					</div>
					<!--Reference table -->
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="religion">Religion <small class="required">(required)</small></label>
							<select class="form-control" name='religion'>
								<?php
									$r = $this->db->get('tbl_religion')->result_array();

									foreach ($r as $religion) {
								?>
								<option value="<?php echo $religion['id'] ?>" <?php echo set_select('religion', $religion['id']) ?>><?php echo $religion['description'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!-- Reference table -->
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="nationality">Nationality <small class="required">(required)</small></label>
							<select class="form-control" name='nationality' ><!--required-->
								<option> FILIPINO</option>
								<option> Others</option>
								<option> Nationality xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Nationality xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Nationality xxxxxxxxxxxxxxxxxxxxx</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="dob">Date of Birth <small class="required">(required)</small></label>
							<input class="form-control" type="date" name="dob" value="<?php echo set_value('dob') ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="pob">Place of Birth <small class="required">(required)</small></label>
							<textarea name="pob" class="form-control" required><?php echo set_value('pob') ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="mailadd">Mailing Address <small class="required">(required)</small></label>
							<textarea class="form-control" required name="mailadd" placeholder="Mailing Address."><?php echo set_value('mailadd') ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="town_city">Town/City <small class="required">(required)</small></label>
							<select class="form-control" name='town_city'>
								<option> TACLOBAN CITY</option>
								<option> Town/City xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Town/City xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Town/City xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Town/City xxxxxxxxxxxxxxxxxxxxx</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="province">Province <small class="required">(required)</small></label>
							<select class="form-control" name='province'>
								<?php
									$p = $this->db->get('tbl_province')->result_array();

									foreach ($p as $province) {
								?>
								<option value="<?php echo $province['id'] ?>" <?php echo set_select('province', $province['id']) ?>><?php echo $province['description'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="zcode">Zip Code <small class="required">(required)</small></label>
							<select class="form-control" name='zcode'>
								<option>6500</option>
								<option>6501</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="contact">Contact No. <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" name="contact" value="<?php echo set_value('contact') ?>" placeholder="Contact No.">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="emailadd">Email Address <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" required name="emailadd" value="<?php echo set_value('emailadd') ?>" placeholder="Email Address">
						</div>
					</div>

					<br><h3 class="col-sm-offset-1">User Account Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="username">Username <small class="required">(required)</small></label>
							<input type="text" class="form-control" disabled name="username" value="" placeholder="Username is autogenerated">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="password">Password <small class="required">(required)</small></label>
							<input type="password" id="password" class="form-control" value="" name="password" placeholder="Password" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="rpass">Repeat Password <small class="required">(required)</small></label>
							<input type="password" class="form-control" name="rpass" value="" placeholder="Repeat Password" required>
						</div>
					</div>
		              <div class="form-group">
		                <div class="col-sm-8 col-sm-offset-1">
		                  <button type="submit" class="btn btn-success">Save</button>
		                  <a href="index.php?page=addStudent" class="btn btn-warning">Clear</a>
		                </div>
		              </div>
				</form>
			</div>
		</div>
	</div>

</div>
