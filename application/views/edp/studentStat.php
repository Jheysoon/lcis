	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<h4>Student Statistics</h4>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-12">
					<?php 
						$q = $this->out_studentcount->chkAcam(40);
					 ?>
					 <input type="hidden" name="chkAcam" value="<?php echo $q; ?>">
						<div id="stat_wrapper">
						 	<div class="progress" style="height:25px;">
							  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							    <span class="sr-only"></span>
							    Loading ....
							  </div>
							</div>
						</div>
					</div>
	            </div>
			</div>
		</div>
	</div>

