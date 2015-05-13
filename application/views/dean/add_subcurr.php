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
					<input class="form-control" type="text" name="remarks" placeholder="PER CMO#52 SERIES 2010/ADDENDUM TO CMO 45 SERIES 2010">										
				</div>

				<div class="col-md-12 ">	
					<label class="lbl-data">Year Level</label>
					<select class="form-control" name = "coursemajor">
						<option>Select Year Level</option>
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
             /*$getCurinfo = $this->common->getCurin($partyid, $date, $coursemajor);
            $getCuYear = $this->common->getYearTerm($partyid, $date, $coursemajor);*/
             ?>
            <th>Course</th>
            <th><strong>D</strong></td>
            <th>Effectivity</th>
            <th colspan="2"><strong></strong></td> 

                    <tr>  
                        <td class="tbl-header-main" colspan="5">Year Level : ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : </td>      
                    </tr>
                    	<tr>
                            <td class="tbl-header">Code</td>
                            <td class="tbl-header">Descriptive Title</td>
                            <td class="tbl-header" colspan="2">Units</th>
                            <td class="tbl-header">Action</th>
                    	</tr>
                        
            
			</table>

			</div>
		</div>
		</div>
	</div>
</div>