<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>System Parameter: Add Subject To Curriculum</h4>						
			</div>

			<div class="col-md-4">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Subjecct Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
			     </form>
			</div>
		</div>

		<div class="panel-body">
			<?php 
				$getAcademictTerm = $this->curriculum->getAc();
				$getCourse = $this->curriculum->getCourse();
				$getmajor = $this->curriculum->getm();
			 ?>
			<div class="col-md-6 ">	
				<label class="lbl-data">EFFECTIVE SCHOOLAR YEAR</label>
				<select class="form-control">
				<?php 
				foreach ($getAcademictTerm as $key => $value): 
				extract($value);
				?>

					<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>
				<?php endforeach ?>
					
				</select>										
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">REMARKS</label>
				<input class="form-control" maxlength="10" type="text" name="remarks" placeholder="PER CMO#52 SERIES 2010/ADDENDUM TO CMO 45 SERIES 2010">										
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">COURSE</label>
				<select class="form-control">
				<?php 
					foreach ($getCourse as $key => $value): 
						extract($value)
				?>
					<option value="<?php echo $coursemajorid; ?>"><?php echo $desc_course; ?></option>
				<?php endforeach ?>
					<?php 
						foreach ($getmajor as $key => $value): 
						extract($value);
					?>
						<option value="<?php echo $coursid; ?>"><?php echo $coursemajors ; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			</br />
			<div class="col-md-4">
			  <button class="btn btn-primary pull-right" style="width:50px">Save</button>
			 </div>
		</div>

		<div class="panel-body">		
		<strong class="strong">LIST OF Curriculum</strong>
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
				<?php 
						$curr = $this

				 ?>
					<tr>
						<th>Subject Code</th>
						<th>Descriptive Title</th>
						<th>Units</th>
						<th>Action</th>
					</tr> 

					<tr>
						<td>MATH 1</td>
						<td>COLLEGE ALGEBRA</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="/dean/add_curriculum">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>


					<tr>
						<td>POL SC 01</td>
						<td>POLITICS AND GOVERNMENT (WITH PHILIPPINE CONSTITUTION)</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													

					<tr>
						<td>FIL 2</td>
						<td>PAGBASA AT PAGSULAT TUNGO SA PANANALIKSIK</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													

					<tr>
						<td>MATH 2</td>
						<td>PLANE TRIGONOMETRY</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													

					<tr>
						<td>NAT SC 2</td>
						<td>PHYSICAL SCIENCE</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													
					<tr>
						<td>POL SC 1</td>
						<td>FUNDAMENTALS OF POLITICAL SCIENCE</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													

					<tr>
						<td>PSYCH 1</td>
						<td>GENERAL PSYCHOLOGY</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													
					<tr>
						<td>HUM 1</td>
						<td>HUMANITIES</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>						

					<tr>
						<td>ENGL 2A</td>
						<td>COMMUNICATION ARTS (WRITING AND RHETORICS)</td>
						<td>3</td>
						<td><a class="a-table label label-info" href="index.php?page=editSubject">Add To Curriculum <span class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>													

				</table>

			</div>
		</div>
		</div>
	</div>
</div>