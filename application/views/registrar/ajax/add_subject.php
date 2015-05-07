<?php
    $sub = $this->subject->findById($subj);
?>
<tr class="success">
<td><?php echo $sub['code']; ?></td>
<td><?php echo $sub['descriptivetitle']; ?></td>
<td>
    <?php 
        $val1 = $this->grade->get_where($grade_user);
        $val = $val1['value'];
        $style = '';
        if($val == 0.00)
        {
            $style = 'disabled';
        }
     ?>
    <select class="form-control" name="edit_sub_grade" <?php echo $style; ?>>
        <?php
            $grade = $this->grade->getAllGrade();
            foreach($grade as $g)
            {
                if($grade_user == $g['id']){
                    ?>
                    <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$g['id'].'_enroll-'.$enrolmentid; ?>" selected>
                    <?php
                        if($g['value'] == 0.00)
                            echo $g['description'];
                        else
                            echo $g['value']; 
                    ?>
                    </option>
                    <?php
                }
                else{
                    ?>
                    <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$g['id'].'_enroll-'.$enrolmentid; ?>">
                    <?php
                        if($g['value'] == 0.00)
                            echo $g['description'];
                        else
                            echo $g['value']; 
                    ?>
                    </option>
                    <?php
                }
            }
        ?>
    </select>
</td>
<td>
<?php 
    $value1 = $this->grade->get_where($grade_user);
    $value = $value1['value'];
    if($value == 0.00) 
    {
        $reexam_grade = $this->studentgrade->get_reexam($sid);
?>
<select class="form-control rexam" name="re-exam">
    <option value="1" selected>
        Select
    </option>
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
<td class="text-right"><?php echo $sub['units']; ?></td>
    <td><a href="<?php echo $enrolmentid.'-'.$sid; ?>" class="btn btn-link del_sub">Delete</a></td>
</tr>