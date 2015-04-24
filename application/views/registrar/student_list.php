<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">						
			<?php //if ($page == "updateOldStudents"): ?>
				<h4>Student Information Management: List of Students</h4>						
			<?php //else: ?>
				<h4>Permanent Records: List of Students</h4>							
			<?php //endif ?>
			
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
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>Student Id</th>
						<th>Student Name</th>
						<th><select class="form-control" name='course' required>
								<!--<option> ALL</option>
								<option> BACHELOR OF SECONDARY EDUCATION</option>-->
								<option> BACHELOR OF SCIENCE IN CRIMINOLOGY</option>
								<!--<option> BACHELOR OF ELEMENTARY EDUCATION</option>
								<option> BACHELOR OF ARTS (A.B. POLITICAL SCIENCE)</option>
								<option> BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION</option>
								<OPTION> BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION</OPTION>
								<OPTION> BACHELOR OF LAWS (Ll.B.)</OPTION>-->
							</select>	
						</th>
						<!--<th>
                            <select class="form-control" name='Year Level' required>
								<option> THIRD YEAR</option>	
								<option> ALL</option>
								<option> FIRST YEAR</option>	
								<option> SECOND YEAR</option>	
								<option> FOURTH YEAR</option>	
							</select>
						</th>-->
						<th colspan="2">Action</th>
					</tr>

                    <?php
                        // fetch the first 15 records in tbl_enrollment
                        $result = $this->enrollment->get_first_15();

                        foreach($result as $info)
                        {
                            extract($info);
                            $stud_info = $this->party->getStudInfo($student);
                                $course = $this->course->getCourse($coursemajor);

                                ?>
                                <tr>
                                    <td><?php echo $stud_info['legacyid']; ?></td>
                                    <td><?php echo $stud_info['lastname'] . ' , ' . $stud_info['firstname'] ?></td>
                                    <td><?php echo $course; ?></td>
                                    <!--<td></td>-->
                                    <td><a class="a-table label label-info" href="/rgstr_build/<?php echo $stud_info['legacyid'];?>">View
                                            Records <span class="glyphicon glyphicon-file"></span></a></td>
                                </tr>
                            <?php
                            //}
                        }
                    ?>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>