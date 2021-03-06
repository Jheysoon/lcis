<div class="col-md-3"></div>
<div class="col-md-9">
    <div class="panel p-body">
        <div class="panel-heading search">
        <div class="col-md-12">
            <div class="col-md-6">
                <h4>Shiftee</h4>
            </div>
        </div>
        </div>
        <div class="panel-body">
                <form class="form-horizontal add-user" method="post" action="/registrar/shiftee_form" role="form">
                <br><h3 class="col-sm-offset-1">Student Information</h3><hr><br>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-1">
                        <label class="label-control add-label2">Student ID</label>
                        <label class="form-control"><?php echo $legacyid; ?></label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo $lastname == '' ? set_value('lastname'):$lastname ?>" name="lastname" placeholder="Lastname" required>
                        <label class="label-control add-label2" for="firstname">First Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo $firstname == '' ? set_value('firstname'):$firstname ?>" name="firstname" placeholder="First Name" required>
                        <label class="label-control add-label2" for="middlename">Middle Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo $middlename == '' ? set_value('middlename'):$middlename ?>" name="middlename" placeholder="Middle Name" required>
                        <br>
						<hr>
                        <br>
                        <label class="label-control add-label" for="course">Course With Major<small class="required">(required)</small></label>
                        <select class="form-control" name='course' required>
                            <?php 
                                $coursemajors = $this->db->get('tbl_coursemajor')->result();
                                
                                foreach ($coursemajors as $coursemajor) {
                            ?>
                                <option value="<?php echo $coursemajor->id ?>" <?php echo ($course != 0 AND $coursemajor->id == $course) ? 'selected' : '' ?>>
                                    <?php echo $this->api->getCourseMajor($coursemajor->id) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-1">
                        <label class="label-control add-label" for="yearlevel">Year Level <small class="required">(required)</small></label>
                        <select class="form-control" name='yearlevel' required>
                            <option> First Year</option>
                            <option> Second Year</option>
                            <option> Third Year</option>
                            <option> Fourth Year</option>
                        </select>
                    </div>
                    <div class="col-sm-offset-1 col-sm-8"><hr class="hr-bottom"></div>
                </div> -->
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-1">
                      <button type="submit" class="btn btn-success">Save</button>
                      <a href="index.php?page=addStudent" class="btn btn-warning">Clear</a>
                    </div>
                  </div>
            </form>
        </div>
    </div>
</div>

</div>
