	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>New Student Registration</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="/registration" role="form">
						<input type="hidden" name="pics" value="">
					<br><h3 class="col-sm-offset-1">Student Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">
							<label class="label-control add-label" for="sid">Student ID
								<small class="required">Auto-Generated</small>
							</label>
							<input class="form-control input-id" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="<?php echo $legacyid; ?>">
							<label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" value="<?php echo $lname ?>" name="lastname" placeholder="Lastname" required>
							<label class="label-control add-label2" for="firstname">First Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" value="<?php echo $fname ?>" name="firstname" placeholder="First Name" required>
							<label class="label-control add-label2" for="middlename">Middle Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" value="<?php echo $mname ?>" name="middlename" placeholder="Middle Name" required>
						</div>
						<div class = "col-sm-3">

						</div>
						<div id="pic_wrapper">

						</div>
						<div class="pull-right" style="margin-right:90px;width:404px;">
							<button class="btn btn-success upload-photo" id="pre_take">Take Photo</button>
							<button class="btn btn-danger upload-photo hide" id="cancel_pic">Cancel</button>
						</div>

						<div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="course">Course <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<?php
									$c = $this->db->get('tbl_course')->result_array();
									foreach ($c as $val)
									{
										if($course != 0 AND $val['id'] == $course){
								?>
								<option value="<?php echo $val['id']; ?>" selected="selected"><?php echo $val['description']; ?></option>
								<?php
										}
										else {
											?>
								<option value="<?php echo $val['id']; ?>"><?php echo $val['description']; ?></option>
								<?php
										}
									}
								 ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">Major <small class="optional">(optional)</small></label>
							<select class="form-control" name='major'>
								<?php
									$m = $this->db->get('tbl_major')->result_array();
								 ?>
								 <option value="0" <?php set_select('major', 0, TRUE); ?>>Select major</option>
								 <?php
									foreach($m as $major)
									{
								?>
								<option value="<?php echo $major['id'] ?>" <?php echo set_select('major', $major['id']) ?>><?php echo $major['description'] ?></option>
								<?php
									}
								  ?>
							</select>
						</div>
					</div>

					<!-- <div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="yearlevel">Year Level <small class="required">(required)</small></label>
							<select class="form-control" name='yearlevel' required>
								<option> First Year</option>
								<option> Second Year</option>
								<option> Third Year</option>
								<option> Fourth Year</option>
							</select>
						</div>
						<div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
					</div> -->
					<?php if($id == 0){ ?>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="gender">Gender <small class="required">(required)</small></label>
							<select class="form-control" name='gender' required>
								<option value="M" <?php set_select('gender', 'M', TRUE) ?>> MALE</option>
								<option value="F" <?php set_select('gender', 'F') ?>> FEMALE</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="maritalstatus">Marital Status <small class="optional">(optional)</small></label>
							<select class="form-control" name='maritalstatus'>
								<option value="0" <?php echo set_select('maritalstatus', 0, TRUE) ?>>SINGLE</option>
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
							<select class="form-control" name='religion' required>
								<?php
									$r = $this->db->get('tbl_religion')->result_array();
									foreach ($r as $religion)
									{
								?>
								<option value="<?php echo $religion['id'] ?>" <?php echo set_select('religion', $religion['id']) ?>><?php echo $religion['description'] ?></option>
								<?php
									}
								 ?>
							</select>
						</div>
					</div>
					<!-- Reference table -->
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="nationality">Nationality <small class="required">(required)</small></label>
							<select class="form-control" name='nationality' required>
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
							<input class="form-control" type="date" name="dob" value="<?php echo set_value('dob'); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="pob">Place of Birth <small class="required">(required)</small></label>
							<textarea name="pob" required class="form-control" value="<?php echo set_value('pob'); ?>"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="mailadd">Mailing Address <small class="required">(required)</small></label>
							<textarea class="form-control" name="mailadd" placeholder="Mailing Address." required value="<?php echo set_value('mailadd'); ?>"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="town_city">Town/City <small class="required">(required)</small></label>
							<select class="form-control" name='town_city' required>
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
							<select class="form-control" name='province' required>
								<?php
									$p = $this->db->get('tbl_province')->result_array();
									foreach ($p as $province)
									{
								?>
								<option value="<?php echo $province['id'] ?>" <?php echo set_select('province', $province['id']) ?>><?php echo $province['description'] ?></option>
								<?php
									}
								 ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="zcode">Zip Code <small class="required">(required)</small></label>
							<select class="form-control" name='zcode' required>
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
							<input class="form-control" type="tel" maxlength="13" name="contact" value="<?php echo set_value('contact'); ?>" placeholder="Contact No.">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="emailadd">Email Address <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="emailadd" value="<?php echo set_value('emailadd'); ?>" placeholder="Email Address">
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">Guardian Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Fathers Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" maxlength="13" name="father" value="<?php echo set_value('father'); ?>" placeholder="Father's Name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="foccupation">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="text" maxlength="13" name="occupation" value="<?php echo set_value('occupation'); ?>" placeholder="Father's Guardian">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="mother">Mothers Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" maxlength="13" name="mother" value="<?php echo set_value('mother'); ?>" placeholder="Mother's Name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="moccupation">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="text" maxlength="13" name="moccupation" value="<?php echo set_value('moccupation'); ?>" placeholder="Mother's Occupation">
						</div>
					</div>

					<br><h3 class="col-sm-offset-1">Credentials</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="scholar">Scholarship <small class="optional">(optional)</small></label>
							<select class="form-control" name='scholar'>
								<option> NONE</option>
								<option> CHED StuFAP</option>
								<option> ACADEMIC SCHOLARSHIP</option>
								<option> BOARD MEMBER DEPENDENT</option>
								<option> EMPLOOYEE DEPENDENT</option>
								<option> ATHLETIC SCHOLAR</option>
								<option> CULTURAL SCHOLAR</option>
								<option> NON-ACADEMIC SCHOLAR</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<div class="col-sm-8 col-sm-offset-1">
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail scan">
						      <img src="images/sample.jpg" alt="...">
						      <div class="caption">
						        <h5>HS Card (Form 138-A)</h5>
						        <p><a href="#" class="btn btn-success btn-sm" role="button">View</a>
						        <a href="#" class="btn btn-warning btn-sm" role="button">Scan</a></p>
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail scan">
						      <img src="images/sample.jpg" alt="...">
						      <div class="caption">
						        <h5>Certificate of Good Moral Character</h5>
						        <p><a href="#" class="btn btn-success btn-sm" role="button">View</a>
						        <a href="#" class="btn btn-warning btn-sm" role="button">Scan</a></p>
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail scan">
						      <img src="images/sample.jpg" alt="...">
						      <div class="caption">
						        <h5>Certificate of Live Birth</h5>
						        <p><a href="#" class="btn btn-success btn-sm" role="button">View</a>
						        <a href="#" class="btn btn-warning btn-sm" role="button">Scan</a></p>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">User Account Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="username">Username <small class="required">(required)</small></label>
							<input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="password">Password <small class="required">(required)</small></label>
							<input type="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>" name="password" placeholder="Password" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="rpass">Repeat Password <small class="required">(required)</small></label>
							<input type="password" class="form-control" name="rpass" value="<?php echo set_value('rpass'); ?>" placeholder="Repeat Password" required>
						</div>
					</div>
					<?php } ?>
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
