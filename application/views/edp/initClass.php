<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="col-md-12">
			<?php
				$systemVal 	= $this->api->systemValue();
				$sy 		= $systemVal['nextacademicterm'];
				if($systemVal['phase'] == FIN AND $systemVal['classallocationstatus'] < 3)
				{
					$this->db->where('academicterm',$systemVal['currentacademicterm']);
					$this->db->where('stage',2);
					$c = $this->db->get('tbl_completion')->num_rows();
					if($c == COLLEGE_COUNT)
					{
						// delete first all nextacademicterm
						$this->db->query("DELETE FROM tbl_classallocation WHERE academicterm = $sy");
						$st = $this->db->get('out_section')->result_array();
						foreach($st as $s)
						{
							// if the section is zero it will not satisfy this condition
							for($i = 1;$i <= $s['section'];$i++)
							{
								$data['academicterm'] = $s['academicterm'];
								$data['coursemajor'] = $s['coursemajor'];
								$data['subject'] = $s['subject'];
								//$this->db->insert('tbl_classallocation',$data);
							}
						}
						?>
						<div class="alert alert-success">
							Class Allocation Successfully Created
						</div>
						<?php
					}
					else{
						$this->load->view('edp/dean_activity',array('stage'=>2));
					}
				}
				else{
			?>
				<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
					Current Phase term is not FINALS !!!
					<br/>
					You Are unable to run this program...
				</div>
			<?php
				}
			 ?>
			</div>
		</div>
	</div>
</div>
