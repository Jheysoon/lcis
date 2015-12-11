	<div class="col-md-3"></div>
	<?php 
		$major_id = $this->coursemajormd->get_mid($mid);
	 ?>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<div class="col-md-6">
						<h4>Major Management</h4>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<?php echo $this->session->flashdata('messages') ?>
					<form class="col-lg-offset-6 col-lg-6" role="form" method="post" action="/insert_course">
						<input type="hidden" value="<?php echo $mid ?>" name="cid">
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-9">
									<input type="text" name="desc" required class="form-control" placeholder="Description" value="<?php echo $mid == 0 ? set_value('desc') : $major_id['description'] ?>"/>
								</div>
							</div> -->
							<div class="input-group">
		                      <input type="text" class="form-control" required name="major" value="<?php echo $mid == 0 ? set_value('desc') : $major_id['description'] ?>" placeholder="Add Major">
		                      <span class="input-group-btn">
		                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-save" ></span> Save</button>
		                            <a class="btn btn-danger" href="/designation">Cancel</a>
		                       
		                      </span>
		                    </div>
																			
							
							
					</form>
					<br /><br />
					<div class="col-md-12 table-responsive">
					<table class="table table-bordered table-responsive">
						<thead>
							<th>Major</th>
							<th>Action</th>

						</thead>
						<tbody>
							<?php foreach ($this->coursemajormd->get_major() as $key => $value): ?>
								<tr>
									<td><?php echo $value['description'] ?></td>
									<td>
										<a href="/update_major/<?php echo $value['id']; ?>" class="a-table label label-info">Edit &nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
										<a class="a-table label label-danger" onclick="return confirm('Are you sure you want to delete selected Course?')" href="/coursemajor/delete_major/<?php echo $value['id']; ?>">Delete <span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				</div>
				
			</div>
		</div>