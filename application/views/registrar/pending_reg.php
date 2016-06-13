<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Pending Students</h4>
		</div>
		<div class="panel-body">
            <div class="col-md-3"></div>
            <div class="col-md-6	">
				<!-- loop thought the tbl_registration of the student where status = E -->
				<label>Student ID</label>
                <label class="form-control"><?php echo $legacyid; ?></label>
                <label>Firstname</label>
                <label class="form-control"><?php echo ucwords(strtolower($fname)); ?></label>
				<label>Lastname</label>
				<label class="form-control"><?php echo ucwords(strtolower($lname)); ?></label>
				<label>Middlename</label>
				<label class="form-control"><?php echo ucwords(strtolower($mname)); ?></label>
				<label>Course</label>
				<label class="form-control"><?php echo $this->course->getCourse($cid); ?></label>
				<label>Major</label>
				<label class="form-control">
					<?php
						$t = $this->api->getMajor($cid);
						$tt = $t->row_array();
						echo $tt['description'];
					?></label>
				<label>Gender</label>
				<label class="form-control"><?php echo $gender == 'M' ? 'MALE':'FEMALE' ?></label>
				<label>Place of Birth</label>
				<label class="form-control"><?php echo $pob; ?></label>
				<form action="/registrar/approve" method="post">
					<a href="/registrar/disapprove/<?php echo $reg ?>" class="btn btn-danger">Return to Clerk</a>
					<input type="hidden" name="reg_id" value="<?php echo $reg; ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" value="Approve" class="btn btn-primary pull-right">
				</form>
            </div>
            <div class="col-md-3"></div>
		</div>
	</div>
</div>
