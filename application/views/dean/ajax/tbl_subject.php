<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Subject Code</th>
		<th>Descriptive Title</th>
		<th>Units</th>
		<th>College</th>
		<th>Action</th>
	</tr>
	<?php
		$office     = $this->api->getUserOffice();
		
		if ($office == 3) {
			$this->db->where('own !=', 1);
			$subj = $this->db->get('tbl_subject')->result_array();
		} else {
			$subj = $this->subject->subjectWhere($college);
		}
		
		foreach ($subj as $sub) {
	?>
	<tr>
		<td><?php echo $sub['code']; ?></td>
		<td><?php echo $sub['descriptivetitle']; ?></td>
		<td><?php echo $sub['units']; ?></td>
		<td>
		<?php
			$col = $this->common_dean->getCollege($sub['id']);
			
			if ($col == 0) {
				echo 'Not Been Assigned';
			} else {
				$t = $this->common_dean->getColName($col);
				echo $t;
			}
		 ?>
		</td>
		<td>
		<?php if ($col == 0 OR $col == $college OR $office == 3) { ?>
			<a class="btn btn-success btn-xs btn-block" href="/edit_subject/<?php echo $sub['id']; ?>">
				Edit &nbsp;<span class="glyphicon glyphicon-pencil"></span>
			</a>
			<a class="btn btn-danger btn-xs btn-block delete_subject" data-subjectname="<?php echo $sub['code'].' '.$sub['descriptivetitle']; ?>" data-param="<?php echo $sub['id']; ?>" href="/delete_subject/<?php echo $sub['id']; ?>">
				Delete <span class="glyphicon glyphicon-trash"></span>
			</a>
		<?php } else { ?>
			<a href="/edit_subject/<?php echo $sub['id']; ?>/view" class="btn btn-info btn-xs btn-block">View</a>
		<?php } ?>
		</td>
	</tr>
	<?php } ?>
</table>
