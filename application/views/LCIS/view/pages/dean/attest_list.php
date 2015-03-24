	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>Attest Grade Sheet</h4>						
			</div>
		</div>

	<div class="form-group">
		<div class="panel-body">

			<div class="col-md-6 ">
				<label class="lbl-data">COLLEGE</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="COLLEGE OF ARTS AND SCIENCES">							
			</div>
			
			<div class="col-md-6 ">
				<label class="lbl-data">DEAN</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="DEAN OF CAS">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data"> SCHOOL YEAR</label>
				<select class="form-control" name='course' required>
					<option> 2014 - 2015</option>
					<option> 2013 - 2014</option>							
					<option> 2012 - 2013</option>
					<option> 2011 - 2012</option>			
				</select>
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">TERM</label>
				<select class="form-control" name='course' required>
					<option> FIRST SEMESTER</option>
					<option> SECOND SEMESTER</option>							
					<option> SUMMER CLASS</option>
				</select>
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">INSTRUCTOR</label>
				<select class="form-control" name='course' required>
					<option> DEAN</option>
					<option> INSTRUCTOR 1</option>							
					<option> INSTRUCTOR 2</option>
					<option> INSTRUCTOR 3</option>
					<option> INSTRUCTOR 4</option>
					<option> INSTRUCTOR 5</option>
				</select>
			</div>
			
			<div class="col-md-6 ">
				<label class="lbl-data">STATUS</label>
				<select class="form-control" name='course' required>
					<option> ALL</option>
					<option> SUBMITTED</option>							
					<option> ATTESTED</option>
					<option> OPEN</option>			
				</select><br/>&nbsp;
			</div>

		<div class="col-md-12">
			<label class="label-control add-label2" for="course">OPEN Grade Sheet </label>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>No. of Studens</th>
							<th>Status</th>
							<th>Action</th>
						</tr> 

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>PEER COUNSELING</td>
							<td>PT023</td>
							<td>WEDNESDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>20</td>
							<td>Open</td>
							<td><a class="a-table label label-info" href="index.php?page=viewOpenGradeSheet">View Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>CONTEMPORARY MATH</td>	
							<td>PT010</td>
							<td>SATURDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>40</td>
							<td>Open</td>
						<td><a class="a-table label label-info" href="index.php?page=viewOpenGradeSheet">View Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>DEAN</td>
							<td>DEVELOPMENTAL READING</td>
							<td>PT020</td>
							<td>MONDAYS THURSDAYS</td>
							<td>03:00PM - 04:00PM</td>
							<td>33</td>
							<td>Open</td>
						<td><a class="a-table label label-info" href="index.php?page=viewOpenGradeSheet">View Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>PRINCIPLE OF TEACHING 1</td>
							<td>PT002</td>
							<td>TUESDAYS FRIDAYS</td>
							<td>01:00 PM - 02:00 PM</td>
							<td>24</td>
							<td>Open</td>
						<td><a class="a-table label label-info" href="index.php?page=viewOpenGradeSheet">View Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 5</td>
							<td>FACILITATING HUMAN LEARNING</td>
							<td>PT008</td>
							<td>SATURDAYS</td>
							<td>01:00 PM - 03:00 PM</td>						
							<td>30</td>
							<td>Open</td>
						<td><a class="a-table label label-info" href="index.php?page=viewOpenGradeSheet">View Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

					</table>
				</div>
			</div>

	<div class="col-md-12">
		<label class="label-control add-label2" for="course">SUBMITTED Grade Sheet </label>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>No. of Studens</th>
							<th>Status</th>
							<th>Action</th>
						</tr> 

						<tr>
							<td>INSTRUCTOR 1</td>
							<td>PHILIPPINE GOVERNMENT AND NEW CONSTITUTION</td>
							<td>PT033</td>
							<td>TUESDAYS FRIDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>20</td>
							<td>Submitted</td>
							<td><a class="a-table label label-info" href="index.php?page=attestGradeSheet">View and Attest Grades <span class="glyphicon glyphicon-pencil"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>PHYSCAL SCIENCE</td>	
							<td>PT014</td>
							<td>MONDAYS THURSDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>40</td>
							<td>Submitted</td>
						<td><a class="a-table label label-info" href="index.php?page=attestGradeSheet">View and Attest Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 3</td>
							<td>ASSESSMENT OF STUDENT LEARNING 1</td>
							<td>PT022</td>
							<td>WEDNESDAYS SATURDAYS</td>
							<td>11:00 AM - 12:00 NN</td>
							<td>33</td>
							<td>Submitted</td>
						<td><a class="a-table label label-info" href="index.php?page=attestGradeSheet">View and Attest Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>PANIMULANG LINGGWISTIKA</td>
							<td>PT009</td>
							<td>TUESDAYS FRIDAYS</td>
							<td>01:00 PM - 02:00 PM</td>
							<td>24</td>
							<td>Submitted</td>
						<td><a class="a-table label label-info" href="index.php?page=attestGradeSheet">View and Attest Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 4</td>
							<td>KULTURANG POPULAR</td>
							<td>PT015</td>
							<td>SATURDAYS</td>
							<td>01:00 PM - 03:00 PM</td>						
							<td>30</td>
							<td>Submitted</td>
						<td><a class="a-table label label-info" href="index.php?page=attestGradeSheet">View and Attest Grades <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

					</table>
				</div>
			</div>		

		<div class="col-md-12">
		<label class="label-control add-label2" for="course">ATTESTED Grade Sheet </label>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Instructor</th>
							<th>Subject</th>
							<th>Room</th>
							<th>Day</th>
							<th>Time</th>
							<th>No. of Studens</th>
							<th>Status</th>
							<th>Action</th>
						</tr> 

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>SOCIAL DIMENSION</td>
							<td>PT011</td>
							<td>MONDAYS THURSDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>25</td>
							<td>Attested</td>
							<td><a class="a-table label label-info" href="index.php?page=viewAttestedGradeSheet">View Attested Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
							</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 2</td>
							<td>LOGIC</td>	
							<td>PT020</td>
							<td>SATURDAYS</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>40</td>
							<td>Attested</td>
						<td><a class="a-table label label-info" href="index.php?page=viewAttestedGradeSheet">View Attested Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 3</td>
							<td>INTERACTIVE ENGLISH</td>
							<td>PT029</td>
							<td>MONDAYS THURSDAYS</td>
							<td>03:00PM - 04:00PM</td>
							<td>33</td>
							<td>Attested</td>
						<td><a class="a-table label label-info" href="index.php?page=viewAttestedGradeSheet">View Attested Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 4</td>
							<td>PLANE TRIGONOMETRY</td>
							<td>PT002</td>
							<td>TUESDAYS FRIDAYS</td>
							<td>01:00 PM - 02:00 PM</td>
							<td>24</td>
							<td>Attested</td>
						<td><a class="a-table label label-info" href="index.php?page=viewAttestedGradeSheet">View Attested Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

						<tr>
							<td>INSTRUCTOR 5</td>
							<td>MUSIC, ARTS, PHYSICAL EDUCATION AND HEALTH</td>
							<td>PT008</td>
							<td>SATURDAYS</td>
							<td>01:00 PM - 03:00 PM</td>						
							<td>30</td>
							<td>Attested</td>
						<td><a class="a-table label label-info" href="index.php?page=viewAttestedGradeSheet">View Attested Grade Sheet <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>

					</table>
				</div>
					<button type="submit" class="btn btn-success">Refresh</button>
			</div>	
		</div>
		</div>
	</div>
</div>
</div>