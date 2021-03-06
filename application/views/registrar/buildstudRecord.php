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
            <?php
                echo $this->session->flashdata('message');

                if (isset($_SESSION['infos'])) {
                    print_r(extract($_SESSION['infos']));
                   unset($_SESSION['infos']);
                }
             ?>
            <form class="form" action="/registrar/update_studinfo" method="POST">
                <input type="hidden" name ="partyid" value="<?php echo $partyid; ?>">
                <input type="hidden" name="url" value="<?php echo $stud; ?>">
                <div class="col-md-4">
                    <div class="form-group" style="margin-bottom: 24px;">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 170px; height: 150px;">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 150px;"></div>
                            <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
    				<div class="form-group">
    					<label class="control-label">Student ID</label>
    					<input type="text" class="form-control" value = "<?php echo $legacyid; ?>" disabled style="background-color:white">
    				</div>
                    <div class="form-group">
                        <label class="control-label">Date of Birth <small class="required">( required )</small></label>
                        <input  type="date" name="dob" class="form-control datepicker" value="<?php echo $dob; ?>">
                    </div>
                     <div class="form-group">
                        <label class="control-label">Place of Birth <small class="required">( required )</small></label>
                        <input type="text" name="pob" class="form-control" value="<?php echo $pob; ?>">
                    </div>
                     <div class="form-group">
                        <label class="control-label">Date of Registration <small class="required">( required )</small></label>
                        <input  type="date" name="dor" class="form-control datepicker" value="<?php echo (isset($date) ? $date : ''); ?>">
                        <input type="hidden" name="dateregistered" value="<?php echo (isset($date) ? $date : ''); ?>" />
                    </div>
    			</div>
                <div class="col-md-8">

                    <div class="form-group  col-md-6">
                        <label class="control-label">First Name <small class="required">( required )</small></label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>" required>
                    </div>
                    <div class="form-group  col-md-6">
                        <label class="control-label">Middle Name <small class="required">( required )</small></label>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename ?>">
                    </div>
                    <div class="form-group  col-md-6">
                        <label class="control-label">Last Name <small class="required">( required )</small></label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Course <small class="required">( required )</small></label>
                        <?php 
                            $specific = $this->course->specifics($partyid);
                            if ($position != 'C' or $position != 'B'): 
                        ?>
                                <select class="form-control" name="course">
                                <?php
                                    $course = $this->course->allCourse();

                                    foreach ($course as $c) {

                                        if ($c['courseid'] == $specific['courseid']) {
                                            $course_id = $c['courseid'];
                                        }
                                ?>
                                    <option value="<?php echo $c['courseid']; ?>" <?php echo ($c['courseid'] == $specific['courseid']) ? 'selected' : '' ?>><?php echo $c['description']; ?></option>
                                <?php
                                    }

                                    $course = $this->course->allcoursm();
                                    
                                    foreach ($course as $c) {
                                        if ($c['courseid'] == $specific['courseid']) {
                                            $course_id = $c['courseid'];
                                        }
                                        ?>
                                        <option value="<?php echo $c['courseid']; ?>" <?php ($c['courseid'] == $specific['courseid']) ? 'selected' : '' ?>><?php echo $c['description']; ?></option>
                                <?php } ?>
                            </select>
                        <?php else: ?>
                                <?php echo $description; ?>
                        <?php endif ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Address :  <small class="required">( required )</small></label>
                        <input type="text" name="address1" class="form-control" placeholder="primary address" value="<?php echo $address1; ?>">
                    </div>
                    <div class="form-group col-md-6">
                         <label class="control-label"><small class="optional">( optional )</small></label>
                        <input type="text" name="address2"class="form-control" placeholder="secondary address" value="<?php echo $address2; ?>">
                    </div>

                    <div class="form-group col-md-8">
                        <label class="control-label">Primary <small class="required">( required )</small></label>
                        <?php if ($position != 'C' or $position != 'B'): ?>
                            <select class="form-control" name="primary">

                                <option>Select</option>
                                <?php
                                    $prim = $this->course->getAllSchool('primary');

                                    foreach ($prim as $pr) {
                                ?>
                                    <option value="<?php echo $pr['id']; ?>" <?php echo ($pr['firstname'] == $getCollege['primary'] OR $pr['id'] == $primary) ? 'selected' : ''; ?>><?php echo $pr['firstname']; ?></option>
                                <?php } ?>
                            </select>
                        <?php 
                            else:
                                echo $pr['firstname'];
                            endif; 
                        ?>
    				</div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Year <small class="required">( required )</small></label>
                        <select class="form-control" name="primaryyear">
                            <option></option>
                            <?php
                                $x      = date('Y');
                                $loop   = 1950;
                                while ($loop < $x) {
                            ?>
                                <option <?php echo ($getCollege['completionprimary'] == $x OR $x == $completionprimary) ? 'selected' : '' ?>><?php echo $x; ?></option>
                            <?php
                                $x--;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="control-label">Elementary <small class="required">( required )</small></label>
                        <?php if ($position != 'C' or $position != 'B'): ?>
                            <select class="form-control" name="elementary">
                                <option>Select</option>
                                <?php
                                    $elementary = $this->course->getAllSchool('elementary');

                                    foreach ($elementary as $el) {
                                        ?>
                                        <option value="<?php echo $el['id']; ?> "
                                            <?php echo ($el['firstname'] == $getElementary['elementary'] or $el['id'] == $getElementary['id']) ? 'selected' : '' ?>>
                                            <?php echo $el['firstname']; ?>
                                        </option>
                                <?php } ?>
                        </select>
                    <?php else: ?>
                        <?php echo $el['firstname']; ?>
                    <?php endif ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Year <small class="required">( required )</small></label>
                        <select class="form-control" name = "elementaryyear">
                            <option></option>
                            <?php
                                $x      = date('Y');
                                $loop   = 1950;
                                while ($loop < $x) { 
                            ?> 
                                <option <?php echo ($getElementary['completionelementary'] == $x OR $x == $completionelementary) ? 'selected' : '' ?>><?php echo $x; ?></option>
                            <?php
                                $x--;
                                } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-8" >
                        <label class="control-label">High School <small class="required">( required )</small></label>
                       <?php if ($position != 'C' or $position != 'B'): ?>
                        <select class="form-control" name="highschool" id="">
                            <option>Select</option>
                            <?php
                                $hs = $this->course->getAllSchool('secondary');

                                foreach ($hs as $h) {
                            ?>
                                <option value="<?php echo $h['id']; ?>" <?php echo ($h['firstname'] == $getSecondary['secondary'] OR $h['id'] == $secondary) ? 'selected' : '' ?>><?php echo $h['firstname']; ?></option>
                            <?php } ?>
                        </select>
                    <?php else: ?>
                        <?php echo $h['firstname']; ?>
                    <?php endif ?>
                    </div>
                    <div class="from-group col-md-4">
                        <label class="control-label">Year <small class="required">( required )</small></label>
                        <select class="form-control" name="highschoolyear" id="academic_wrapper">
                            <option></option>
                            <?php
                                $x = date('Y');
                                $loop = 1950;

                                while ($loop < $x) {
                                    if ($getSecondary['completionsecondary'] == $x or $x == $completionsecondary):
                            ?>
                               <option selected><?php echo $x; ?></option>
                               <?php else: ?>
                                <option><?php echo $x; ?></option>
                                <?php endif ?>

                                <?php
                                  $x--;
                                } ?>
                        </select>
                    </div>
                <?php if (($position != 'E' or $position != 'B') AND $this->session->userdata('status') != 'S'): ?>
                    <div class="col-md-12">
                    <br/>
                        <input type="submit" class="btn btn-primary pull-right" value="   Save"/>
                        <a class="btn btn-primary pull-right" href="/lc_curriculum/viewcurriculum/<?php echo $partyid ?>" target="_blank" style="margin-right:10px">View Curriculum</a>
                    </div>
                <?php endif ?>
                </div>
            </form>


	    <div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
            <!-- div class panel -->
            <!--<div class="panel">-->

                <!-- div class table-responsive -->

                <!-- modal add academicterm -->
                <?php
                    echo $this->session->flashdata('message1');

                    if (($position != 'C' OR $position != 'B') OR $this->session->userdata('status') != 'S'):

                        // add academicterm modal
                        $this->load->view('registrar/form_permanent_record/add_academicterm', array('partyid' => $partyid));
                    endif;

                    if ($this->session->userdata('datamanagement') =='E' AND $this->session->userdata('status') != 'S') {
                ?>
                    <input type="button" data-toggle="modal" data-target="#modal_add_schools" value="Add Schools" class="btn btn-primary">
                    <input type="button" data-toggle="modal" data-target="#modal_add_subjects" value="Add Other School Subjects" class="btn btn-primary">
                    <input type="button" id="add_academicterm" class="btn btn-primary pull-right" value="Add Academicterm"/>
                    <span class="clearfix"></span>
                <?php } ?>
                <br/>


                <?php
                    $this->load->view('registrar/form_permanent_record/add_other_subjects', array('id' => $stud));
                    $this->load->view('registrar/form_permanent_record/add_school', array('id' => $stud));
                 ?>



                <div class="table-responsive">
                <?php
                    if (is_array($result)) {
                        $result = $this->common->get_school($partyid);
                        foreach ($result as $key => $val):
                            extract($val);
                            $get_terms = $this->common->select_schoolyear($partyid, $school);
                ?>
                        <table class="table table-bordered no-space">
                            <tr>
                                <td class="tbl-header-main" style="width: 50%;"><label>SCHOOL: <?php echo $sch; ?></label></td>
                                <td class="tbl-header-main"><label>COURSE     : <?php echo $description; ?></label></td>
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
                                    <td class="tbl-header" style="width: 50%" colspan="2"><label>School Year: <?php echo $systart . " - " . $syend; ?></label></td>
                                    <td class="tbl-header" colspan="4">
                                        <label>Term: <?php echo $description; ?> </label>
                                        <?php
                                            // get enrollment id
                                            $eid = $this->enrollment->getEnrollId($academicterm, $partyid);
                                            if ($position == 'C'): 
                                            elseif ($position == 'B' OR $this->session->userdata('status') == 'S'):
                                            else:
                                        ?>
                                            <a href="<?php echo $eid; ?>" params="<?php echo $systart . " - " . $syend.' '.$description; ?>" param="tbl_<?php echo 'ac-'.$academicterm.'_sch-'.$school; ?>" class="btn btn-danger btn-xs pull-right delete_acam">Delete Academicterm</a>
                                         <?php endif ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <td>Descriptivetitle</td>
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
                                            <?php if (($position == 'C' or $position == 'B') OR $this->session->userdata('status') == 'S'): ?>
                                            		<label><?php echo $value; ?></label>
                                            <?php else: ?>
                                            	<select class="form-control" name="edit_sub_grade" <?php echo ($value == 0.00 AND $remarks != 'NO GRADE') ? 'disabled' : '' ?>>
                                                    <?php
                                                        $all_grade = $this->grade->getAllGrade();

                                                        foreach ($all_grade as $ag) {
                                                            ?>
                                                            <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" <?php echo ($ag['id'] == $semgrade) ? 'selected' : '' ?>>
                                                            <?php
                                                                if ($ag['value']  == 0.00)
                                                                    echo $ag['description'];
                                                                else
                                                                    echo $ag['value'];
                                                            ?>
                                                            </option>
                                                        <?php
                                                        }
                                                endif;
                                            ?>
                                                </select>
                                            </td>
                                            <td id="stugrade-<?php echo $sid; ?>">
                                            <?php
                                                $reexam_grade = '';
                                                if ($value == 0.00 AND $remarks != 'NO GRADE') {
                                                    $reexam_grade = $this->studentgrade->get_reexam($sid);
                                            ?>
                                            <select class="form-control rexam" name="re-exam">
                                                <?php if ($reexam_grade == 0.00) { ?>
                                                <option value="1" selected>
                                                    Select
                                                </option>
                                                <?php }
                                                    $all_grade = $this->grade->getAllGrade();

                                                    foreach ($all_grade as $ag) {

                                                        if ($ag['value'] != 0.00 OR ($ag['value'] == 0.00 AND $ag['description'] == 'NO GRADE')) {
                                                    ?>
                                                        <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>" <?php echo ($ag['id'] == $reexam_grade) ? 'selected' : '' ?>>
                                                            <?php
                                                              if ($ag['value'] == 0.00)
                                                                echo $ag['description'];
                                                              else
                                                                echo $ag['value'];
                                                            ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <?php } ?>
                                            </td>
                                            <td class="tblNum" style="text-align:center;"><?php echo (($value == 0.00 OR $value > 3.00) AND $reexam_grade == 0.00) ? '0' : $units; ?></td>
                                            <?php if (($position != 'C' or $position != 'B') AND $this->session->userdata('status') != 'S'): ?>
                                            	<td><a href="<?php echo $enrolmentid.'-'.$sid; ?>" class="btn btn-link del_sub" param="<?php echo $code; ?>">Delete</a></td>
                                            <?php endif ?>
                                        </tr>
                                        <?php endforeach ?>

                                    <?php endforeach ?>

                                    <?php if ($position != 'C' or $position != 'B'): ?>
	                                    <tr>
	                                        <td colspan="6">
                                                <?php
                                                    $data['academicterm']   = $academicterm;
                                                    $data['school']         = $school;
                                                    $data['partyid']        = $partyid;
                                                    $data['enrolmentid']    = $enrolmentid;

                                                    // adding subject modal
                                                    $this->load->view('registrar/form_permanent_record/add_subject', $data);

                                                    if ($this->session->userdata('status') != 'S' AND ($position != 'C' or $position != 'B')):
                                                ?>
                                                        <a href="<?php echo '_ac-'.$academicterm.'_sch-'.$school; ?>" class="btn btn-primary pull-right modal-add-subj-grade">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                            Add Subject
                                                        </a>
                                                <?php endif ?>
	                                           </td>
	                                    </tr>
							<?php endif ?>
                                <?php endforeach ?>
                            </table>
                        <?php endforeach ?>
                        <br />
                        <?php
                    }
                            if (!is_array($result)) {
                                $partyid = $id;
                            }

                            $status             = $this->log_student->getLatestTm($partyid);
                            $param['status']    = $status;
                            $param['partyid']   = $partyid;
                            $param['position']  = $position;

                            // insert flag form
                            $this->load->view('registrar/form_permanent_record/insert_flag', $param);
                        ?>
            	  </div>
                <!-- /div class table-responsive -->

            <!--</div>-->
            <!-- /div class panel -->
            <?php
                if (!is_array($result)) {
                    $partyid = $id;
                }

                if ($position != 'C' or $position != 'B') {
                    $status = $this->party->getStatus($partyid);

                    if ($status['status'] != 'E' AND $status['status'] != 'S') {
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
