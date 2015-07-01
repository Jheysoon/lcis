	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading search">
				<div class="col-md-12">
					<h4>Add Section</h4>
				</div>
			</div>
			<div class="panel-body">
	            <div class="col-md-4">
	            	
	            </div>
	            <div class="col-md-4">
	            <?php echo $error; ?>
	            	<form action="/dean/addSubjAlloc" method="post">
	            		<label>Subject</label>
	            		<select class="form-control" name="subject">
	            			<?php 
	            				$owner = $this->api->getUserCollege();
	            				$s = $this->subject->subjectOwner($owner);
	            				foreach($s as $ss)
	            				{
	            					?>
	            				<option value="<?php echo $ss['id']; ?>" <?php echo set_select('subject',$ss['id']); ?>><?php echo $ss['code'].' | '.$ss['descriptivetitle'];?></option>
	            			<?php
	            				}
	            			 ?>
	            		</select>
	            		<label>Course</label>
	            		<select class="form-control" name="course_major">
	            			<?php 
	            				$c = $this->db->query("SELECT * FROM tbl_course")->result_array();
	            				foreach($c as $cc)
	            				{
	            					?>
	            					<option value="<?php echo $cc['id'] ?>" <?php echo set_select('course_major') ?>>
	            					<?php 
	            						echo $cc['description'];
	            					 ?>
	            					</option>
	            			<?php
	            				}
	            			 ?>
	            		</select>
	            		<label>Year Level</label>
	            		<select class="form-control" name="yearlevel">
	            			<option value="1">1</option>
	            			<option value="2">2</option>
	            			<option value="3">3</option>
	            			<option value="4">4</option>
	            		</select>
	            		<label>No. of Section</label>
	            		<input type="number" min="1" class="form-control" name="sections">
	            		<input type="hidden" name="is_ajax" value="0">
	            		<input type="submit" class="btn btn-primary pull-right" style="margin-top:5px;" value="Add">
	            	</form>
	            </div>
	            <div class="col-md-4">
	            	
	            </div>
			</div>
		</div>
	</div>

