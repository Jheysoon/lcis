	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">				
			<h4>Fulfillment of Incomplete Grade</h4>
		</div>

		<div class="panel-body">

			<div class="col-md-4 ">
				<label class="lbl-data">COLLEGE</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="COLLEGE OF ARTS AND SCIENCES">							
			</div>
	
			<div class="col-md-4 ">
				<label class="lbl-data">DEAN</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="DEAN OF CAS">							
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">INSTRUCTOR</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="DEAN">							
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<select class="form-control" name='course' required>
								
								<option> SY 2013-2014</option>
								<option> ALL</option>
								<option> SY 2014-2015</option>
								<option> SY 2012-2013</option>
								<option> SY 2011-2012</option>
				</select>	
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">TERM</label>
				<select class="form-control" name='course' required>
				
								<option> SECOND SEMESTER</option>
								<option> FIRST SEMESTER</option>
								<option> SUMMER CLASS</option>
								<option> ALL</option>							
				</select>
			</div>		

			<div class="col-md-4 ">
				<label class="lbl-data">STATUS</label>
				<select class="form-control" name='course' required>
								<option> ALL</option>							
								<option> OPEN</option>
								<option> COMPLETED</option>
								<option> ATTESTED</option>
				</select>
			</div>		

		</div>
		
		<strong class="strong" for="course">List of Students/Subjects with Incomplete Grades </strong>
		<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Student Id</th>
							<th>Student Name</th>
							<th>Code</th>
							<th>Subject Description</th>
							<th>Grade</th>
							<th>Re-Exam</th>
							<th>Deficiency</th>
							<th>Expiration</th>				
							<th>Room</th>
							<th>Time</th>
							<th>Day</th>
							<th>Status</th>
						</tr> 

						<tr>
							<td>2013-00633</td>
							<td>ZARUDO, DAVID</td>
							<td>FS 2</td>
							<td>FIELD STUDY 2</td>
							<td>INC</td>
							<TD></TD>
							<td>Lacks formal report</td>					
							<TD>04.08.2015</TD>
							<td>PT002</td>
							<td>10:00 AM - 11:00 AM</td>
							<td>MON THU</td>
							<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=updateINCGrading">Update <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>

							<td>2013-00133</td>
							<td>BARTOLOME, SALVADOR</td>
							<td>GUIDANCE 2</td>
							<td>PEER COUNSELING</td>
							<td>INC</td>
							<td></td>
							<td>Lacks examination and formal report</td>
							<TD>04.08.2015</TD>
							<td>PT023</td>
							<td>09:00 AM - 11:00 AM</td>
							<td>WED</td>
							<td>OPEN</td>
						<td><a class="a-table label label-info" href="index.php?page=updateINCGrading">Update <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
						</tr>

						<tr>
							<td>2013-00138</td>
							<td>UBALDE, ALYSSA</td>
							<td>PRIN 2</td>
							<td>PRINCIPLE OF TEACHING 2</td>
							<td>INC</td>
							<td>2.5</td>
							<td>LACKS FORMAL REPORT</td>
							<TD>04.08.2015</TD>
							<td>PT006</td>
							<td>11:00 PM - 12:00 NN</td>
							<td>TUE FRI</td>
							<td>ATTESTED</td>
						<td><a class="a-table label label-info" href="index.php?page=viewAttestedINCGrading">View <span class="glyphicon glyphicon-search"></span></a>
						</td>
						</tr>
					</table>
				</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Refresh</button>
			</div>
			</div>
	</div>
</div>
</div>