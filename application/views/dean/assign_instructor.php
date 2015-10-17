<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4 class="col-md-6">Assign Instructor</h4>
			<a href="/instructor_sched" class="btn btn-warning pull-right">View Instructor Schedule</a>
			<span class="clearfix"></span>
		</div>
		<div class="panel-body">
			<?php
				$systemVal 	= $this->api->systemValue();
				$phaseterm = $this->session->userdata('assign_sy');
				$this->db->where('id', $phaseterm);
				$sy = $this->db->get('tbl_academicterm')->row_array();

				if ($systemVal['classallocationstatus'] == 99) {
			 ?>
            <?php
            	$user 		= $this->session->userdata('uid');
            	if ($user != $systemVal['employeeid']) {
            		$owner 		= $this->api->getUserCollege();
					$this->db->where('id', $owner);
					$col = $this->db->get('tbl_college')->row_array();

					$data['instruc'] = $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();
            	} else {
            		$data['instruc'] = '';
            	}
                
				if ($user == $systemVal['employeeid']) {
					$data['cl'] 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor 
						FROM tbl_classallocation a,tbl_subject b
	                    WHERE a.subject = b.id
	                    AND (b.computersubject = 1 OR b.nstp = 1)
	                    AND academicterm = $phaseterm ORDER BY title ASC")->result_array();
				} elseif($owner == 1) {
					$data['cl'] 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor 
						FROM tbl_classallocation a,tbl_subject b
	                    WHERE a.subject = b.id
	                    AND b.owner = $owner AND b.gesubject = 1 
	                    AND b.computersubject = 0 AND b.nstp = 0
	                    AND academicterm = $phaseterm ORDER BY title ASC")->result_array();
				} else {
					$data['cl'] 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor 
						FROM tbl_classallocation a,tbl_subject b
	                    WHERE a.subject = b.id
	                    AND b.owner = $owner AND b.gesubject = 0 
	                    AND b.computersubject = 0 AND b.nstp = 0
	                    AND academicterm = $phaseterm ORDER BY title ASC")->result_array();
				}

                //$data['cl'] = $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a, tbl_subject b WHERE a.subject = b.id AND academicterm = {$systemVal['currentacademicterm']}")->result_array();
             ?>
			 <div class="col-md-6">
				<h3 style="text-align: center; font-weight: bold"><?php echo $user == $systemVal['employeeid'] ? '': $col['description'] ?></h3>
				<h5 style="text-align: center; font-weight: bold">School Year: <?php echo $sy['systart'].'-'.$sy['syend'] ?> Term: <?php echo $sy['term'] ?></h5>
			 </div>
			<?php
				if ($systemVal['classallocationstatus'] == 99) {
					$this->db->order_by('systart,term');
					$sy = $this->db->get('tbl_academicterm')->result_array();
			?>
			<div class="col-md-4">
				<form class="form" action="/change_sy" method="post">
					<div class="form-group">
					<label class="control-label">School Year : </label>
					<div class="input-group">
						<select class="form-control" name="sy">
							<?php
								foreach ($sy as $s) {
								$sem = $s['term'] == 3 ? 'Summer' : $s['term'].' term';
							?>
								<option value="<?php echo $s['id'] ?>" <?php echo ($phaseterm == $s['id']) ? 'selected' : '' ?>><?php echo $s['systart'].'-'.$s['syend'].' | '.$sem ?></option>
							<?php } ?>
						</select>
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary pull-right" name="name" value="Change">	
						</span>					
					</div>
					</div>
				</form>
			</div>
			<div class="col-md-2">
				<div class="form">
					<div class="form-group">
						<label class="control-label">Sort by :</label>
						<select class="form-control" id="sorting">
							<option value="0">All</option>
							<option value="1">Assigned</option>
							<option value="2">Not Assigned</option>
						</select>
					</div>
				</div>
			</div>
			<?php } ?>
			<div id="table-body">
             <?php
				$this->load->view('dean/ajax/assigned_ins', $data);
				$this->load->view('dean/ajax/not_ass_ins', $data);
			?>
			 </div>
			 <?php
				} else {
					?>
					<div class="alert alert-danger">
						Cannot run program. Class allocation status is not valid
					</div>
			<?php
				}
			?>
			 <!-- <a href="#" class="btn btn-primary pull-right">Attest All</a> -->
		</div>
	</div>
</div>
