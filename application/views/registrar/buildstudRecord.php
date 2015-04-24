<?php

    $result = $this->common->select_student($id);
    extract($result);
?>

<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">

            <div class="col-md-6">
                <h4>Student's Permanent Record</h4>
            </div>

		</div>
		<div class="panel-body">

            <!--  search form  -->
            <form class="navbar-form navbar-right" action="<?php echo base_url(''); ?>" method="post" role="search">
                <div class="form-group">
                    <input type="text" id="student_search" name="search" autofocus class="form-control" placeholder="Student ID">
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>

			<img class="profile-main pull-left" src="<?php echo base_url('assets/images/sample.jpg'); ?>">
			<div class=" pull-left">
				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Student ID 		: </strong>
					<strong class="strong"><?php echo $legacyid; ?></strong>
				</div>
				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Name 			: </strong>
					<strong class="strong"><?php echo $firstname . " " . $middlename . " " . $lastname; ?></strong>
				</div>

				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Course 			: </strong>
					<strong class="strong"><?php echo $coursemajor . "|" . $partyid . "|" . $course . "|" . $description; ?></strong>
				</div>

				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Year Level 		: </strong>
					<strong class="strong">Third Year</strong>
				</div>
				
			</div>


				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Elementary 	: </strong>
					<strong class="strong">TACLOBAN ELEMENTARY School 	23 March 2008</strong>
				</div>

				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">High School :</strong>
					<strong class="strong">TACLOBAN NATIONAL HIGH SCHOOL 	23 April 2012</strong>
				</div>

		<div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
		<div class="table-responsive">
		
				
				 

		
					<table class="table table-bordered">
					<!-- Select First Party ID in the Table tbl_party where legacyid is equal to the of the parameter -->
						<?php 
							$result = $this->common->get_school($partyid);
							foreach ($result as $key => $val):  
								extract($val);
							$get_terms = $this->common->select_schoolyear($partyid, $school);
								
						?>
										<tr>
							                <td class = "tbl-header-main" colspan="2" width="60%"><strong>SCHOOL: <?php echo $sch; ?></strong></th>
							                <td class = "tbl-header-main" colspan="5"><strong>COURSE     : Bachelor of Elementary Education</strong></th>
							            </tr>

									<?php 
										foreach ($get_terms as $key => $terms): 
										extract($terms);
										$sy = $this->common->select_academicterm($academicterm);
										extract($sy);
									?>
										 <tr>
					                        <td class="tbl-header" colspan="2"><strong>School Year: <?php echo $systart . " - " . $syend; ?></strong></th>
					                        <td class="tbl-header" colspan="5"><strong>Term: <?php echo $description; ?> </strong></th>
					                    </tr>

					                    <tr>
					                        <td><strong>Code</strong></td>
					                        <td><strong>Subject</strong></td>
					                        <td class="tblNum"><strong>Final Grades</strong></td>
					                        <td class="tblNum"><strong>Re-Exam</strong></td>
					                        <td class="tblNum"><strong>Credit</strong></td>
					                        <td colspan="2">Action</td>
					                    </tr>
									<?php endforeach ?>
			                <?php 
			                 	endforeach 
			                ?>
				   </table>
					<!-- <tr>
						<td> ENG 101 </td>
						<td> COMMUNICATION ARTS </td>
						<td class="tblNum"> 2.1 </td>
						<td> &nbsp; </td>
						<td class="tblNum"> 3.0 </td>
						<td><a href="<?php echo base_url('registrar/edit_grades/Eng 101/Communication/2.1')  ?>" class="btn btn-link">Edit</a></td>
						<td><a href="#" class="btn btn-link">Delete</a></td>
					</tr>

					<tr>
						<td> FIL 001 </td>
						<td> KOMUNIKASYON SA AKADEMIKONG FILIPINO (KOMAKFIL) </td>
						<td class="tblNum"> 2.7 </td>
						<td> &nbsp; </td>
						<td class="tblNum"> 3.0 </td>
						<td><a href="#" class="btn btn-link">Edit</a></td>
						<td><a href="#" class="btn btn-link">Delete</a></td>
					</tr>

					<tr>
						<td> HUM 101 </td>
						<td> ART EDUCATION </td>
						<td class="tblNum"> 1.7 </td>
						<td> &nbsp; </td>
						<td class="tblNum"> 3 </td>
						<td><a href="#" class="btn btn-link">Edit</a></td>
						<td><a href="#" class="btn btn-link">Delete</a></td>
					</tr>

					<tr>
						<td> MATH_101 </td>
						<td> FUNDAMENTALS OF MATHEMATICS </td>
						<td class="tblNum"> 2.9 </td>
						<td> &nbsp; </td>
						<td class="tblNum"> 3 </td>
						<td><a href="#" class="btn btn-link">Edit</a></td>
						<td><a href="#" class="btn btn-link">Delete</a></td>
					</tr>

					<tr>
						<td> NSTP 101 </td>
						<td> NATIONAL SERVICE TRAINING PROGRAM </td>
						<td class="tblNum"> 2.1 </td>
						<td> &nbsp; </td>
						<td class="tblNum"> 3 </td>
						<td><a href="#" class="btn btn-link">Edit</a></td>
						<td><a href="#" class="btn btn-link">Delete</a></td>
					</tr>			 -->
				
			</div>
			</div>
		</div>
		</div>
	</div>
</div>