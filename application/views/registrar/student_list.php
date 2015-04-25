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
            <?php
                $config['base_url'] = base_url().'index.php/menu/registrar-student_list';
                $config['total_rows'] = $this->enrollment->getRows();
                $config['per_page'] = 15;
                $config['num_links'] = 5;
                $config['first_link'] = 'Previous';
                $config['last_link'] = 'Next';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_open'] = '</li>';
                $config['prev_link'] = FALSE;
                $config['next_link'] = FALSE;
                //$config['next_link'] = '<li><a href="#">&gt;</a></li>';
                if(empty($param))
                {
                    $param = 0;
                }
                $this->pagination->initialize($config);
            ?>
            <ul class="pagination">

            <?php
                echo $this->pagination->create_links();
            ?>
            </ul>
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
                <ul class="pagination">
                    <?php
                        echo $this->pagination->create_links();
                    ?>
                </ul>
			</div>
		</div>
		</div>
	</div>
</div>