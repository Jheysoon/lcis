<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assign Instructor</h4>
		</div>
		<div class="panel-body">
			<?php
				$systemVal 	= $this->api->systemValue();
				$this->db->where('id', $systemVal['currentacademicterm']);
				$sy = $this->db->get('tbl_academicterm')->row_array();

				if($systemVal['classallocationstatus'] == 99)
				//if(true)
				{
			 ?>
			<a href="/instructor_sched" class="btn btn-primary pull-right">View Instructor Schedule</a>
			<span class="clearfix"></span>
			<br>
            <?php
                $owner 		= $this->api->getUserCollege();
				$this->db->where('id', $owner);
				$col = $this->db->get('tbl_college')->row_array();
				$user 		= $this->session->userdata('uid');

                $data['cl'] 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a,tbl_subject b
                    WHERE a.subject = b.id
                    AND b.owner = $owner
                    AND academicterm = {$systemVal['currentacademicterm']}")->result_array();

                $data['instruc'] = $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();

                //$data['cl'] = $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a, tbl_subject b WHERE a.subject = b.id AND academicterm = {$systemVal['currentacademicterm']}")->result_array();
             ?>
			 <p style="text-align:center;">
				<strong>
					School Year: <?php echo $sy['systart'].'-'.$sy['syend'] ?> Term: <?php echo $sy['term'] ?>
				  <br><?php echo $col['description'] ?>
				</strong>
			</p>
			<?php
				if($systemVal['classallocationstatus'] == 99){
				//if(true){
			?>
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
				}
				else {
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
