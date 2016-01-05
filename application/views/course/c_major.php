	<div class="col-md-3"></div>
	<?php 
		$college_id = $this->coursemajormd->get_colleges($cid);
	 ?>	
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<div class="col-md-6">
						<h4>Course</h4>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
				<?php echo $this->session->flashdata('messages') ?>
					<form class="form-horizontal" method="post" action="/insert_course">
						<input type="hidden" value="<?php echo $cid ?>" name="cid">
						<div class="col-md-6" style="padding:0">
							<div class="form-group">
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-9">
									<input type="text" name="desc" required class="form-control" placeholder="Description" value="<?php echo $cid == 0 ? set_value('desc') : $college_id['dsc'] ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Shortname</label>
								<div class="col-sm-9">
									<input type="text" name="shortname" required class="form-control" placeholder="Description" value="<?php echo $cid == 0 ? set_value('shortname') : $college_id['shortname'] ?>"/>
								</div>
							</div>
													
						</div>
						<div class="col-md-6" style="padding:0">
							<div class="form-group">
								<label class="col-sm-3 control-label">College</label>
								<div class="col-sm-9">
									<select name="college" class="form-control">
										<option value="0">Select College</option>
										<?php foreach ($this->coursemajormd->get_college() as $key => $value): ?>
											<?php if ($college_id['col'] == $value['id']): ?>
												<option value="<?php echo $value['id'] ?>" <?php echo set_select('college', $value['id']) ?> selected><?php echo $value['description'] ?></option>
											<?php else: ?>
												<option value="<?php echo $value['id'] ?>" <?php echo set_select('college', $value['id']) ?>><?php echo $value['description'] ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">School</label>
								<div class="col-sm-9">
									<select class="form-control" name="school">
										<option value="0">Select School</option>
										<?php foreach ($this->coursemajormd->get_school() as $key => $value): ?>
											<?php if ($college_id['sch'] == $value['id']): ?>
												<option value="<?php echo $value['id'] ?>"  <?php echo set_select('school', $value['id']) ?> selected><?php echo $value['firstname'] ?></option>
											<?php else: ?>
												<option value="<?php echo $value['id'] ?>"  <?php echo set_select('school', $value['id']) ?>><?php echo $value['firstname'] ?></option>
											<?php endif ?>
											
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="pull-right" style="margin-bottom:2%">
								<button type="submit" class="btn btn-success">Save</button>
								<a href="/add_course" class="btn btn-info">Cancel</a>
							</div>
						</div>
							
					</form>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-responsive">
						<thead>
							<th>Description</th>
							<th>Shortname</th>
							<th>College</th>
							<th>School</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach ($this->coursemajormd->get_allcourse() as $key => $value): ?>
								<tr>
									<td><?php echo $value['dsc'] ?></td>
									<td><?php echo $value['shortname'] ?></td>
									<td><?php echo $value['col'] ?></td>
									<td><?php echo $value['firstname'] ?></td>
									<td>
										<a href="/update_course/<?php echo $value['id']; ?>" class="a-table label label-info">Edit &nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
										<a class="a-table label label-danger" onclick="return confirm('Are you sure you want to delete selected Course?')" href="/coursemajor/delete_course/<?php echo $value['id']; ?>">Delete <span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>