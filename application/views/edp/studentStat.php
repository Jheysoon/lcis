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
						<div class="alert alert-info center-block" id="confirmBox" style="max-width:400px;">
							<strong> Do you want to run the student statistics for <br/>
							<?php 
								$nxt = $this->api->systemValue();
								$nnxt = $this->academicterm->findById($nxt['nextacademicterm']);
								echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$nnxt['term'];
						 	?>
		 				?</strong>
							<br/>
							<input type="button" name="btnYes" class="btn btn-primary pull-right" value="Yes">
							<span class="clearfix">
						</div>
						<div id="stat_wrapper" class="hide">
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

