	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>Student Grading</h4>						
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-4 ">
				<label class="lbl-data">COLLEGE</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="COLLEGE OF ARTS AND SCIENCES">							
			</div>
			<div class="col-md-4 ">
				<label class="lbl-data">DEAN</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="DEAN OF CAS">							
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">INSTRUCTOR</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="Dean">										
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data"> SCHOOL YEAR</label>
				<select class="form-control" name='course' required>
					<option> 2014 - 2015</option>
					<option> 2013 - 2014</option>							
					<option> 2012 - 2013</option>
					<option> 2011 - 2012</option>			
				</select>
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">TERM</label>
				<select class="form-control" name='course' required>
					<option> FIRST SEMESTER</option>
					<option> SECOND SEMESTER</option>							
					<option> SUMMER CLASS</option>
				</select>
			</div>
			
			<div class="col-md-4 ">
				<label class="lbl-data">STATUS</label>
				<select class="form-control" name='course' required>
					<option> ALL</option>
					<option> SUBMITTED</option>							
					<option> ATTESTED</option>
					<option> OPEN</option>			
				</select><br/>&nbsp;

			</div>

			<strong class="strong">Instructor's Teaching Load Assignment </strong>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Campus</th>
							<th>Room</th>
							<th>Time</th>
							<th>Day</th>
							<th>Subject Code</th>
							<th>Description</th>
							<th>No. of Students</th>
							<th>Status</th>
							<th>Action</th>
						</tr> 

						<tr>
							<td>PATERNO</td>
							<td>PT023</td>
							<td>09:00 AM - 12:00 NN</td>
							<td>WEDNESDAYS</td>
							<td>GUIDANCE 2</td>
							<td>PEER COUNSELING</td>
							<td>25</td>
							<td>Open</td>
						<td><a class="a-table label label-info" href="index.php?page=editStudentGrading">Update Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>PATERNO</td>
							<td>PT015</td>
							<td>09:00 AM - 12:00 NN</td>
							<td>SATURDAYS</td>
							<td>PRINCIPLE 1</td>
							<td>PRINCIPLE OF TEACHING 1</td>
							<td>40</td>
							<td>Submitted</td>

						<td><a class="a-table label label-info" href="index.php?page=editStudentGrading">View Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>PATERNO</td>
							<td>PT020</td>
							<td>03:00 PM - 04:30 PM</td>
							<td>MONDAYS THURSDAYS</td>
							<td>READING</td>
							<td>DEVELOPMENTAL READING</td>
							<td>33</td>
							<th>Attested</th>

						<td><a class="a-table label label-info" href="index.php?page=editStudentGrading">View Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>PATERNO</td>
							<td>PT002</td>
							<td>01:00 PM - 02:30 PM</td>
							<td>TUESDAYS FRIDAYS</td>
							<td>PRINCIPLE 1</td>
							<td>PRINCIPLE OF TEACHING 1</td>
							<td>24</td>
							<th>Attested</th>

						<td><a class="a-table label label-info" href="index.php?page=editStudentGrading">View Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>PATERNO</td>
							<td>PT008</td>
							<td>01:00 PM - 03:30 PM</td>
							<td>SATURDAYS</td>
							<td>FAC. LEARNING</td>
							<td>FACILITATING HUMAN LEARNING</td>
							<td>30</td>
							<td>Submitted</td>

						<td><a class="a-table label label-info" href="index.php?page=editStudentGrading">View Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

					</table>
				</div>
		</div>
</div>
</div>