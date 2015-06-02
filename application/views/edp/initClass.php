<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

			<div class="col-md-12">
			<?php 
				$systemVal = $this->api->systemValue();
				$sy = $systemVal['nextacademicterm'];
				$this->db->query("DELETE FROM tbl_classallocation WHERE academicterm = $sy");
				$st = $this->db->get('out_section')->result_array();
				foreach($st as $s)
				{
					for($i = 1;$i <= $s['section'];$i++)
					{
						$data['academicterm'] = $s['academicterm'];
						$data['coursemajor'] = $s['coursemajor'];
						$data['subject'] = $s['subject'];
						$this->db->insert('tbl_classallocation',$data);
					}
				}
			 ?>
				<div class="alert alert-success">
					Class Allocation Successfully Created
				</div>
			</div>
			
		</div>
	</div>
</div>