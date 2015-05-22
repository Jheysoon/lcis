<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Student Id</th>
		<th>Student Name</th>
		<th>Course</th>
		<!--<th>
            <select class="form-control" name='Year Level' required>
				<option> THIRD YEAR</option>	
				<option> ALL</option>
				<option> FIRST YEAR</option>	
				<option> SECOND YEAR</option>	
				<option> FOURTH YEAR</option>	
			</select>
		</th>-->
		<th colspan="2">Action</th>
	</tr>

    <?php
        // fetch the records in tbl_enrollment
        $result = $this->enrollment->getStud($param);

        foreach($result as $info)
        {
            extract($info);
            $stud_info = $this->party->getStudInfo($partyid);
            $course = $this->course->getCourse($coursemajor);

                ?>
                <tr>
                    <td><?php echo $stud_info['legacyid']; ?></td>
                    <td><?php echo $stud_info['lastname'] . ' , ' . $stud_info['firstname'] ?></td>
                    <td><?php echo $course; ?></td>
                    <!--<td></td>-->
                         <td>
                            <a class="a-table label label-danger" href="/dean_evaluation/<?php echo $partyid;?>">Evaluate
                             <span class="glyphicon glyphicon-file"></span></a>
                        </td>
                       
                </tr>
            <?php
            //}
        }
    ?>
</table>