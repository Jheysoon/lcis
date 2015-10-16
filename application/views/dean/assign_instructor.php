<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assign Instructor</h4>
		</div>
		<div class="panel-body">
			<?php
				$systemVal 	= $this->api->systemValue();
				$phaseterm = $this->session->userdata('assign_sy');
				$this->db->where('id', $phaseterm);
				$sy = $this->db->get('tbl_academicterm')->row_array();

				if ($systemVal['classallocationstatus'] == 99) {
			 ?>
			<a href="/instructor_sched" class="btn btn-primary pull-right">View Instructor Schedule</a>
			<span class="clearfix"></span>
			<br>
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
			 <p style="text-align:center;">
				<strong>
					School Year: <?php echo $sy['systart'].'-'.$sy['syend'] ?> Term: <?php echo $sy['term'] ?>
				  <br><?php echo $user == $systemVal['employeeid'] ? '': $col['description'] ?>
				</strong>
			</p>
			<?php
				if ($systemVal['classallocationstatus'] == 99) {
					$this->db->order_by('systart,term');
					$sy = $this->db->get('tbl_academicterm')->result_array();
			?>
			<form action="/change_sy" method="post" style="max-width:200px;">
				<label>School Year : </label>
				<select class="form-control" name="sy">
					<?php
						foreach ($sy as $s) {
						$sem = $s['term'] == 3 ? 'Summer' : $s['term'].' term';
					?>
						<option value="<?php echo $s['id'] ?>" <?php echo ($phaseterm == $s['id']) ? 'selected' : '' ?>><?php echo $s['systart'].'-'.$s['syend'].' | '.$sem ?></option>
					<?php } ?>
				</select>
				<input type="submit" class="btn btn-primary pull-right" name="name" value="Change">
			</form>
			<span class="clearfix"></span>
			<label>Sort by :</label>
			<select class="form-control" id="sorting" style="max-width:200px;">
				<option value="0">All</option>
				<option value="1">Assigned</option>
				<option value="2">Not Assigned</option>
			</select>
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
