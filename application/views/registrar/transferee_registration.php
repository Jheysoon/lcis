<div class="col-md-3"></div>
		<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Transferee Registration</h4>
				</div>
			</div>
			</div>
			<div class="panel-body">
					<form class="form-horizontal add-user" method="post" action="index.php" role="form">
					<br><h3 class="col-sm-offset-1">Student Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="sid">Student ID <small class="required">(Auto-Generated)</small></label>
							<input class="form-control input-id" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-00001)" required value="2014-00300">

							<label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="lastname" placeholder="lastname" required value="FABI">
						
							<label class="label-control add-label2" for="lastname">First Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="firstname" placeholder="firstname" required value="LAURA">
						
							<label class="label-control add-label2" for="lastname">Middle Name <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="middlename" placeholder="middlename" required value="MANUEL">
						
						</div>
						<div class = "col-sm-3">
							<img class="profile-main2" src="images/profile/img005.jpg">
							<button class="btn btn-success btn-block upload-photo"> Upload Photo</button>
						</div>
						<div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
					</div>		
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="course">Course <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
							
								<option> BACHELOR OF SECONDARY EDUCATION</option>	
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
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
								<option> FEMALE</option>
								<option> MALE</option>
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
							<input class="form-control" type="date" name="dob" required value="8 FEBRUARY 1995">	
						</div>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="dob">Place of Birth <small class="required">(required)</small></label>
							<input class="form-control" type="date" name="dob" required value="PALO, LEYTE">	
						</div>
					</div>		
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="add">Mailing Address <small class="required">(required)</small></label>
							<textarea class="form-control" name="add" placeholder="address" required>55-B BOCOBO ST.</textarea>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="town-city">Town/City <small class="required">(required)</small></label>
							<select class="form-control" name='town-city' required>
								
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
								<option> 6501</option>
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
							<input class="form-control" type="tel" maxlength="13" name="scn" placeholder="Contact No." required value="+63 9275461298">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Email Address <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="lfabi@gmail.com">
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">Guardian Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Fathers Name <small class="required">(required)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value="ANTONIO FABI">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value="CONTRACTOR">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="mother">Mothers Name <small class="required">(required)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="mother" placeholder="guardian" required value="MARI FE">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="father">Occupation <small class="optional">(optional)</small></label>
							<input class="form-control" type="tel" maxlength="13" name="father" placeholder="guardian" required value="HOUSEWIFE">
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">Educational Background</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Elementary <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="KAUNLARAN ELEMENTARY SCHOOL">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Date Graduated <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="23 May 2005">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">High School <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="KAUNLARAN NATIONAL HIGH SCHOOL">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
							<label class="label-control add-label" for="scn">Date Graduated <small class="optional">(optional)</small></label>
							<input class="form-control" type="email" maxlength="13" name="scn" placeholder="Contact No." required value="23 March 2011">
						</div>
					</div>
					<br><h3 class="col-sm-offset-1">Credentials</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="scholar">Scholarship <small class="optional">(optional)</small></label>
							<select class="form-control" name='scholar' required>
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
						        <h5>Transcript of Records</h5>
						      </div>
						    </div>
						    <p><a href="#" class="btn btn-success btn-sm" role="button">View</a> 
						    <a href="#" class="btn btn-warning btn-sm" role="button">Scan</a></p>
						  </div>
						</div>
						</div>
					  </div>

				
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-8">
						<a class="btn btn-info" href="index.php?page=addTransfereePRecord">Add to Permanent Record <span class="glyphicon glyphicon-pencil"></span></a>				<button type="reset" class="btn btn-warning">Clear </button>
						</div>
					</div>


					<br><h3 class="col-sm-offset-1"></h3><hr><br>

					<br><h3 class="col-sm-offset-1">User Account Information</h3><hr><br>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="uname">Username <small class="required">(required)</small></label>
							<input type="text" class="form-control" name="uname" placeholder="username" required value="fabila">
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
		                  <a href="index.php?page=addStudent" class="btn btn-default">Clear</a>
		                </div>
		              </div>
				</form>
			</div>
		</div>
	</div>
