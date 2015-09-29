<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

			<div class="col-md-12" style="background-color: #F0FBF0;">
				<?php
					$this->load->view('edp/cl_status');

					$nxt = $this->api->systemValue();
					if($nxt['classallocationstatus'] == 4)
					{
						$this->db->where('academicterm', $nxt['currentacademicterm']);
						$this->db->where('stage', 4);
						$this->db->where('status', 'O');
						$c = $this->db->get('tbl_completion')->num_rows();
						if(TRUE)
						{
				 ?>
			<div style="max-width:200px;">
				<label for="">Sort by :</label>
				<select class="form-control" id="sort_cl">
					<option value="1">Assigned & Not Assigned</option>
					<option value="2">Assigned</option>
					<option value="3">Not Assigned</option>
					<!-- <option value="4">Day</option> -->
					<option value="4">Dean</option>
				</select>
			</div>

			<div id="tbl_cl">
				<?php $this->load->view('edp/ajax_edp_all') ?>
			</div>
			<form action="/edp/cl_inc" method="post">
				<input type="hidden" name="name" value="99">
				<input type="submit" value="Attest All" class="btn btn-primary pull-right">
			</form>
			<span class="clearfix"></span>
			<br/>
			<?php
					}
					else {
						$message = 'You cannot continue';
						$this->load->view('edp/dean_activity',array('stage' => 4,'message' => $message));
					}
				}
				else {
					if($nxt['classallocationstatus'] == 3)
					{
						$message = 'You cannot continue';
						$this->load->view('edp/dean_activity',array('stage' => 4,'message' => $message));
					}
					else {
					?>
						<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
							The process is not yet here ...
						</div>
				<?php
					}
				}
			?>
			</div>
		</div>
	</div>
