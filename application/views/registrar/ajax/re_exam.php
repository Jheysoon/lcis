<select class="form-control rexam" name="re-exam">
    <option value="1" selected>
        Select
    </option>
    <?php
        $all_grade = $this->grade->getAllGrade();

        foreach($all_grade as $ag)
        {
    ?>
            <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$ag['id'].'_enroll-'.$enrolmentid; ?>">
                <?php echo $ag['value']; ?>
            </option>
    <?php
        }
    ?>
</select>