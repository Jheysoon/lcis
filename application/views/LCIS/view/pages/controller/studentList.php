<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">						
			<?php if ($page == "contStudentAssesment"): ?>
				<h4>ASSESSMENT: LIST OF STUDENTS</h4>						
			<?php else: ?>		
				<h4>STUDENT ACCOUNT INQUIRY: LIST OF STUDENTS</h4>							
			<?php endif ?>
			
			</div>
			<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Student Id">
			        </div>
			        <button type="submit" class="btn btn-warning">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>

			     </form>
			</div>
		</div>
		<div class="panel-body">
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>STUDENT ID</th>
						<th>STUDENT NAME</th>
						<th><select class="form-control" name='course' required>
								<option> COURSE</option>
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<option> BACHELOR OF SECONDARY EDUCATION</option>
								<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
								<option> BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</option>
								<OPTION> BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION</OPTION>
								<OPTION> BACHELOR OF LAWS (Ll.B.)</OPTION>
							</select>	
						</th>
						<th><select class="form-control" name='course' required>
								<option> YEAR LEVEL</option>
								<option> FIRST YEAR</option>									
								<option> SECOND YEAR</option>									
								<option> THIRD YEAR</option>	
								<option> FOURTH YEAR</option>	
							</select>	
						</th>
						<th>Action</th>
					</tr> 
					<tr>
						<td>2014-01268</td>
						<td>LAUDICO, MICHAEL</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>FIRST YEAR</td>
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="index.php?page=contAssesment">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="index.php?page=contInquiry">Inquiry</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2014-01510</td>
						<td>ACEDERA, RYAN JOENALDO</td>
						<td>BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</td>
						<td>FIRST YEAR</td>
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2012-00861</td>
						<td>ALARCON, ROEL</td>
						<td>BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</td>
						<td>THIRD YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2013-02541</td>
						<td>AQUINO, DEXTER</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>SECOND YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2012-01698</td>
						<td>ARELLANO, MARK</td>
						<td>BACHELOR OF LAWS</td>
						<td>THIRD YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2013-01635</td>
						<td>AZUCENA, RAUL</td>
						<td>BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</td>
						<td>SECOND YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2011-01343</td>
						<td>BANTAYAN, ALLEN</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>FOURTH YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2012-01886</td>
						<td>BAGRO, REYNADLDO</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>THIRD YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2013-01662</td>
						<td>BAJENTING, RAIMAR</td>
						<td>BACHELOR OF ELEMENTARY EDUCATION</td>
						<td>SECOND YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2012-00969</td>
						<td>BAUTISTA, LESTER</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>THIRD YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2013-00454</td>
						<td>BAYLON, EUGENE</td>
						<td>BACHELOR OF SCIENCE IN CRIMINOLOGY</td>
						<td>SECOND YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
					<tr>
						<td>2012-01445</td>
						<td>BERNABE, MARY JANE</td>
						<td>BACHELOR OF LAWS (Ll.b.)</td>
						<td>THIRD YEAR</td>						
						<?php if ($page == "contStudentAssesment"): ?>
							<td><a class="a-table label label-info" href="">View Assessment</a></td>
						<?php else: ?>
							<td><a class="a-table label label-info" href="">Inquire</a></td>
						<?php endif ?>
					</tr>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>