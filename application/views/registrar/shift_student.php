<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Search for Students</h4>
		</div>
		<div class="panel-body">
			<?php //echo current_url() ?>
			<form action="/find_shift" class="form navbar-right" method="post">
				<input type="text" id="student_search" name="student_search" class="form-control" placeholder="Enter student name,id">
		        <button type="submit" class="btn btn-primary">
		        	<span class="glyphicon glyphicon-search"></span>
		        </button>
		        <br/><br/>
		    </form>
			<?php $this->load->view('registrar/disapprove_reg') ?>
		</div>
	</div>
</div>
