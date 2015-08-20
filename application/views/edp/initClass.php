<div class="col-md-3"></div>
	<div class="col-md-9 body-container" >
		<div class="panel p-body" >
			<div class="col-md-12" style="background-color:#F0FBF0;">
			<?php
				$this->load->view('edp/cl_status');

				$systemVal 	= $this->api->systemValue();
				$sy 		= $systemVal['nextacademicterm'];
				if($systemVal['phase'] == FIN)
				{
					if($systemVal['classallocationstatus'] == 2 OR $systemVal['classallocationstatus'] == 1)
					{
						$this->db->where('academicterm', $systemVal['currentacademicterm']);
						$this->db->where('stage', 2);
						$this->db->where('status', 'O');
						$c = $this->db->get('tbl_completion')->num_rows();
						if($c == COLLEGE_COUNT)
						{
							$r['classallocationstatus'] = 3;
							$this->db->update('tbl_systemvalues', $r);
							// delete first all nextacademicterm
							$this->db->query("DELETE FROM tbl_classallocation WHERE academicterm = $sy");
							$st = $this->db->get('out_section')->result_array();
							foreach($st as $s)
							{
								// if the section is zero it will not satisfy this condition
								for($i = 1;$i <= $s['section'];$i++)
								{
									$data['academicterm'] 	= $s['academicterm'];
									$data['coursemajor'] 	= $s['coursemajor'];
									$data['subject'] 		= $s['subject'];
									$this->db->insert('tbl_classallocation', $data);
								}
							}
						?>
						<div class="alert alert-success">
							Class Allocation Successfully Created
						</div>
						<?php
						}
						else
						{
							$message = 'You cannot initialize the classallocation';
							$this->load->view('edp/dean_activity',array('stage' => 2,'message' => $message));
						}
					}
					else
					{
						?>
						<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
							Cannot run this program
						</div>
					<?php
					}
				}
				else
				{
			?>
				<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
					You have run this program
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
