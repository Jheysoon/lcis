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
                    <select class="form-control" name="add_subj">
                        <?php
                            $this->db->where('own', $school);
                            $s = $this->db->get('tbl_subject')->result();
                            foreach ($s as $subject) {
                        ?>
                            <option value="<?php echo $subject->id ?>"><?php echo $subject->code.' | '.$subject->descriptivetitle ?></option>
                        <?php } ?>
                    </select>
                    <br/>Grade<br/>
                    <select name="sub_grade" class="form-control">
                        <?php
                            $g = $this->grade->getAllGrade();
                            
                            foreach ($g as $gg) {
                        ?>
                                <option value="<?php echo $gg['id']; ?>">
                                    <?php
                                        if ($gg['value']  == 0.00) {
                                            echo $gg['description'];
                                        } else {
                                            echo $gg['value'];
                                        }
                                    ?>
                                </option>
                        <?php } ?>
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