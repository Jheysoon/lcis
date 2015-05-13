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
		<div class="col-md-6">
			<?php 
				echo $this->session->flashdata('message'); 
				$getSub = $this->common->getsub();
			?>
				<div class="col-md-12 ">	
					<label class="lbl-data">Subject</label>
					<select class="form-control" name="acad_id">
						<option value="">Select Subject</option>
						<?php 
							foreach ($getSub as $key => $value): 
							extract($value);	
						?>
							<option value="<?php echo $id; ?>"><?php echo $code ." - " . $descriptivetitle?></option>
						<?php endforeach ?>
					</select>										
				</div>

				<div class="col-md-12 ">	
					<label class="lbl-data">Term</label>
					<select class="form-control" name = "term">	
						<option value="0">Select Term</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>				
				</div>

				<div class="col-md-12 ">	
					<label class="lbl-data">Year Level</label>
					<select class="form-control" name = "yearlevel">
					<option value="0">Select Year Level</option>
					<?php
					$x = 1;
					 while ($x <= $yearlevel) { ?>
						<option value="<?php echo $x; ?>"><?php echo $x ?></option>
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
            $getcur = $this->common->getC($major, $acad);
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
                                	<a class="a-table label label-danger" href="#" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
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