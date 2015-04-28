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
                            // fetch the records in tbl_enrollment
                            $result = $this->enrollment->getStud($param);

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