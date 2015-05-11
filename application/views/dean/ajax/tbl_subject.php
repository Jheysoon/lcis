<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Subject Code</th>
		<th>Descriptive Title</th>
		<th>Units</th>
		<th>Action</th>
	</tr> 
	<?php 
		$subj = $this->subject->subjectWhere($param);
		foreach($subj as $sub)
		{
	?>
	<tr>
		<td><?php echo $sub['code']; ?></td>
		<td>ENGLISH ENRICHMENT</td>
		<td>3</td>
		<td><a class="a-table label label-info" href="index.php?page=editSubject">Edit<span class="glyphicon glyphicon-pencil"></span></a>
			<a class="a-table label label-danger" href="index.php?page=deleteSchool">Delete <span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>
	<?php
		}
	 ?>
													

</table>