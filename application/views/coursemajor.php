	<div class="col-md-3"></div>
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
					<form class="form-horizontal" method="post">
						<div class="col-md-6" style="padding:0">
							<div class="form-group">
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-9">
									<input type="text" name="desc" required class="form-control" placeholder="Description" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Shortname</label>
								<div class="col-sm-9">
									<input type="text" name="shortname" required class="form-control" placeholder="Description" />
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
											<option value="<?php echo $value['id'] ?>"><?php echo $value['description'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">School</label>
								<div class="col-sm-9">
									<select class="form-control">
										<option value="0">Select School</option>
										<?php foreach ($this->coursemajormd->get_school() as $key => $value): ?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['fistname'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-responsive">
						<th>Description</th>
						<th>Shortname</th>
						<th>College</th>
						<th>School</th>
						<th>Action</th>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>