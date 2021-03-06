	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Cross-Enrollee Registration</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Student Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Student ID <small class="required">(Auto-Generated)</small></label>
							<input class="form-control input-id" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="2007-00301">

							<label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="lastname" required value="REYES">
						
							<label class="label-control add-label2" for="lastname">First Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="JOSE MARCO">
						
							<label class="label-control add-label2" for="lastname">Middle Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="middlename" placeholder="middlename" required value="REYES">
						
						</div>
						<div class = "col-sm-3">
							<img class="profile-main2" src="images/profile/img004.jpg">
							<button class="btn btn-success btn-block upload-photo"> Upload Photo</button>
						</div>
						<div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
					</div>		
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="course">Course <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<option> BACHELOR OF SECONDARY EDUCATION</option>
								<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</option>
								<OPTION> BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION</OPTION>
								<OPTION> BACHELOR OF LAWS (Ll.B.)</OPTION>
							</select>	
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">Major <small class="optional">(optional)</small></label>
							<select class="form-control" name='major' required>
								<option> </option>
								<option> </option>
								<option> </option>
								<option> </option>
								<option> </option>
								<option> </option>
							</select>	
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">Year Level <small class="required">(required)</small></label>
							<select class="form-control" name='major' required>
								<option> First Year</option>
								<option> Second Year</option>
								<option> Third Year</option>
								<option> Fourth Year</option>
							</select>	
						</div>
						<div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="course">Gender <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								<option> MALE</option>
								<option> FEMALE</option>
							</select>	
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">Marital Status <small class="optional">(optional)</small></label>
							<select class="form-control" name='major' required>
								<option> SINGLE</option>
								<option> MARRIED</option>
								<option> SEPARATED</option>
								<option> WIDOWED</option>
							</select>	
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="religion">Religion <small class="required">(required)</small></label>
							<select class="form-control" name='religion' required>
								
								<option> ROMAN CATHOLIC</option>
								<option> MUSLIM</option>
								<option> IGLESIA NI CRISTO</option>
								<option> </option>
								<option> </option>
							</select>	
						</div>
					</div>
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
							<input class="form-control" type="date" name="dob" required value="8 JANUARY 1998">	
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="dob">Place of Birth <small class="required">(required)</small></label>
							<input class="form-control" type="date" name="dob" required value="JARO, LEYTE">	
						</div>
					</div>		
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="add">Mailing Address <small class="required">(required)</small></label>
							<textarea class="form-control" name="add" placeholder="address" required>38 BURGOS ST.</textarea>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="town-city">Town/City <small class="required">(required)</small></label>
							<select class="form-control" name='town-city' required>
								
								<option> JARO</option>
								<option> PALO</option>
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
								<option> LEYTE</option>
								<option> Province xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Province xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Province xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Province xxxxxxxxxxxxxxxxxxxxx</option>
							</select>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="code">Zip Code <small class="required">(required)</small></label>
							<select class="form-control" name='code' required>
								<option> 6527</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
								<option> Zip Code xxxxxxxxxxxxxxxxxxxxx</option>
							</select>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Contact No. <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="scn" placeholder="Contact No." required value="+63 9145546468">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Email Address <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="jrroyo1997@yahoo.com">
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">Guardian Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Fathers Name <small class="required">(required)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value=" ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value=" ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="mother">Mothers Name <small class="required">(required)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="mother" placeholder="guardian" required value=" ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value=" ">
						</div>
					</div>

					<br><h3 class="col-sm-offset-1">Educational Background</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Elementary <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="JARO ELEMENTARY SCHOOL">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Date Graduated <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="23 March 2001">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">High School <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="JARO NATIONAL HIGH SCHOOL">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Date Graduated <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="23 May 2007">
						</div>
					</div>

					<br><h3 class="col-sm-offset-1">Credentials</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="graduated">School/University <small class="required">(required)</small></label>
							<input class="form-control" type="date" name="graduated" required value="LEYTE NORMAL UNIVERSITY">	
						</div>
					</div>

					<div class="form-group">
						<div class="row">
						<div class="col-sm-8 col-sm-offset-1">
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail scan">
						      <img src="../images/sample.jpg" alt="...">
						      <div class="caption">
						        <h5>Study Permit</h5>
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
							<label class="label-control add-label" for="uname">Username <small class="required">(required)</small></label>
							<input type="text" class="form-control" name="uname" placeholder="username" required value="royojo">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="pass">Password <small class="required">(required)</small></label>
							<input type="password" id="password" class="form-control" name="pass" placeholder="password" value = "xxxxxxxxxxx" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="rpass">Repeat Password <small class="required">(required)</small></label>
							<input type="password" class="form-control" name="rpass" placeholder="repeat password" value = "xxxxxxxxxxx" required>
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