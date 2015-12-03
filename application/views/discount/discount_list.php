
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">
				<h4>List of Student</h4>
			</div>
		</div>
            <?php echo $this->session->flashdata('message'); ?>
		<div class="panel-body">
         <div class="col-md-6">
                        <?php
                            $config['base_url'] = base_url().'index.php/menu/student_list';
                            $config['total_rows'] = $this->enrollment->enrolled();
                            $config['per_page'] = 15;
                            $config['num_links'] = 2;
                            $config['first_link'] = 'First';
                            $config['last_link'] = 'Last';
                            $config['first_tag_open'] = '<li>';
                            $config['first_tag_close'] = '</li>';
                            $config['last_tag_open'] = '<li>';
                            $config['last_tag_close'] = '</li>';
                            $config['num_tag_open'] = '<li>';
                            $config['num_tag_close'] = '</li>';
                            $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
                            $config['cur_tag_close'] = '</a></li>';
                            $config['next_tag_open'] = '<li>';
                            $config['next_tag_open'] = '</li>';
                            $config['prev_tag_open'] = '<li>';
                            $config['prev_tag_close'] = '</li>';
                            $config['next_tag_open'] = '<li>';
                            $config['next_tag_close'] = '</li>';
                            $config['prev_link'] = 'Prev';
                            $config['next_link'] = 'Next';
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
                            $data = array('param' => $param );
                        ?>
                        </ul>
                 </div>
                <div class="col-md-6"><br/>
									<form class="navbar-form navbar-right" action="/disc_submit" method="post" role="search">
											<!-- <input type="text" id = "thestatus" name = "stats" value="1"> -->

											<div class="form-group">
													<input type="hidden" name="cur_url" value="<?php echo current_url(); ?>"/>
												 <input type="text" name="stats" id="student_search" class="form-control" placeholder="Student Id">
											</div>
											<button type="submit" class="btn btn-primary">
													<span class="glyphicon glyphicon-search"></span>
											</button>
									</form>
                </div>
            <input type="hidden" name="param" value="<?php echo $param; ?>"/>
    		<div id="studlist_wrapper" class="table-responsive col-md-12">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                      $result = $this->enrollment->getStudents();
                      foreach($result as $info)
                        {
                            extract($info);
                            $stud_info = $this->party->getStudInfo($partyid);
                            $course = $this->course->getCourse($coursemajor);
                                ?>
                                <tr>
                                    <td><?php echo $stud_info['legacyid']; ?></td>
                                    <td><?php echo $stud_info['lastname'] . ' , ' . $stud_info['firstname'] ?></td>
                                    <td><?php echo $course; ?></td>
                                    <td>
                                        <a class="a-table label label-info" href="/view_discount/<?php echo $stud_info['legacyid'] ?>">View Discount&nbsp;<span class="glyphicon glyphicon-file"></span></a>                                   
                                    </td>
                                </tr>
                            <?php
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
