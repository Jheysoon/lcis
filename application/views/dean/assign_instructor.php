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
				$phaseterm 	= $this->session->userdata('assign_sy');
				$this->db->where('id', $phaseterm);
				$sy 		= $this->db->get('tbl_academicterm')->row_array();
				$owner 		= $this->api->getUserCollege();

				if ($systemVal['classallocationstatus'] == 99) {
	            	$user 		= $this->session->userdata('uid');
					
	            	if ($user != $systemVal['employeeid']) {
						$this->db->where('id', $owner);
						$col = $this->db->get('tbl_college')->row_array();
					}

					$this->db->select('id');
					$inst 	= $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();
					$inst1 	= $this->db->query("SELECT a.id as id FROM tbl_administration a,tbl_office b WHERE a.office = b.id AND b.college = $owner")->result_array();
					$data['instruc'] = array_merge($inst, $inst1);

					$data['cl'] = $this->edp_classallocation->getAllocs($systemVal, $owner);

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
								$sem = $s['term'] == 3 ? 'Summer' : 'Term: '.$s['term'];
							?>
								<option value="<?php echo $s['id'] ?>" <?php echo ($phaseterm == $s['id']) ? 'selected' : '' ?>><?php echo 'SY: '.$s['systart'].'-'.$s['syend'].'  '.$sem ?></option>
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
             	echo $this->session->flashdata('message');
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

<div class="modal fade" id="myModalIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content modal-sm">
    		<form action="/dean/ass_ins_other" method="POST">
	    		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Assign Other Instructor</h4>
	    		</div>
	    		<div class="modal-body">
					<label>Instructor</label>
					<input type="hidden" id="cl_id" name="cl_id" value="">
	    			<select class="form-control" name="instructor">
	    				<?php
	    					if ($systemVal['classallocationstatus'] == 99) {
			        			$this->db->select('id');
			        			$inst = $this->db->get_where('tbl_academic', array('college !=' => '' ,'college !=', $owner))->result_array();
			        			$inst1 = $this->db->query("SELECT a.id as id FROM tbl_administration a,tbl_office b WHERE a.office = b.id AND b.college != '' ")->result_array();
			        			$ins12 	= array_merge($inst, $inst1);

			        			foreach($ins12 as $i) {
			        				$p = $this->db->get_where('tbl_party', array('id' => $i['id']));

			        				if ($p->num_rows() > 0) {
			        					$pp = $p->row_array();
		        				?>
		        			<option value="<?php echo $pp['id'] ?>"><?php echo $pp['firstname'].' '.$pp['lastname'] ?></option>
		        		<?php
			        				}
			        			}
		        			}
	        			?>
	    			</select>
	    		</div>
	    		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        		<button type="submit" class="btn btn-primary">Save</button>
	    		</div>
    		</form>
    	</div>
	</div>
</div>
