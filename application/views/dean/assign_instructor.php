<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assign Instructor</h4>
		</div>
		<div class="panel-body">
            <?php
                $owner = $this->api->getUserCollege();
                $systemVal = $this->api->systemValue();
                $cl = $this->db->get_where('tbl_classallocation',
                        array('academicterm' => $systemVal['currentacademicterm'])
                    )->result_array();
             ?>
		</div>
	</div>
</div>
