<table class="table table-striped table-bordered table-hover">
	<?php $office     = $this->api->getUserOffice(); ?>
	<tr>
		<th>Subject Code</th>
		<th>Descriptive Title</th>
		<th>Units</th>
		<?php if ($office != 3) { ?>
			<th>College</th>
		<?php } ?>
		<th>Action</th>
	</tr>
	<?php
		
		
		if ($office == 3) {
			$subj = $this->db->get_where('tbl_subject')->result_array();
		} else {
			$subj = $this->subject->subjectWhere($college);
		}
		
		foreach ($subj as $sub) {
	?>
	<tr>
		<td><?php echo $sub['code']; ?></td>
		<td><?php echo $sub['descriptivetitle']; ?></td>
		<td><?php echo $sub['units']; ?></td>
		
		<?php if ($office != 3) { ?>
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
		<?php 
			} else {
				$col 		= 0;
				$college 	= 0;
			}
		?>
		
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
