
<?php
    $sch = $this->party->getSchoolById($school);
    $course = $this->course->getCourse($coursemajor);
?>
<table class="table table-bordered no-space">
    <tr>
        <td class="tbl-header-main" style="width: 50%;"><strong>SCHOOL: <?php echo $sch['firstname']; ?></strong></td>
        <td class="tbl-header-main"><strong>COURSE     : <?php echo $course; ?></strong></td>
    </tr>
</table>

<table class="table table-bordered no-space" id="tbl_<?php echo 'ac-'.$academicterm.'_sch-'.$school; ?>">
    <tr>
        <?php
            $sy = $this->academicterm->findById($academicterm);
        ?>
        <td class="tbl-header" style="width: 50%" colspan="2"><strong>School Year: <?php echo $sy['systart'] . " - " . $sy['syend']; ?></strong></td>
        <td class="tbl-header" colspan="4"><strong>Term:
                <?php
                    if($sy['term'] == 1)
                        echo 'FIRST SEMESTER';
                    elseif($sy['term'] == 2)
                        echo 'SECOND SEMESTER';
                    else
                        echo 'SUMMER CLASS';

                ?> </strong></td>
    </tr>
    <tr>
        <td>Code</td>
        <td>Subject</td>
        <td>Final Grades</td>
        <td>Re-Exam</td>
        <td>Credit</td>
        <td>Action</td>
    </tr>
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
                                <input type="hidden" name="partyid" value="<?php echo $student; ?>"/>
                                <input type="hidden" name="academictermid" value="<?php echo $academicterm; ?>"/>
                                <input type="hidden" name="enrolmentid" value="<?php echo $id; ?>"/>
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
</table>