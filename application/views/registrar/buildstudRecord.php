<?php
    //1999-00344-1 duplicate subj.

	$position = $this->session->userdata('position');

    
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
            <div class="col-md-4">
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
                        <?php if ($position != 'Admin-registrar'): ?>
                        	<select class="form-control" name="" id="">
                            <?php
                                $course = $this->course->allCourse();

                                foreach($course as $c)
                                {
                                    if($c['description'] == $description)
                                    {
                                    ?>
                                        <option value="<?php echo $c['id']; ?>" selected><?php echo $c['description']; ?></option>
                                    <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $c['id']; ?>"><?php echo $c['description']; ?></option>
                                    <?php
                                        }
                                    ?>
                            <?php
                                }
                            ?>
                        </select>
                    <?php else: ?>
                    		<?php echo $description; ?>
                    <?php endif ?>
                        
				</div>

				<!-- <div class="col-md-12 pad-bottom-10">
					<strong class="strong">Year Level 		: </strong>
					<strong class="strong">Third Year</strong>
				</div>
				 -->
			</div>
            <div class="col-md-5">
                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Elementary   : </strong>
                    <strong class="strong"><!-- variable --></strong>
                </div>

                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">High School :</strong>
                    <strong class="strong"><!-- variable --></strong>
                </div>
            </div>

		<div class="col-md-3 pad-bottom-10"><img class="profile-main pull-right" src="<?php echo base_url('assets/images/sample.jpg'); ?>"></div>
            
        <div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
            <!-- div class panel -->
            <!--<div class="panel">-->

                <!-- div class table-responsive -->

                <!-- modal add academicterm -->
                <div class="modal fade" id="modal_academicterm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <form id="frm_add_academicterm">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Add Academic Term</h3>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="partyid" value="<?php echo $partyid; ?>"/>
                                    School
                                    <select name="school_id" class="form-control">
                                        <?php
                                            $sch = $this->party->getSchool();
                                            foreach($sch as $s)
                                            {
                                                ?>
                                                <option value="<?php echo $s['id']; ?>"><?php echo $s['firstname']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    Course
                                    <select name="course_id" class="form-control">
                                        <?php
                                            $courses = $this->course->getAllCourse();
                                            foreach($courses as $c)
                                            {
                                                ?>
                                                <option value="<?php echo $c['id']; ?>">
                                                    <?php
                                                        $cour = $this->course->getCourse($c['id']);
                                                        $major = $this->course->getMajor($c['major']);
                                                        echo $cour.' '.$major;
                                                    ?>
                                                </option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                    School Year
                                    <select name="sy_id" class="form-control">
                                        <?php
                                            $sy = $this->academicterm->all();
                                            foreach($sy as $sy1)
                                            {
                                                if($sy1['term'] == '1')
                                                    $sem = 'FIRST SEMESTER';
                                                elseif($sy1['term'] == '2')
                                                    $sem = 'SECOND SEMESTER';
                                                else
                                                    $sem = 'SUMMER CLASS';
                                                ?>
                                                <option value="<?php echo $sy1['id']; ?>"><?php echo $sy1['systart'].'-'.$sy1['syend'].' '.$sem; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <input type="button" id="add_academicterm" class="btn btn-primary pull-right" value="Add Academicterm"/>
                <span class="clearfix"></span>
                <br/>
                <div class="table-responsive" id="academic_wrapper">
                    <?php
                        $result = $this->common->get_school($partyid);
                        foreach ($result as $key => $val):
                            extract($val);
                            $get_terms = $this->common->select_schoolyear($partyid, $school);
                    ?>
                        <table class="table table-bordered no-space">
                            <tr>
                                <td class="tbl-header-main" style="width: 50%;"><strong>SCHOOL: <?php echo $sch; ?></strong></td>
                                <td class="tbl-header-main"><strong>COURSE     : <?php echo $description; ?></strong></td>
                            </tr>
                        </table>
                            <?php
                            foreach ($get_terms as $key => $terms):
                                extract($terms);
                                $sy = $this->common->select_academicterm($academicterm);
                                extract($sy);
                            ?>
                            <table class="table table-bordered no-space" id="tbl_<?php echo 'ac-'.$academicterm.'_sch-'.$school; ?>">
                                <tr>
                                    <td class="tbl-header" style="width: 50%" colspan="2"><strong>School Year: <?php echo $systart . " - " . $syend; ?></strong></td>
                                    <td class="tbl-header" colspan="4"><strong>Term: <?php echo $description; ?> </strong></td>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <td>Subject</td>
                                    <td>Final Grades</td>
                                    <td>Re-Exam</td>
                                    <td>Credit</td>
                                    <?php if ($position != 'Admin-registrar'): ?>
                                    	   <td>Action</td>
                                    <?php endif ?>
                                 
                                </tr>
                                <?php
                                $getenid = $this->common->select_enrolmentid($academicterm, $partyid);
                                foreach ($getenid as $key => $enrolid):
                                    extract($enrolid);
                                    $getsubject = $this->common->get_all_grades($enrolmentid);
                                    foreach ($getsubject as $key => $grade):
                                        extract($grade);
                                        ?>
                                        <tr>
                                            <td><?php echo $code; ?></td>
                                            <td><?php echo $descriptivetitle; ?></td>
                                            <td class="text-right">
                                            <?php                                
                                            	if ($position == "Admin-registrar"): 
                                            ?>
                                            		<label><?php echo $value; ?></label>
                                            <?php else: ?>
                                            	<select class="form-control" name="edit_sub_grade">
                                                    <?php
                                                        $all_grade = $this->grade->getAllGrade();
                                                        foreach($all_grade as $ag)
                                                        {
                                                            if($ag['value'] == $value){
                                                                ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" selected><?php echo $ag['value']; ?></option>
                                                            <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>"><?php echo $ag['value']; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                    ?>
                                                    <?php endif ?>
                                                </select>
                                            </td>
                                            <td> &nbsp; </td>
                                            <td class="tblNum"><?php echo $units; ?></td>
                                            <?php if ($position != 'Admin-registrar'): ?>
                                            	<td><a href="<?php echo $enrolmentid.'-'.$sid; ?>" class="btn btn-link del_sub">Delete</a></td>
                                            <?php endif ?>
                                            
                                        </tr>
                                        <?php endforeach ?>

                                    <?php endforeach ?>

                                    <?php if ($position != 'Admin-registrar'): ?>                               
	                                    <tr>
	                                        <td colspan="6">
	                                            <div class="modal fade" id="myModal<?php echo '_ac-'.$academicterm.'_sch-'.$school; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                                <div class="modal-dialog modal-sm">
	                                                    <div class="modal-content">
	                                                        <form class="frm-add-subj">
	                                                            <div class="modal-header">
	                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                                                <h3 class="modal-title" id="myModalLabel">Add Subject</h3>
	                                                            </div>
	                                                            <div class="modal-body">
	                                                                <input type="hidden" name="partyid" value="<?php echo $partyid; ?>"/>
	                                                                <input type="hidden" name="academictermid" value="<?php echo $academicterm; ?>"/>
	                                                                <input type="hidden" name="enrolmentid" value="<?php echo $enrolmentid; ?>"/>
	                                                                <input type="hidden" name="schoolid" value="<?php echo $school; ?>"/>
	                                                                Subject
	                                                                <select name="add_subj" class="form-control">
	                                                                    <?php
	                                                                        $subj = $this->subject->getAllSubj();
	                                                                        foreach($subj as $sub)
	                                                                        {
	                                                                            ?>
	                                                                            <option value="<?php echo $sub['id']; ?>"><?php echo $sub['code'].' | '.$sub['descriptivetitle']; ?></option>
	                                                                        <?php
	                                                                        }
	                                                                    ?>
	                                                                </select>
	                                                                Grade
	                                                                <select name="sub_grade" class="form-control">
	                                                                    <?php
	                                                                        $g = $this->grade->getAllGrade();
	                                                                        foreach($g as $gg)
	                                                                        {
	                                                                            ?>
	                                                                            <option value="<?php echo $gg['id']; ?>"><?php echo $gg['value']; ?></option>
	                                                                        <?php
	                                                                        }
	                                                                    ?>
	                                                                </select>
	                                                            </div>
	                                                            <div class="modal-footer">
	                                                                <button type="submit" class="btn btn-primary">Save</button>
	                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                                                            </div>
	                                                        </form>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <a href="<?php echo '_ac-'.$academicterm.'_sch-'.$school; ?>" class="btn btn-primary pull-right modal-add-subj-grade"><span class="glyphicon glyphicon-plus"></span> Add Subject</a>
	                                        </td>
	                                    </tr>
 							<?php endif ?>
                                <?php endforeach ?>

                            </table>
                        <?php endforeach ?>
                        <br />
                        <?php 
	                        $getflag = $this->common->theflag($partyid);
                        if ($getflag < 1 AND $position == 'Admin-registrar'): ?>
	                        	<form action="/registrar/insert_flag" method="POST">
		                        	<input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
		                        	<input type="submit" class="btn btn-primary pull-right" value="Confirm" onclick="return confirm('Do you sure?')">        
	                        	</form>
                        <?php endif ?>
                        
              	  </div>
                <!-- /div class table-responsive -->

            <!--</div>-->
            <!-- /div class panel -->
            <?php 
                $this->log_student->insert_not_exists($partyid,'O');
             ?>
		</div>
		</div>
	</div>
</div>