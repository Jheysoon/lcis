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
        $result = $this->student->getStud($param, $col);

        foreach($result as $info)
        {
            extract($info);
            if ($major != 0) {
                $major = $this->student->getMajor($major);
                extract($major);
                $description = $description." (".$des.")";
            }

                ?>
                <tr>
                    <td><?php echo $legacyid; ?></td>
                    <td><?php echo $lastname . ' , ' . $firstname ?></td>
                    <td><?php echo $description; ?></td>
                         <td>
                            <a class="a-table label label-danger" href="/dean_evaluation/<?php echo $legacyid;?>">Evaluate
                             <span class="glyphicon glyphicon-file"></span></a>
                        </td>
                       
                </tr>
            <?php
            //}
        }
    ?>
</table>