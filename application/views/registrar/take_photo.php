<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Search for Students</h4>
		</div>
		<div class="panel-body">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <form class="" action="/registrar/save_photo" id="form_image" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" id="image" name="image" value="">
                    <label>Student ID</label>
                    <label class="form-control" style="max-width:400px;"><?php echo $student_id ?></label>
                    <!-- pic wrapper -->
                    <div id="pic_wrapper"></div>
                    <br>
                    <button type="button" id="save" class="hide btn btn-success pull-left">Save</button>
                    <button type="button" id="pre_take" class="btn btn-success pull-left">Take Photo</button>
                    <button type="button" id="cancel_pic" style="margin-right:50px;" class="hide btn btn-danger pull-right">Cancel</button>
                </form>
            </div>
            <div class="col-md-4">

            </div>
		</div>
	</div>
</div>
