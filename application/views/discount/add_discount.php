<?php 
    //Get Student Information including partyid.
    $get_info = $this->discountmd->get_info($legacyid);
    //Get Coursemajor in API ...
    $coursemajor = $this->api->getCourseMajor($get_info['coursemajor']);
 ?>


<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Student Scholarship Information</h4>
		</div>
		<div class="panel-body">
            <form class="form-horizontal">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <label class="form-control"><?php echo $get_info['fullname'] ?></label>
                            <!-- <input type="text" value="<?php //echo $get_info['fullname'] ?>"  class="form-control"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Scholarship</label>
                        <div class="col-sm-9">
                           <select class="form-control">
                               <option>Paying Student</option>
                               <option>FM Romualez Scholar</option>
                               <option>An Waray</option>
                           </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Course</label>
                        <div class="col-sm-9">
                         <label class="form-control"><?php echo $coursemajor ?></label>
                            <!-- <input type="text"  value="<?php //echo $coursemajor ?>"  class="form-control"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Remarks</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12" style="padding:0px">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                         <a href="/student_discount" class="btn btn-warning pull-right" style="margin-right:5px">Cancel</a>
                    </div>
                </div>

            </form>
            
		</div>
	</div>
</div>
