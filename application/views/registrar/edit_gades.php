<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="panel-heading">
					<h4>Edit Grade</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-5">
					<form class="form-horizontal" method="post" role="form">
						<label for="code">Code</label>
						<input type="text" name="code" class="form-control" value="<?php echo $code; ?>" disabled>
						<label for="subject">Subject</label>
						<input type="text" name="subject" class="form-control" value="<?php echo $subject; ?>" disabled>
						<label for="old">Old Grade</label>
						<input type="text" name="old" class="form-control" value="<?php echo $grade; ?>"disabled>
						<label for="grades">New Grade</label>
						<input type="text" name="grades" class="form-control">
						<br />
						<input type="submit" class="btn btn-primary">
						<a href="<?php echo base_url('registrar/buildperrecord')  ?>" class="btn btn-default">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>