<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Search for Students</h4>
		</div>
		<div class="panel-body">
			<?php echo current_url() ?>
			<form style="max-width:400px;" action="/find_shift" class="center-block" method="post">
				<input type="text" id="student_search" name="student_search" class="form-control" placeholder="Enter student name,id">
			    <br/>
				<input type="submit" value="Search" class="btn btn-primary" style="margin-left:100px;">
            </form>
			<?php $this->load->view('registrar/disapprove_reg') ?>
		</div>
	</div>
</div>
