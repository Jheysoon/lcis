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

		
	<div class="panel-body">	 
	<form action="/lc_curriculum/insertcurr" method="POST" />
		<?php echo $this->session->flashdata('message'); ?>
			<?php 
				$getAcademictTerm = $this->curriculum->getAc();
				$getCourse = $this->curriculum->getCourse();
				$getmajor = $this->curriculum->getm();
				if (isset($_SESSION['curr'])) {
					extract($_SESSION['curr']);
					unset($_SESSION['curr']);
				}else{
					$ac = '';
		            $cou = '';
		            $rem = '';
		            $lev = '';
				}
				
			 ?>
			<div class="col-md-6 ">	
				<label class="lbl-data">EFFECTIVE SCHOOLAR YEAR</label>
				<select class="form-control" name="acad_id">
				<option value="0">Select Effectivity</option>
				<?php 
				foreach ($getAcademictTerm as $key => $value): 
				extract($value);
				?>
					<?php if ($ac == $accad_id): ?>
						<option value="<?php echo $accad_id; ?>" selected><?php echo $sy; ?></option>
					<?php else: ?>
						<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>
					<?php endif ?>
					
				<?php endforeach ?>
					
				</select>										
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">REMARKS</label>
				<input class="form-control" type="text" name="remarks" value="<?php echo $rem ?>">										
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">COURSE</label>
				<select class="form-control" name = "coursemajor">
				<option value="0">Select Course</option>
				<?php 
					foreach ($getCourse as $key => $value): 
						extract($value)
				?>
				<?php if ($cou == $coursemajorid): ?>
					<option value="<?php echo $coursemajorid; ?>" selected><?php echo $desc_course; ?></option>
				<?php else: ?>
					<option value="<?php echo $coursemajorid; ?>"><?php echo $desc_course; ?></option>
				<?php endif ?>
					
				<?php endforeach ?>
					<?php 
						foreach ($getmajor as $key => $value): 
						extract($value);
					?>
					<?php if ($coursid == $cou): ?>
						<option value="<?php echo $coursid; ?>" selected><?php echo $coursemajors ; ?></option>
					<?php else: ?>
						<option value="<?php echo $coursid; ?>"><?php echo $coursemajors ; ?></option>
					<?php endif ?>
						
					<?php endforeach ?>
				</select>
			</div>

			<div class="col-md-6 ">	
				<label class="lbl-data">Year Level</label>
				<select class="form-control" name="yearlevel">	
						<option value="0">Select Year Level</option>
						<?php for ($i=1; $i < 6 ; $i++) { ?>
						<?php if ($i == $lev): ?>
								<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
							<?php else: ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php endif ?>
						
						<?php } ?>
				</select>									
			</div>
			<div class="col-md-12">
				<br/>
			  <button type="submit" class="btn btn-primary pull-right">Save</button>
			</div>
	</form>		
		
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
							<a class="a-table label label-info" href="/lc_curriculum/addsubcur/<?php echo $yearlevel . '/' . $coursemajor . '/' . $academicterm . '/' . $curricid; ?>/0">Viw Curriculum<span class="glyphicon glyphicon-pencil"></span></a>
							<a class="a-table label label-danger" href="/lc_curriculum/deletecur/<?php echo $curricid	 ?>" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
							<a type="button" class="a-table label label-info" data-toggle="modal" data-target="#<?php echo $curricid; ?>">
							  Copy Curriculum
							</a>
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
							<a class="a-table label label-info" href="/lc_curriculum/addsubcur/<?php echo $yearlevel . '/' . $coursemajor . '/' . $academicterm . '/' . $curricid;?>/1">Viw Curriculum<span class="glyphicon glyphicon-pencil"></span></a>
							<a class="a-table label label-danger" href="/lc_curriculum/deletecur/<?php echo $curricid ?>" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
			
							<a type="button" class="a-table label label-info" data-toggle="modal" data-target="#<?php echo $curricid ?>">
							  Copy Curriculum
							</a>
							</td>
						</tr>		
					<?php endforeach ?>
				</table>
					
				<?php foreach ($getAllcur as $key => $value): 
					extract($value);
				?>

				<div class="modal fade" id="<?php echo $curricid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <form action="/lc_curriculum/copycurr" method="POST">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel" style="color:black"></h4>
				      </div>
				      <div class="modal-body">
				      					<input type="hidden" value="<?php echo $curriculumdesc; ?>" name="currdesc">
				      					<input type="hidden" value="<?php echo $yearlevel; ?>" name="yearlevel">
				      					<input type="hidden" value="<?php echo $coursemajor; ?>" name="coursemajor">
				      					<input type="hidden" value="<?php echo $academicterm; ?>" name="academicterm">
				      					<input type="hidden" value="<?php echo $curricid; ?>" name="curricid">
										<label class="lbl-data">FROM</label>
										<select class="form-control">
										<option value="0">Select Effectivity</option>
										<?php 
										foreach ($getAcademictTerm as $key => $value): 
										extract($value);
										?>
											<?php if ($academicterm == $accad_id): ?>
												<option value="<?php echo $accad_id; ?>" selected><?php echo $sy; ?></option>
											<?php else: ?>
												<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>
											<?php endif ?>
										<?php endforeach ?>
										</select>	
										<br />
										<label class="lbl-data">TO</label>		
										<select class="form-control" name="acad_id">
											<option value="0">Select Effectivity</option>
											<?php 
											foreach ($getAcademictTerm as $key => $value): 
											extract($value);
											?>
													<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>

											<?php endforeach ?>
										</select>								
									</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input type="submit" class="btn btn-primary" value="Copy">
				      </div>
				    </div>
				  </div>
				  </form>
				</div>
				<?php endforeach ?>
				<?php foreach ($getAllcur2 as $key => $value): 
					extract($value);
				?>
				<div class="modal fade" id="<?php echo $curricid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<form action="/lc_curriculum/copycurr" method="POST">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel" style="color:black"></h4>
				      </div>
				      	<div class="modal-body">
				      					<input type="hidden" value="<?php echo $curriculumdesc; ?>" name="currdesc">
				      					<input type="hidden" value="<?php echo $yearlevel; ?>" name="yearlevel">
				      					<input type="hidden" value="<?php echo $coursemajor; ?>" name="coursemajor">
				      					<input type="hidden" value="<?php echo $academicterm; ?>" name="academicterm">
				      					<input type="hidden" value="<?php echo $curricid; ?>" name="curricid">
										<label class="lbl-data">FROM</label>
										<select class="form-control">
											<option value="0">Select Effectivity</option>
											<?php 
											foreach ($getAcademictTerm as $key => $value): 
											extract($value);
											?>
												<?php if ($academicterm == $accad_id): ?>
													<option value="<?php echo $accad_id; ?>" selected><?php echo $sy; ?></option>
												<?php else: ?>
													<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>	
										<br />
											<label class="lbl-data">TO</label>
										<select class="form-control" name="acad_id">
											<option value="0">Select Effectivity</option>
											<?php 
											foreach ($getAcademictTerm as $key => $value): 
											extract($value);
											?>
													<option value="<?php echo $accad_id; ?>"><?php echo $sy; ?></option>
											<?php endforeach ?>
										</select>	
				     	</div>
				               <div class="modal-footer">
				             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				           <input type="submit" class="btn btn-primary" value="Copy">
				         </div>
				       </div>
				  	 </div>
					</div>
				</form>
				<?php endforeach ?>
			</div>
		</div>
		</div>
	</div>
</div>