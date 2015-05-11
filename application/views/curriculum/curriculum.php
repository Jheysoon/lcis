
<div class="col-md-2"></div>
    <div class="col-md-9 body-container">

        <div class="panel p-body">
        <div class="panel-heading search">

<table class="table table-striped table-bordered table-hover">
<?php
    
    $curr = $this->common->selectCurr($partyid, $date, $coursemajor);
 ?>
	<tr><!-- 
		<th>Curriculum ID</th>
		<th>Academicterm</th> -->
		<th>Code</th>
		<th>Course</th>
        <th>Year Level</th>
	</tr>
    <?php 
    foreach ($curr as $key => $val): 
        extract($val)
    ?>
        <tr><!-- 
            <td><?php echo $curr; ?></td>
            <td><?php echo $academicterm; ?></td> -->
            <td><?php echo $code ?></td>
            <td><?php echo $descriptivetitle; ?></td>
          <!--   <td><?php echo $course ?></td> -->
            <td><?php echo $yearlevel ?></td>
        </tr>
    <?php endforeach ?>

</table>
</div>
</div>
</div>