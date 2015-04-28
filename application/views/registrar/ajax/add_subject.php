<?php
    $sub = $this->subject->findById($subj);
?>
<tr class="success">
<td><?php echo $sub['code']; ?></td>
<td><?php echo $sub['descriptivetitle']; ?></td>
<td>
    <select class="form-control" name="edit_sub_grade">
        <?php
            $grade = $this->grade->getAllGrade();
            foreach($grade as $g)
            {
                if($grade_user == $g['id']){
                    ?>
                    <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$g['id'].'_enroll-'.$enrolmentid; ?>" selected><?php echo $g['value']; ?></option>
                    <?php
                }
                else{
                    ?>
                    <option value="<?php echo 'stugrade-'.$sid.'_subj-'.$g['id'].'_enroll-'.$enrolmentid; ?>"><?php echo $g['value']; ?></option>
                    <?php
                }
            }
        ?>
    </select>
</td>
<td> &nbsp; </td>
<td class="text-right"><?php echo $sub['units']; ?></td>
    <td><a href="<?php echo $enrolmentid.'-'.$sid; ?>" class="btn btn-link del_sub">Delete</a></td>
</tr>