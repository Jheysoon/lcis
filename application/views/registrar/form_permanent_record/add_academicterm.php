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
                            $sch = $this->party->college_school();

                            foreach ($sch as $s) {
                        ?>
                                <option value="<?php echo $s['id']; ?>"><?php echo $s['firstname']; ?></option>
                        <?php } ?>
                    </select>
                    Course
                    <select name="course_id" class="form-control">
                        <?php
                            $courses = $this->course->getAllCourse();

                            foreach ($courses as $c) {
                        ?>
                            <option value="<?php echo $c['id']; ?>">
                                <?php
                                    $cour = $this->course->getCourse($c['id']);
                                    $major = $this->course->getMajor($c['major']);
                                    echo $cour.' '.$major;
                                ?>
                            </option>
                        <?php } ?>
                    </select>
                    School Year
                    <select name="sy_id" class="form-control">
                        <?php
                            $sy = $this->academicterm->all();

                            foreach ($sy as $sy1) {

                                if($sy1['term'] == '1')
                                    $sem = 'FIRST SEMESTER';
                                elseif($sy1['term'] == '2')
                                    $sem = 'SECOND SEMESTER';
                                else
                                    $sem = 'SUMMER CLASS';
                        ?>
                            <option value="<?php echo $sy1['id']; ?>"><?php echo $sy1['systart'].'-'.$sy1['syend'].' '.$sem; ?></option>
                        <?php } ?>
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
