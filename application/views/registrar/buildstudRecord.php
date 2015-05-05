<?php
	$position = $this->session->userdata('datamanagement');
    
    $result = $this->common->select_student($id);


    // check if there is a record found 
    if(is_array($result))
    {
        extract($result);
          $get_school = $this->common->selectOther($partyid);
          extract($get_school);
          $getElementary = $this->common->selectElem($elementary);
   //     echo $getElementary['elementary'];
           $getSecondary = $this->common->selectSec($secondary);
    //    echo $getSecondary['secondary'];
            $getCollege = $this->common->selectTertiary($primary);
     //   echo $getCollege['primary'];
           
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
            <?php echo $this->session->flashdata('message'); ?>
            <div class="col-md-4">
				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">Student ID 		: </strong>
					<input type="text" class="form-control" value = "<?php echo $legacyid; ?>" disabled style="background-color:white">
				</div>
				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">First Name</strong>
					<input type="text" class="form-control" value="<?php echo $firstname ?>">
				</div>
                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Middle Name</strong>
                    <input type="text" class="form-control" value="<?php echo $middlename ?>">
                </div>
                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Last Name</strong>
                    <input type="text" class="form-control" value="<?php echo $lastname ?>">
                </div>      

                <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Date of Birth</strong>
                            <input  type="date" class="form-control">
                </div>
                 <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Place of Birth</strong>
                            <input type="text" class="form-control">
                </div>


				
				<!-- <div class="col-md-12 pad-bottom-10">
					<strong class="strong">Year Level 		: </strong>
					<strong class="strong">Third Year</strong>
				</div>
				 -->
			</div>
            <div class="col-md-5">
              
                <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Address 1: </strong>
                            <input type="text" class="form-control"><br />
                            <input type="text" class="form-control">
                </div>
                  <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Primary   : </strong>
      
                    <?php if ($position != 'C' or $position != 'B'): ?>
                        <select class="form-control" name="" id="">

                            <option>Select</option>
                            <?php
                                $prim = $this->course->getAllSchool('primary');

                                foreach($prim as $pr)
                                {
                                    if($pr['registrarname'] == $getCollege['primary'])
                                    {
                                    ?>
                                        <option value="<?php echo $pr['id']; ?>" selected><?php echo $pr['firstname']; ?></option>
                                    <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $pr['id']; ?>"><?php echo $pr['firstname']; ?></option>
                                    <?php
                                        }
                                }
                            ?>
                        </select>
                    <?php else:  
                            echo $description; 
                        endif ?>
				</div>

				<!-- <div class="col-md-12 pad-bottom-10">
					<strong class="strong">Year Level 		: </strong>
					<strong class="strong">Third Year</strong>
				</div>
				 -->
			</div>
            <div class="col-md-5">
              <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Date of Birth</strong>
                            <input  type="date" class="form-control">
                </div>
                 <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Place of Birth</strong>
                            <input type="text" class="form-control">
                </div>
                <div class="col-md-12 pad-bottom-10">
                            <strong class="strong">Address : </strong>
                            <input type="text" class="form-control">
                </div>


                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Elementary   : </strong>
      
                    <?php if ($position != 'C' or $position != 'B'): ?>
                        <select class="form-control" name="" id="">
                           <option>Select</option>
                            <?php
                                $elementary = $this->course->getAllSchool('elementary');

                                foreach($elementary as $el)
                                {
                                    if($el['registrarname'] == $getElementary['elementary'])
                                    {
                                    ?>
                                        <option value="<?php echo $el['id']; ?>" selected><?php echo $el['firstname']; ?></option>
                                    <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $el['id']; ?>"><?php echo $el['firstname']; ?></option>
                                    <?php
                                        }
                                }
                            ?>

                    </select>
                <?php else: ?>
                    <?php echo $el['firstname']; ?>
                <?php endif ?>
                </div>

                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">High School :</strong>
                   <?php if ($position != 'C' or $position != 'B'): ?>

                        <select class="form-control" name="" id="">
                           <option>Select</option>
                            <?php
                                $hs = $this->course->getAllSchool('secondary');

                                foreach($hs as $h)
                                {
                                    if($h['registrarname'] == $getSecondary['secondary'])
                                    {
                                    ?>
                                        <option value="<?php echo $h['id']; ?>" selected><?php echo $h['firstname']; ?></option>
                                    <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $h['id']; ?>"><?php echo $h['firstname']; ?></option>
                                    <?php
                                        }
                                }
                            ?>
                    </select>
                <?php else: ?>
                    <?php echo $h['firstname']; ?>
                <?php endif ?>
                </div>

                <div class="col-md-12 pad-bottom-10">
                    <strong class="strong">Course</strong>
                        <?php if ($position != 'C' or $position != 'B'): ?>
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
                 <input type="button" id="add_academicterm" class="btn btn-primary pull-right" value="   Save"/>




            </div>
            <br />
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-new thumbnail" style="width: 170px; height: 150px;">
               <!--  <img data-src="holder.js/100%x100%" alt="..."> -->
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 150px;"></div>
              <div>
                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
	      <div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
            <!-- div class panel -->
            <!--<div class="panel">-->

                <!-- div class table-responsive -->

                <!-- modal add academicterm -->
                <?php if (($position != 'C' or $position != 'B') or $this->session->userdata('status') != 'S'): ?>
                    
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
                <?php endif ?>
                <?php if($this->session->userdata('datamanagement') =='E' AND $this->session->userdata('status') != 'S'){ ?>
                <input type="button" id="add_academicterm" class="btn btn-primary pull-right" value="Add Academicterm"/>
                <span class="clearfix"></span>
                <?php } ?>
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
                                    <td class="tbl-header" colspan="4">
                                        <strong>Term: <?php echo $description; ?> </strong>
                                        <?php 
                                            // get enrollment id
                                            $eid = $this->enrollment->getEnrollId($academicterm,$partyid);
                                         ?>
                                         <?php if ($position == 'C'): ?>
                                            <?php elseif($position == 'B'): ?>
                                            <?php else: ?>
                                                <a href="<?php echo $eid; ?>" params="<?php echo $systart . " - " . $syend.' '.$description; ?>" param="tbl_<?php echo 'ac-'.$academicterm.'_sch-'.$school; ?>" class="btn btn-danger btn-xs pull-right delete_acam">Delete Academicterm</a>
                                         <?php endif ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <td>Subject</td>
                                    <td>Final Grades</td>
                                    <td>Re-Exam</td>
                                    <td>Credit</td>
                                    <?php if (($position != 'C' or $position != 'B') AND $this->session->userdata('status') != 'S'): ?>
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
                                            	if (($position == 'C' or $position == 'B') OR $this->session->userdata('status') == 'S'): 
                                            ?>
                                            		<label><?php echo $value; ?></label>
                                            <?php 
                                                else:
                                                    $style = '';
                                                    if($value == 0.00)
                                                    {
                                                        $style = 'disabled';
                                                    }
                                            ?>
                                            	<select class="form-control" name="edit_sub_grade" <?php echo $style; ?>>
                                                    <?php
                                                        $all_grade = $this->grade->getAllGrade();
                                                        foreach($all_grade as $ag)
                                                        {
                                                            if($ag['id'] == $semgrade){
                                                                ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" selected>
                                                                <?php 
                                                                    if($ag['value']  == 0.00){
                                                                        echo $ag['description'];
                                                                    }
                                                                    else{
                                                                        echo $ag['value'];
                                                                    }
                                                                ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>">
                                                                <?php 
                                                                    if($ag['value']  == 0.00){
                                                                        echo $ag['description'];
                                                                    }
                                                                    else{
                                                                        echo $ag['value'];
                                                                    }
                                                                ?>
                                                                </option>
                                                            <?php
                                                            }
                                                        }
                                                    ?>
                                                    <?php endif ?>
                                                </select>
                                            </td>
                                            <td id="stugrade-<?php echo $sid; ?>">
                                            <?php 
                                                if($value == 0.00) 
                                                {
                                                    $reexam_grade = $this->studentgrade->get_reexam($sid);
                                            ?>
                                            <select class="form-control rexam" name="re-exam">
                                                <?php if($reexam_grade == 0.00){ ?>
                                                <option value="1" selected>
                                                    Select
                                                </option>
                                                <?php } ?>
                                                <?php
                                                    $all_grade = $this->grade->getAllGrade();

                                                    foreach($all_grade as $ag)
                                                    {
                                                        if($ag['value'] != 0.00)
                                                        {
                                                            if($ag['id'] == $reexam_grade)
                                                            {
                                                    ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" selected>
                                                                    <?php echo $ag['value']; ?>
                                                                </option>
                                                    <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>">
                                                                    <?php echo $ag['value']; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <?php } ?>
                                            </td>
                                            <td class="tblNum"><?php echo $units; ?></td>
                                            <?php if (($position != 'C' or $position != 'B') AND $this->session->userdata('status') != 'S'): ?>
                                            	<td><a href="<?php echo $enrolmentid.'-'.$sid; ?>" class="btn btn-link del_sub" param="<?php echo $code; ?>">Delete</a></td>
                                            <?php endif ?>
                                        </tr>
                                        <?php endforeach ?>

                                    <?php endforeach ?>

                                    <?php if ($position != 'C' or $position != 'B'): ?>                               
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
                                                <?php if ($this->session->userdata('status') != 'S' AND ($position != 'C' or $position != 'B')): ?>
                                                    <a href="<?php echo '_ac-'.$academicterm.'_sch-'.$school; ?>" class="btn btn-primary pull-right modal-add-subj-grade"><span class="glyphicon glyphicon-plus"></span> Add Subject</a>
                                                <?php endif ?>
	                                           </td>
	                                    </tr>
 							<?php endif ?>
                                <?php endforeach ?>

                            </table>
                        <?php endforeach ?>
                        <br />
                        <?php 
	                        $getflag = $this->common->theflag($partyid);
                             $status = $this->log_student->getLatestTm($partyid);
                        if ($getflag < 1 AND ($position == 'C' or $position == 'B')):
                           
                            ?>
                            <div class="pull-right">
                                <form action="/registrar/insert_flag" method="POST">
                                    <input type="hidden" name="url" value="<?php echo current_url(); ?>"/>
                                    <input type="hidden" name="tm" value="<?php echo $status; ?>"/>
                                    <input type="hidden" name="flag_status" value="C"/>
                                    <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
                                    <input type="submit" class="btn btn-primary pull-right" value="Confirm" onclick="return confirm('Are you sure?')">
                                </form>
                                <span class="clearfix"></span>
                                <form action="/registrar/insert_flag" method="POST" style="margin-top:5px;">
                                    <input type="hidden" name="flag_status" value="R"/>
                                    <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
                                    <input type="submit" class="btn btn-primary" value="Return to Clerk">
                                </form>
                            </div>
                        <?php elseif($this->session->userdata('status') != 'S'): ?>
                                  <form action="/registrar/insert_flag" method="POST">
                                    <input type="hidden" name="url" value="<?php echo current_url(); ?>"/>
                                    <input type="hidden" name="flag_status" value="S"/>
                                    <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
                                    <input type="submit" class="btn btn-primary pull-right" value="Submit" onclick="return confirm('Are you sure?')">
                                </form>
                        <?php endif ?>
                        
              	  </div>
                <!-- /div class table-responsive -->

            <!--</div>-->
            <!-- /div class panel -->
            <?php
                if($position != 'C' or $position != 'B')
                {
                    $status = $this->party->getStatus($partyid);
                    if($status['status'] != 'E' AND $status['status'] != 'S')
                    {
                        $this->log_student->insert_not_exists($partyid,'O');
                    }   
                }
             ?>
		</div>
		</div>
	</div>
</div>
<?php 
    }
    else
    { 
        ?>
    <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <br/>
        <div class="alert alert-danger" style="text-align:center;">
            <h4>Unable to find student or the student information is unavailable</h4>
        </div>
    </div>
    <?php } ?>