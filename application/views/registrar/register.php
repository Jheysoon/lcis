<div class="col-md-3"></div>
<div class="col-md-9">
    <div class="panel p-body">
        <div class="panel-heading search">
            <div class="col-md-12">
                <div class="col-md-6">
                    <h4>Student Registration</h4>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php echo $error ?>
            <form action="/register" method="post">
                <br><h3 class="col-sm-offset-1">Student Information</h3><hr><br>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-1">
                        <label class="label-control add-label2" for="lastname">Student ID <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo set_value('student_id') ?>" name="student_id" placeholder="Student ID" required>
                        <label class="label-control add-label2" for="lastname">Last Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo set_value('lastname') ?>" name="lastname" placeholder="Lastname" required>
                        <label class="label-control add-label2" for="firstname">First Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo set_value('firstname') ?>" name="firstname" placeholder="First Name" required>
                        <label class="label-control add-label2" for="middlename">Middle Name <small class="required">(required)</small></label>
                        <input class="form-control" type="text" value="<?php echo set_value('middlename') ?>" name="middlename" placeholder="Middle Name" required>
                        <br>
                        <hr>
                        <br>
                        <label class="label-control add-label" for="course">Course <small class="required">(required)</small></label>

                        <select class="form-control" name='course' required>
                            <?php
                                $c = $this->db->get('tbl_course')->result_array();

                                foreach ($c as $val) :
                            ?>
                                <option value="<?php echo $val['id']; ?>" <?php echo set_select('course', $val['id']) ?>><?php echo $val['description']; ?></option>
                            <?php
                                endforeach;
                             ?>
                        </select>
                    </div>
                    <div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">Major <small class="optional">(optional)</small></label>
							<select class="form-control" name='major'>
								<?php $m = $this->db->get('tbl_major')->result_array(); ?>
								 <option value="0" <?php set_select('major', 0, TRUE); ?>>Select major</option>

								 <?php foreach ($m as $major) { ?>
									 <option value="<?php echo $major['id'] ?>" <?php echo set_select('major', $major['id']) ?>><?php echo $major['description'] ?></option>
								<?php } ?>

							</select>
						</div>
					</div>
                    <div class="form-group">
						<div class="col-sm-8 col-sm-offset-1">
							<label class="label-control add-label" for="major">School Year (first enrolled) <small class="required">(required)</small></label>
							<select class="form-control" name='academicterm' required>
								<?php
                                    $this->db->order_by('systart', 'ASC');
                                    $this->db->order_by('term', 'ASC');
                                    $academicterms = $this->db->get('tbl_academicterm')->result_array();
                                ?>

								 <?php
                                    foreach ($academicterms as $academicterm) {
                                        if ($academicterm['term'] == 3)
                                            $term = 'Summer';
                                        else
                                            $term = $academicterm['term'];
                                ?>
									 <option value="<?php echo $academicterm['id'] ?>" <?php echo set_select('academicterm', $academicterm['id']) ?>><?php echo $academicterm['systart'].'-'.$academicterm['syend'].' Term: '.$term ?></option>
								<?php } ?>

							</select>
                            <br>
                            <input type="submit" name="name" class="btn btn-primary pull-right" value="Submit">
						</div>
                        <span class="clearfix"></span>
					</div>
                </div>
            </form>
        </div>
    </div>
</div>