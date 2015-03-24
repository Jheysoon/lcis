	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
	<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>Attest Completed INC Grades</h4>						
			</div>
		</div>

	<div class="form-group">
		<div class="panel-body">

			<div class="col-md-6 ">
				<label class="lbl-data">COLLEGE</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="COLLEGE OF EDUCATION">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">DEAN</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="DEAN OF COE">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<select class="form-control" name='course' required>
								<option> SY 2013-2014</option>
								<option> ALL</option>
								<option> SY 2014-2015</option>
								<option> SY 2012-2013</option>
								<option> SY 2011-2012</option>
				</select>	
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">TERM</label>
				<select class="form-control" name='course' required>
								<option> SECOND SEMESTER</option>
								<option> ALL</option>
								<option> SUMMER CLASS</option>
								<option> FIRST SEMESTER</option>								
				</select>	
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">STATUS</label>
				<select class="form-control" name='course' required>
								<option> ALL</option>
								<option> OPEN</option>		
								<option> COMPLETED</option>									
								<option> ATTESTED</option>
				</select>			
			</div>
			</div>
		<div class="panel-body">
			<label class="label-control add-label2" for="course">Open Incomplete Grades </label>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Student</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>Deficiency</th>
							<th>Status</th>
							<th>Re-Exam</th>
							<th>Action</th>

						</tr> 

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>SALAZAR, YOLANDA</td>
							<td>SPEECH AND ORAL COMMUNICATION</td>
							<td>PT026</td>
							<td>TUE FRI</td>
							<td>11:00 AM - 12:00 NN</td>
							<td>LACKS EXAMINATION</td>
							<td>OPEN</td>
							<td></td>
							<td><a class="a-table label label-info" href="index.php?page=viewINCGrading">View<span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>


						<tr>
							<td>INSTRUCTOR 1</td>
							<td>BERENGUEL, ANTONIO</td>
							<td>GENERAL PSYCHOLOGY</td>
							<td>PT019</td>
							<td>WED SAT</td>
							<td>08:00 AM - 09:00 AM</td>
							<td>LACKS FORMAL REPORT</td>
							<td>OPEN</td>
							<td></td>
							<td><a class="a-table label label-info" href="index.php?page=viewINCGrading">View<span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>SUAREZ, CONSOLACION</td>
							<td>PHYSICS FOR HEALTH SCIENCE</td>
							<td>PT011</td>
							<td>MON THU</td>
							<td>02:00 PM - 03:00 9M</td>
							<td>LACKS EXAMINATION</td>
							<td>OPEN</td>
							<td></td>
							<td><a class="a-table label label-info" href="index.php?page=viewINCGrading">View<span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>


					</table>
				</div>
				

			<label class="label-control add-label2" for="course">Fulfilled Incomplete Grades </label>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Student</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>Deficiency</th>
							<th>Status</th>
							<th>Re-Exam</th>
							<th>Action</th>

						</tr> 

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>STA. CLARA, JAIME</td>
							<td>INTRODUCTION TO LINGUISTICS</td>
							<td>PT025</td>
							<td>TUE FRI</td>
							<td>11:00 AM - 12:00 NN</td>
							<td>LACKS FORMAL REPORT</td>
							<td>COMPLETED</td>
							<td>2.8</td>
							<td><a class="a-table label label-info" href="index.php?page=attestINCGrading">View and Attest Completion <span class="glyphicon glyphicon-pencil"></span></a>
							</td>
						</tr>


						<tr>
							<td>INSTRUCTOR 1</td>
							<td>CORONEL, CINDY</td>
							<td>SPEECH AND ORAL COMMUNICATION</td>
							<td>PT004</td>
							<td>WED SAT</td>
							<td>08:00 AM - 09:00 AM</td>
							<td>LACKS FORMAL REPORT</td>
							<td>COMPLETED</td>
							<td>2.0</td>
							<td><a class="a-table label label-info" href="index.php?page=attestINCGrading">View and Attest Completion <span class="glyphicon glyphicon-pencil"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>ABELARDO, MARK JOSEPH</td>
							<td>ASTRONOMY</td>
							<td>PT041</td>
							<td>MON THU</td>
							<td>02:00 PM - 03:00 9M</td>
							<td>LACKS EXAMINATION</td>
							<td>COMPLETED</td>
							<td>2.7</td>
							<td><a class="a-table label label-info" href="index.php?page=attestINCGrading">View and Attest Completion <span class="glyphicon glyphicon-pencil"></span></a>
							</td>
						</tr>


					</table>
				</div>

			<label class="label-control add-label2" for="course">Attested Incomplete Grades </label>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Student</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>Deficiency</th>
							<th>Status</th>
							<th>Re-Exam</th>
							<th>Action</th>

						</tr> 

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>UBALDE, ALYSSA</td>
							<td>PRINCIPLE OF TEACHING</td>
							<td>PT006</td>
							<td>TUE FRI</td>
							<td>11:00 AM - 12:00 NN</td>
							<td>LACKS FORMAL REPORT</td>
							<td>ATTESTED</td>
							<td>2.8</td>
							<td><a class="a-table label label-info" href="index.php?page=viewAttestedINCGrading">View <span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>


						<tr>
							<td>INSTRUCTOR 1</td>
							<td>UY, WILLIAM</td>
							<td>SPEECH AND ORAL COMMUNICATION</td>
							<td>PT010</td>
							<td>WED SAT</td>
							<td>08:00 AM - 09:00 AM</td>
							<td>LACKS FORMAL REPORT</td>
							<td>ATTESTED</td>
							<td>2.0</td>
							<td><a class="a-table label label-info" href="index.php?page=viewAttestedINCGrading">View <span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>SANCHEZ, EDDIE BOY</td>
							<td>EDUCATIONAL TECHNOLOGY 2</td>
							<td>PT031</td>
							<td>MON THU</td>
							<td>02:00 PM - 03:00 9M</td>
							<td>LACKS EXAMINATION</td>
							<td>ATTESTED</td>
							<td>2.7</td>
							<td><a class="a-table label label-info" href="index.php?page=viewAttestedINCGrading">View <span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>


					</table>
				</div>
		<!-- -------------->
				<button type="submit" class="btn btn-success">Refresh</button>
		</div>
		</div>
</div>
</div>		
</div>