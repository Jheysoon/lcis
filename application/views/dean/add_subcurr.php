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

			 
	<form action="/lc_curriculum/insertsubj" method="POST" />
	<?php 
		$url = $yearlevel . '/' . $coursemajor . '/' . $academicterm . '/' . $currid . '/' . $m; 
	?>
		<div class="panel-body">
		<div class="col-md-6">
		<input type="hidden" name="currid" value="<?php echo $currid; ?>" />
		<input type="hidden" name="url" value="<?php echo $url; ?>" />

			<?php 
				echo $this->session->flashdata('message'); 
				$getSub = $this->common->getsub();
				if (isset($_SESSION['params'])) {
					extract($_SESSION['params']);
					unset($_SESSION['params']);
				}else{
					$year = '';
					$ter = '';
					$sub = '';
				}
			?>
				<div class="col-md-12 ">	
					<label class="lbl-data">Subject</label>
					<select class="form-control" name="subid">
						<option value="0">Select Subject</option>
						<?php 
							foreach ($getSub as $key => $value): 
							extract($value);	
						?>
						<?php if ($id == $sub): ?>
							<option value="<?php echo $id; ?>" selected><?php echo $code ." - " . $descriptivetitle?></option>
						<?php else: ?>
							<option value="<?php echo $id; ?>"><?php echo $code ." - " . $descriptivetitle?></option>
						<?php endif ?>
							
						<?php endforeach ?>
					</select>										
				</div>

				<div class="col-md-12 ">	
					<label class="lbl-data">Term</label>
					<select class="form-control" name = "term">	
					<option value="0" selected>Select Term</option>
						<?php for ($i=1; $i < 3; $i++) { ?>
						<?php if ($ter == $i): ?>
							<option value="<?php echo $i; ?>" selected><?php echo $i ?></option>
						<?php else: ?>
							<option value="<?php echo $i; ?>"><?php echo $i ?></option>
						<?php endif ?>
								
						<?php } ?>
					</select>				
				</div>

				<div class="col-md-12 ">	
					<label class="lbl-data">Year Level</label>
					<select class="form-control" name = "yearlevel">
					<option value="0">Select Year Level</option>
					<?php
					$x = 1;
					 while ($x <= $yearlevel) { ?>
					 <?php if ($x == $year): ?>
					 	<option value="<?php echo $x; ?>" selected><?php echo $x ?></option>
					 <?php else: ?>
					 	<option value="<?php echo $x; ?>"><?php echo $x ?></option>
					 <?php endif ?>
						
					<?php $x += 1;	} ?>
						
					</select>
				</div>
			
				<div class="col-md-12">
					</br />
				  <button type="submit" class="btn btn-primary pull-right" style="width:50px">Save</button>
				 </div>
			</div>
		</div>
	</form>
		<div class="panel-body">		
		<strong class="strong">LIST OF SUBJECTS</strong>
		<div class="table-responsive">
				<table class="table table-bordered no-space">
        <?php
        	$acad = $academicterm;
        	$major = $coursemajor;
        	$currid  = $currid;
        	if ($m == 0) {
        		$getcur = $this->common->getC($major, $acad);
        	} else {
        		$getcur = $this->common->getM($major, $acad);
        	}
        	
            
            $getCuYear = $this->common->getHeaderYear($acad, $major);
         ?>
            <th>Course</th>
            <th><strong><?php echo $getcur['coursedescription'] ?></strong></td>
            <th>Effectivity</th>
            <th colspan="2"><strong><?php echo $getcur['effectivity'] ?></strong></td> 
            	 <?php foreach ($getCuYear as $m => $va): 
                    extract($va)
            	?>
                  	 <tr>  
                            <td class="tbl-header-main" colspan="5">Year Level : <?php echo $yearlevel; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : <?php echo $term; ?></td>     
                    </tr>
                    	<tr>
                            <td class="tbl-header">Code</td>
                            <td class="tbl-header">Descriptive Title</td>
                            <td class="tbl-header" colspan="2">Units</th>
                            <td class="tbl-header">Action</th>
                    	</tr>
                 <?php 

                  $curr = $this->common->getsubcur($acad, $major,$term, $yearlevel);
                    foreach ($curr as $key => $val): 
                    extract($val)
                ?>
                            <tr>
                                <td><?php echo $code ?></td>
                                <td><?php echo $descriptivetitle; ?></td>
                                <td colspan="2"><?php echo $units ?></td> 
                                <td>
                                	<a class="a-table label label-danger" href="/lc_curriculum/deletesub/<?php echo $detailid . '/' . $url; ?>" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
									<a class="a-table label label-info" href="/dean/ident_subj/<?php echo $sid; ?>" target="_blank">Edit/View<span class="glyphicon glyphicon-pen"></span></a>
									<a class="a-table label label-info" href="/menu/dean-subject_list" target="_blank">Add<span class="glyphicon glyphicon-pen"></span></a>
                                </td>
                            </tr>
            <?php endforeach ?>
            
              <?php endforeach ?>
            
			</table>

			</div>
		</div>
		</div>
	</div>
</div>