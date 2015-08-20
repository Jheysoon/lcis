<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Student Id</th>
		<th>Student Name</th>
		<th>Course</th>
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
							<?php if ($stat == 99 && ($phase == 1 || $phase == 5)): ?>
	                            <a class="a-table label label-danger" href="/dean_evaluation/<?php echo $legacyid;?>">Evaluate
	                             <span class="glyphicon glyphicon-file"></span></a>
							<?php else: ?>
	                            <a class="a-table label label-default" href="">Evaluate
	                             <span class="glyphicon glyphicon-file"></span></a>
							<?php endif; ?>
                        </td>

                </tr>
            <?php
            //}
        }
    ?>
</table>
