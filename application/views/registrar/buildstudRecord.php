<?php
    //1999-00344-1 duplicate subj.
	$position = 'Admin-registrar';
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
                        <select name="" id="">
                            <?php
                                $course = $this->course->getAllCourse();

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
				</div>

				<!-- <div class="col-md-12 pad-bottom-10">
					<strong class="strong">Year Level 		: </strong>
					<strong class="strong">Third Year</strong>
				</div>
				 -->
			</div>


				<!-- <div class="col-md-12 pad-bottom-10">
					<strong class="strong">Elementary 	: </strong>
					<strong class="strong">TACLOBAN ELEMENTARY School 	23 March 2008</strong>
				</div>

				<div class="col-md-12 pad-bottom-10">
					<strong class="strong">High School :</strong>
					<strong class="strong">TACLOBAN NATIONAL HIGH SCHOOL 	23 April 2012</strong>
				</div> -->

		<div class="col-md-12"><hr class="hr-middle"></div>
		<div class="col-md-12">
            <!-- div class panel -->
            <!--<div class="panel">-->

                <!-- div class table-responsive -->
                <div class="table-responsive">
                    <?php
                        $result = $this->common->get_school($partyid);
                        foreach ($result as $key => $val):
                            extract($val);
                            $get_terms = $this->common->select_schoolyear($partyid, $school);
                    ?>
                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 50%;"><strong>SCHOOL: <?php echo $sch; ?></strong></td>
                                <td><strong>COURSE     : <?php echo $description; ?></strong></td>
                            </tr>
                        </table>
                            <?php
                            foreach ($get_terms as $key => $terms):
                                extract($terms);
                                $sy = $this->common->select_academicterm($academicterm);
                                extract($sy);
                            ?>
                            <table class="table table-bordered" id="tbl_<?php echo 'ac-'.$academicterm.'_sch-'.$school; ?>">
                                <tr>
                                    <td style="width: 50%" colspan="2"><strong>School Year: <?php echo $systart . " - " . $syend; ?></strong></td>
                                    <td colspan="4"><strong>Term: <?php echo $description; ?> </strong></td>
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
                                                                <option value="<?php echo 'en-'.$enrolmentid.'_sc-'.$school.'_ac-'.$academicterm.'_subj-'.$ag['id']; ?>" selected><?php echo $ag['value']; ?></option>
                                                            <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <option value="<?php echo 'en-'.$enrolmentid.'_sc-'.$school.'_ac-'.$academicterm.'_subj-'.$ag['id']; ?>"><?php echo $ag['value']; ?></option>
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
                                            	<td><a href="#" class="btn btn-link">Delete</a></td>
                                            <?php endif ?>
                                            
                                        </tr>

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
                            <br/>
                            <?php endforeach ?>
                        <?php endforeach ?>
                        <?php 
                        $getflag = $this->common->theflag($partyid);
                        extract($getflag);
                        if ($flag != 1): ?>
	                        	<form action="/registrar/insert_flag" method="POST">
		                        	<input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
		                        	<!-- DRI NAPADAUN -->
		                        	<input type="submit" class="btn btn-primary pull-right" value="Confirm" onclick="return confirm('Do you sure?')">        
	                        	</form>
                        <?php endif ?>
                        
              	  </div>
                <!-- /div class table-responsive -->

            <!--</div>-->
            <!-- /div class panel -->
		</div>
		</div>
	</div>
</div>