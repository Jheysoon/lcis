	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>Edit Classroom Table</h4>
				</div>
				<div class="col-md-6">
				<!-- <form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Classroom Id">
			        </div>
			        <button type="submit" class="btn btn-primary">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
				</form> -->
				</div>

			</div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal add-user" method="post" action="/add_room" role="form">
					<br/>
					<h3 class="col-sm-offset-1">Classroom Information</h3>
					<hr>
					<?php echo $error; ?>
					<br/>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-5">

							<label class="label-control add-label" for="room">ROOM NUMBER<small class="required">(required)</small></label>
							<input class="form-control" maxlength="10" type="text" name="room" required autofocus value="<?php echo set_value('room'); ?>">
							
							<label class="label-control add-label2" for="location">CAMPUS <small class="required">(required)</small></label>
							<select class="form-control" name='location'>
							<?php 
								$l = $this->db->get('tbl_location')->result_array();
								foreach($l as $ll){
							?>
								<option value="<?php echo set_select('location',$ll['id']); ?>"><?php echo $ll['description']; ?></option>
							<?php } ?>
							</select>	
						
							<label class="label-control add-label2" for="mincapacity">MINIMUM CAPACITY <small class="required">(required)</small></label>
							<input class="form-control" type="number" name="mincapacity" required>

							<label class="label-control add-label2" for="maxcapacity">MAXIMUM CAPACITY <small class="required">(required)</small></label>
							<input class="form-control" type="number" name="maxcapacity" required>

							<!-- <label class="label-control add-label2" for="course">FLOOR LEVEL <small class="required">(required)</small></label>
							<select class="form-control" name='course' required>
								
								<option> GROUND/FIRST FLOOR</option>
								<option> SECOND FLOOR</option>
								<option> THIRD FLOOR</option>
							</select> -->	

							<!-- <label class="label-control add-label2" for="Units">DIMENSION <small class="required">(required)</small></label> -->
							<!-- <input class="form-control" type="text" name="firstname" placeholder="Units" width="100" required value="10m x 10M">
							<label class="label-control add-label2" for="Units">REMARKS <small class="required">(required)</small></label>
							<input class="form-control" type="text" name="remarks" placeholder="Units" width="100" required value=""> -->
							<label class="label-control add-label2" for="status">STATUS <small class="required">(required)</small></label>
							<select class="form-control" name='status'>
									<option> OK</option>
									<option> FOR/UNDER REPAIR</option>
							</select>	
								
						</div>

		            </div>
		            <div class="form-group">
		                <div class="col-sm-offset-1 col-sm-6">
		                  <button type="submit" class="btn btn-success">Save</button>
		                  <button type="reset" class="btn btn-warning">Clear</button>
		              	</div>
		            </div>

				</form>
			</div>
		</div>
	</div>

