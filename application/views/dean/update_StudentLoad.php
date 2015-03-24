<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		
		<div class="panel-heading search">
		<div class="col-md-6">
			<h4>Adding/Changing of Student Load</h4>
		</div>
		<div class="col-md-6">
			<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			<div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Student Id">
			</div>
			<button type="submit" class="btn btn-primary">
			    <span class="glyphicon glyphicon-search"></span>
			</button>
			</form>
		</div>		
		</div>


		<div class="panel-body">
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT ID</label>
				<input class="form-control" maxlength="10" type="text" readonly name="sid" placeholder="(e.g. 2014-2015)" required value="2014-01982">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT NAME</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="TEODORO A. LARIETO">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="2014 - 2015">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">TERM</label>
				<input class="form-control" maxlength="10" type="text" readonly  name="sid" placeholder="(e.g. 2014-2015)" required value="FIRST SEMESTER">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">COURSE</label>
				<input class="form-control" maxlength="10" type="text"  readonly name="sid" placeholder="(e.g. 2014-2015)" required value="BACHELOR OF SCIENCE IN CRIMINOLOGY">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">YEAR LEVEL</label>
				<input class="form-control" maxlength="10" type="text" readonly  name="sid" placeholder="(e.g. 2014-2015)" required value="FIRST YEAR">							
			</div>
		</div>


		<strong class="strong">Student's Study Load</strong>

		<div class="table-responsive">
			<form class="form" role="form">
				<table class="table table-bordered table-hover">
					<tr>
						<th width="20">DELETE</th>
						<th>CODE</th>
						<th>SUBJECT DESCRIPTION</th>
						<th>UNITS</th>
						<th>DAYS</th>
						<th>TIME</th>
						<th>ROOM</th>
						<th>CAMPUS</th>
						<th>COUNT</th>
						<th>MINIMUM</th>
						<th>STATUS</th>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>ENGL 01</td>
						<td>ENRICHMENT ENGLISH</td>
						<td>3</td>
						<td>Mon/Thu</td>
						<td>9:00 am – 10:00 am</td>
						<td>SJ008</td>
						<td>San Jose</td>
						<td>15</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>FIL 1</td>
						<td>SINING NG PAKIKIPAGTALASTASAN</td>
						<td>3</td>
						<td>Mon/Thu</td>
						<td>10:00 am – 11:00 am</td>
						<td>SJ009</td>
						<td>San Jose</td>
						<td>20</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>MATH 1</td>
						<td>COLLEGE ALGEBRA</td>
						<td>3</td>
						<td>Mon/Thu</td>
						<td>12:00 NN – 01:00 pm</td>
						<td>SJ017</td>
						<td>San Jose</td>
						<td>7</td>
						<td>15</td>
						<td>DISSOLVED</td>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>LIT 1</td>
						<td>PHILIPPINE LITERATURE</td>
						<td>3</td>
						<td>Tue/Fri</td>
						<td>9:00 am – 10:00 am</td>
						<td>SJ019</td>
						<td>San Jose</td>
						<td>25</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>ECON 1</td>
						<td>PRINCIPLES OF ECONOMICS WITH LRT</td>
						<td>3</td>
						<td>Tue/Fri</td>
						<td>10:00 am – 11:00 am</td>
						<td>SJ005</td>
						<td>San Jose</td>
						<td>30</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>

					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>B MACH</td>
						<td>KEYBOARDING</td>
						<td>3</td>
						<td>Tue/Fri</td>
						<td>11:00 am – 12:00 nn</td>
						<td>SJ005</td>
						<td>San Jose</td>
						<td>32</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>
					<tr>
						<td><input type="checkbox">  <span class="glyphicon glyphicon-trash"></span></td>
						<td>NSTP</td>
						<td>NATIONAL SERVICE TRAINING PROGRAM - ROTC</td>
						<td>3</td>
						<td>Sat</td>
						<td>9:00 am – 12:00 nn</td>
						<td></td>
						<td>San Jose</td>
						<td>32</td>
						<td>15</td>
						<td>OPEN</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<th>TOTAL UNITS</th>
						<th>21</th>
						<td></td>
						<th>TOTAL SUBJECTS</th>
						<th>7</th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				</form>
				</div>

		<strong class="strong">Add to Student's Study Load</strong>

		<div class="table-responsive">
			<form class="form" role="form">
				<table class="table table-bordered table-hover">
					<tr>
						<td class="tbl-header" colspan="2"><strong>Code: </strong>PSYCH 1</td>
						<td class="tbl-header" colspan="2"><strong>Subject: </strong>GENERAL PSYCHOLOGY</td>
						<td class="tbl-header"><strong>Units: </strong>3</td>
						<td class="tbl-header" colspan="2"><strong>Count/Minimum</strong></td>
					</tr>

					<tr>
						<td><input type="checkbox"></td>
						<td>Tue/Fri</td>
						<td>1:00 pm – 2:00 pm</td>
						<td>SJ005</td>
						<td>San Jose</td>
						<td>25</td>
						<td>15</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Mon/Thu</td>
						<td>10:00am - 11:00am</td>
						<td>SJ010</td>
						<td>San Jose</td>
						<td>19</td>
						<td>15</td>
					</tr>
					<tr>
						<td class="tbl-header" colspan="2"><strong>Code: </strong>CRIM 1</td>
						<td class="tbl-header" colspan="2"><strong>Subject: </strong>INTRODUCTION TO CRIMINOLOGY AND PSYCHOLOGY OF CRIJME</td>
						<td class="tbl-header"><strong>Units: </strong>3</td>
						<td class="tbl-header" colspan="2"><strong>Count/Minimum</strong></td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Wednesdays</td>
						<td>9:00 am – 12:00 nn</td>
						<td>SJ011</td>
						<td>San Jose</td>
						<td>31</td>
						<td>10</td>
					</tr>
					<tr>
						<td width="25"><input type="checkbox"></td>
						<td>Wed/Sat</td>
						<td>9:00 am – 10:00 am</td>
						<td>SJ009</td>
						<td>San Jose</td>
						<td>29</td>
						<td>10</td>
					</tr>				

					<tr>
						<td class="tbl-header" colspan="2"><strong>Code: </strong>D TAC 1</td>
						<td class="tbl-header" colspan="2"><strong>Subject: </strong>FUNDAMENTALS OF MARTIAL ARTS</td>
						<td class="tbl-header"><strong>Units: </strong>(2)</td>
						<td class="tbl-header" colspan="2"><strong>Count/Minimum</strong></td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Tue/Thu</td>
						<td>9:00 am – 12:00 nn</td>
						<td>SJ020</td>
						<td>San Jose</td>
						<td>38</td>
						<td>15</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Mon/Thu</td>
						<td>10:00am - 11:00am</td>
						<td>SJ030</td>
						<td>San Jose</td>
						<td>36</td>
						<td>15</td>
					</tr>
					<tr>
						<td width="25"><input type="checkbox"></td>
						<td>Wed/Sat</td>
						<td>9:00 am – 10:00 am</td>
						<td>SJ005</td>
						<td>San Jose</td>
						<td>35</td>
						<td>15</td>
					</tr>				

					<tr>
						<td class="tbl-header" colspan="2"><strong>Code: </strong>GUID 1</td>
						<td class="tbl-header" colspan="2"><strong>Subject: </strong>SELF-DEVELOPMENT CONCEPT</td>
						<td class="tbl-header"><strong>Units: </strong>3</td>
						<td class="tbl-header" colspan="2"><strong>Count/Minimum</strong></td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Mon/Thu</td>
						<td>2:00 pm – 3:00 pm</td>
						<td>SJ015</td>
						<td>San Jose</td>
						<td>20</td>
						<td>15</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td>Mon/Thu</td>
						<td>10:00am - 11:00am</td>
						<td>SJ011</td>
						<td>San Jose</td>
						<td>29</td>
						<td>15</td>
					</tr>

					<tr>
						<td><input type="checkbox"></td>
						<td>Mon/Thu</td>
						<td>10:00am - 11:00am</td>
						<td>SJ016</td>
						<td>San Jose</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td width="25"><input type="checkbox"></td>
						<td>Wed/Sat</td>
						<td>9:00 am – 10:00 am</td>
						<td>SJ035</td>
						<td>San Jose</td>
						<td></td>
						<td></td>
					</tr>				

				</table>
			</form>
			</div>

			<div class="form-group">
				<a class="btn btn-info" href="index.php?page=viewUpdatedSummary">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></a>
			</div>
			</div>
		</div>
	</div>
</div>