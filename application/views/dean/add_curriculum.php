<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
			<h4>System Parameter: Add Subject To Curriculum</h4>						
			</div>

		<!-- 	<div class="col-md-4">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Subjecct Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
			     </form>
			</div> -->
		</div>

			 
	<form action="/lc_curriculum/insertcurr" method="POST" />
		<div class="panel-body">
		<?php echo $this->session->flashdata('message'); ?>
			<?php 
				$getAcademictTerm = $this->curriculum->getAc();
				$getCourse = $this->curriculum->getCourse();
				$getmajor = $this->curriculum->getm();
			 ?>
			<div class="col-md-6 ">	
				<label class="lbl-data">EFFECTIVE SCHOOLAR YEAR</label>
				<select class="form-control" name="acad_id">
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
				<input class="form-control" type="text" name="remarks" placeholder="PER CMO#52 SERIES 2010/ADDENDUM TO CMO 45 SERIES 2010">										
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">COURSE</label>
				<select class="form-control" name = "coursemajor">
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
			  <button type="submit" class="btn btn-primary pull-right" style="width:50px">Save</button>
			 </div>
		</div>
	</form>
		<div class="panel-body">		
		<strong class="strong">LIST OF Curriculum</strong>
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
				<?php 
					$getAllcur = $this->curriculum->getAllcurr();
					$getAllcur2 = $this->curriculum->getAllcurr2();
				 ?>
					<tr>
						<th>Course</th>
						<th>Remarks</th>
						<th>Effective Year</th>
						<th>Action</th>
					</tr> 
					<?php 
						foreach ($getAllcur as $key => $value): 
						extract($value);
					?>
						<tr>
							<td><?php echo $coursename; ?></td>
							<td><?php echo $curriculumdesc ?></td>
							<td><?php echo $sy; ?></td>
							<td>
							<a class="a-table label label-info" href="/lc_curriculum/addsubcur/<?php echo $yearlevel . '/' . $coursemajor . '/' . $academicterm; ?>">Viw Curriculum<span class="glyphicon glyphicon-pencil"></span></a>
							<a class="a-table label label-danger" href="/lc_curriculum/deletecur/<?php echo $curricid	 ?>" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>		
					<?php endforeach ?>
					<?php 
						foreach ($getAllcur2 as $key => $value): 
						extract($value);
					?>
						<tr>
							<td><?php echo $coursename; ?></td>
							<td><?php echo $curriculumdesc ?></td>
							<td><?php echo $sy; ?></td>
							<td>
							<a class="a-table label label-info" href="/lc_curriculum/addsubcur/<?php echo $yearlevel . '/' . $coursemajor . '/' . $academicterm;?>">Viw Curriculum<span class="glyphicon glyphicon-pencil"></span></a>
							<a class="a-table label label-danger" href="/lc_curriculum/deletecur/<?php echo $curricid ?>" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>		
					<?php endforeach ?>
																

				</table>

			</div>
		</div>
		</div>
	</div>
</div>