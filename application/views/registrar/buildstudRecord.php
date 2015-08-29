<?php
    $stud = $id;
	$position = $this->session->userdata('datamanagement');

    $result = $this->common->select_student($id);


    // check if there is a record found

    //@todo: check first before extract function
    if(is_array($result))
    {
        extract($result);
        $p          = $partyid;
        $get_school = $this->common->selectOther($partyid);
        extract($get_school);
        $getElementary  = $this->common->selectElem($elementary, $p);
        $getSecondary   = $this->common->selectSec($secondary, $p);
        $getCollege     = $this->common->selectTertiary($primary, $p);
    }
    else
    {
        $res = $this->party->getInfo($id);
        extract($res);
        $p          = $id;
        $partyid    = $id;
        $get_school = $this->common->selectOther($res['id']);
        extract($get_school);
        $getElementary  = $this->common->selectElem($elementary, $p);
        $getSecondary   = $this->common->selectSec($secondary, $p);
        $getCollege     = $this->common->selectTertiary($primary, $p);
    }

?>
<input type="hidden" name="uri" value="<?php echo uri_string(); ?>">
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
            <?php
                if (isset($_SESSION['infos'])) {
                    print_r(extract($_SESSION['infos']));
                   unset($_SESSION['infos']);
                }

             ?>
            <form action="/registrar/update_studinfo" method="POST">
                <input type="hidden" name ="partyid" value="<?php echo $partyid; ?>">
                <input type="hidden" name="url" value="<?php echo $stud; ?>">
                <div class="col-md-4">
    				<div class="col-md-12 pad-bottom-10">
    					<strong class="strong">Student ID</strong>
    					<input type="text" class="form-control" value = "<?php echo $legacyid; ?>" disabled style="background-color:white">
    				</div>
    				<div class="col-md-12 pad-bottom-10">
    					<strong class="strong">First Name</strong>
    					<input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>" required>
    				</div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Middle Name</strong>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename ?>">
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Last Name</strong>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>" required>
                    </div>

                    <div class="col-md-12 pad-bottom-10">
                                <strong class="strong">Date of Birth</strong>
                                <input  type="date" name="dob" class="form-control datepicker" value="<?php echo $dob; ?>">
                    </div>
                     <div class="col-md-12 pad-bottom-10">
                                <strong class="strong">Place of Birth</strong>
                                <input type="text" name="pob" class="form-control" value="<?php echo $pob; ?>">
                    </div>



    				<!-- <div class="col-md-12 pad-bottom-10">
    					<strong class="strong">Year Level 		: </strong>
    					<strong class="strong">Third Year</strong>
    				</div>
    				 -->
    			</div>
                <div class="col-md-5">

                    <div class="col-md-12 pad-bottom-10">

                                <strong class="strong">Address : </strong>
                                <input type="text" name="address1" class="form-control" value="<?php echo $address1; ?>">
                                <input type="text" name="address2"class="form-control" value="<?php echo $address2; ?>">

                    </div>
                      <div class="col-md-9 pad-bottom-10">
                        <strong class="strong">Primary</strong>
                        <?php if ($position != 'C' or $position != 'B'): ?>
                            <select class="form-control" name="primary">

                                <option>Select</option>
                                <?php
                                    $prim = $this->course->getAllSchool('primary');

                                    foreach($prim as $pr)
                                    {
                                        if($pr['firstname'] == $getCollege['primary'] or $pr['id'] == $primary)
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
                                echo $pr['firstname'];
                            endif ?>
    				</div>
                    <div class="col-md-3">
                          <strong class="strong">Year</strong>
                          <select class="form-control" name="primaryyear">
                              <option></option>
                                  <?php
                                  $x = date('Y');
                                  $loop = 1950;
                                   while ($loop < $x) { ?>

                                   <?php if ($getCollege['completionprimary'] == $x or $x == $completionprimary): ?>
                                       <option selected><?php echo $x; ?></option>
                                   <?php else: ?>
                                        <option ><?php echo $x; ?></option>
                                   <?php endif ?>
                                 <?php
                                  $x--;
                                 } ?>
                          </select>
                     </div>
    			</div>
                <div class="col-md-5">
                    <div class="col-md-9 pad-bottom-10">
                        <strong class="strong">Elementary</strong>
                        <?php if ($position != 'C' or $position != 'B'): ?>
                            <select class="form-control" name="elementary">
                               <option>Select</option>
                                <?php
                                    $elementary = $this->course->getAllSchool('elementary');
                                    foreach($elementary as $el)
                                    {
                                        if($el['firstname'] == $getElementary['elementary'] or $el['id'] == $elementaryss)
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
                     <div class="col-md-3">
                          <strong class="strong">Year</strong>
                          <select class="form-control" name = "elementaryyear">
                              <option></option>
                                  <?php
                                  $x = date('Y');
                                  $loop = 1950;
                                   while ($loop < $x) { ?>
                                   <?php if ($getElementary['completionelementary'] == $x or $x == $completionelementary): ?>
                                       <option selected><?php echo $x; ?></option>
                                   <?php else: ?>
                                        <option><?php echo $x; ?></option>
                                   <?php endif ?>

                                 <?php
                                  $x--;
                                 } ?>
                          </select>
                     </div>
                    <div class="col-md-9 pad-bottom-10">
                        <strong class="strong">High School</strong>
                       <?php if ($position != 'C' or $position != 'B'): ?>
                            <select class="form-control" name="highschool" id="">
                               <option>Select</option>
                                <?php
                                    $hs = $this->course->getAllSchool('secondary');
                                    foreach($hs as $h)
                                    {
                                        if($h['firstname'] == $getSecondary['secondary'] or $h['id'] == $secondary)
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
                     <div class="col-md-3">
                          <strong class="strong">Year</strong>
                          <select class="form-control" name="highschoolyear">
                              <option></option>
                                  <?php
                                  $x = date('Y');
                                  $loop = 1950;
                                   while ($loop < $x) { ?>
                                   <?php if ($getSecondary['completionsecondary'] == $x or $x == $completionsecondary): ?>
                                       <option selected><?php echo $x; ?></option>
                                       <?php else: ?>
                                        <option><?php echo $x; ?></option>
                                   <?php endif ?>

                                 <?php
                                  $x--;
                                 } ?>
                          </select>
                     </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Course</strong>
                        <?php   $specific = $this->course->specifics($partyid);
                                   echo  $specific['courseid']; ?>
                            <?php if ($position != 'C' or $position != 'B'): ?>
                                <select class="form-control" name="course">
                                <?php
                                    $course = $this->course->allCourse();
                                    foreach($course as $c)
                                    {
                                        if($c['courseid'] == $specific['courseid'])
                                        {
                                            $course_id = $c['courseid'];
                                        ?>
                                            <option value="<?php echo $c['courseid']; ?>" selected><?php echo $c['description']; ?></option>
                                        <?php
                                           }
                                            else
                                            {
                                            ?>
                                                <option value="<?php echo $c['courseid']; ?>"><?php echo $c['description']; ?></option>
                                        <?php
                                            }
                                    }
                                ?>
                                 <?php
                                    $course = $this->course->allcoursm();
                                    foreach($course as $c)
                                    {
                                        if($c['courseid'] == $specific['courseid'])
                                        {
                                            $course_id = $c['courseid'];
                                        ?>
                                            <option value="<?php echo $c['courseid']; ?>" selected><?php echo $c['description']; ?></option>
                                        <?php
                                           }
                                            else
                                            {
                                            ?>
                                                <option value="<?php echo $c['courseid']; ?>"><?php echo $c['description']; ?></option>
                                        <?php
                                            }
                                    }
                                ?>
                            </select>
                        <?php else: ?>
                                <?php echo $description; ?>
                        <?php endif ?>
                    </div>
                     <div class="col-md-12 pad-bottom-10">
                                <strong class="strong">Date of Registration</strong>
                                <input  type="date" name="dor" class="form-control datepicker" value="<?php echo $date; ?>">
                                <input type="hidden" name="dateregistered" value="<?php echo $date; ?>" />
                    </div>
                <?php if (($position != 'E' or $position != 'B') AND $this->session->userdata('status') != 'S'): ?>
                    <input type="submit" class="btn btn-primary pull-right" value="   Save"/> <br />
                        <a class="btn btn-primary pull-right" href="/lc_curriculum/viewcurriculum/<?php echo $partyid ?>/<?php echo $date; ?>/<?php echo $coursemajor; ?>" target="_blank" style="margin-right:10px">View Curriculum</a>

                <?php endif ?>
                </div>

                <br />
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 170px; height: 150px;">
<!--
                    <img src="assets/images/sample.jpg" alt="..."> -->
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
                </div>


            </form>


	      <div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
            <!-- div class panel -->
            <!--<div class="panel">-->

                <!-- div class table-responsive -->

                <!-- modal add academicterm -->
                <?php if (($position != 'C' OR $position != 'B') OR $this->session->userdata('status') != 'S'): ?>

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
                <?php if(is_array($result)){ ?>
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
                                            <?php elseif($position == 'B' OR $this->session->userdata('status') == 'S'): ?>
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
                                                    if($value == 0.00 AND $remarks != 'NO GRADE')
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
                                                if($value == 0.00 AND $remarks != 'NO GRADE')
                                                {
                                                    $reexam_grade = $this->studentgrade->get_reexam($sid);
                                            ?>
                                            <select class="form-control rexam" name="re-exam">
                                                <?php if($reexam_grade == 0.00){ ?>
                                                <option value="1" selected>
                                                    Select
                                                </option>
                                                <?php }
                                                    $all_grade = $this->grade->getAllGrade();

                                                    foreach($all_grade as $ag)
                                                    {
                                                        if($ag['value'] != 0.00 OR ($ag['value'] == 0.00 AND $ag['description'] == 'NO GRADE'))
                                                        {
                                                            if($ag['id'] == $reexam_grade)
                                                            {
                                                    ?>
                                                                <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" selected>
                                                                    <?php
                                                                      if ($ag['value'] == 0.00) {
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
                                                                      if ($ag['value'] == 0.00) {
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
	                                                                <label>Subject</label><br/>
                                                                    <input type="text" class="form-control" id="add_subj" style="width:250px;" name="add_subj" value="" placeholder="Type subject descriptive title or code">
	                                                                <br/>Grade<br/>
	                                                                <select name="sub_grade" class="form-control">
	                                                                    <?php
	                                                                        $g = $this->grade->getAllGrade();
	                                                                        foreach($g as $gg)
	                                                                        {
	                                                                            ?>
	                                                                            <option value="<?php echo $gg['id']; ?>">
                                                                                    <?php
                                                                                        if($gg['value']  == 0.00){
                                                                                            echo $gg['description'];
                                                                                        }
                                                                                        else{
                                                                                            echo $gg['value'];
                                                                                        }
                                                                                    ?>
                                                                                </option>
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
                        <?php }
                            if(!is_array($result))
                            {
                                $partyid = $id;
                            }
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
                if(!is_array($result))
                {
                    $partyid = $id;
                }
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
    //}
    //else
    //{
        ?>
    <!-- <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <br/>
        <div class="alert alert-danger" style="text-align:center;">
            <h4>Unable to find student or the student information is unavailable</h4>
        </div>
    </div> -->
    <?php //} ?>
