<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

		<div class="panel-heading search">
			<div class="col-md-6">						
				<h4>System Parameter: List of Subjects by Supervising Faculty</h4>						
			</div>
			<div class="col-md-6">
				<a href="/dean/add_subject" class="btn btn-warning pull-right">Add Subject</a>
			</div>
		</div>
		<?php 
			/*$config['base_url'] = base_url().'index.php/menu/dean-subject_list';
            $config['total_rows'] = $this->subject->getNumSubject();
            $config['per_page'] = 15;
            $config['num_links'] = 2;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_open'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['next_link'] = 'Next';

            if(empty($param))
            {
                $param = 0;
            }
                $this->pagination->initialize($config);*/
		 ?>
		 <!-- <ul class="pagination"> -->
            <?php
                /*echo $this->pagination->create_links();
                $data = array('param' => $param );*/
            ?>

		<div class="panel-body">
			<div class="row">
			<?php echo $this->session->flashdata('message'); ?>
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="/dean/search" method="post" role="search">
				        <div class="form-group">
				        <input type="hidden" name="url" value="<?php echo current_url(); ?>">
				        	<input type="text" name="search" id="subject_search" class="form-control" placeholder="Search for Subject">
				        </div>
				        <button type="submit" class="btn btn-primary">
				        <span class="glyphicon glyphicon-search"></span>
				        </button>
				     </form>
				</div>
			</div>
		<?php
			$uid 				= $this->session->userdata('uid');
			$data['college'] 	= $this->api->getUserCollege();
		?>
			<div class="table-responsive" id="subject_wrapper">
				<?php  $this->load->view('dean/ajax/tbl_subject',$data);  ?>
			</div>
		</div>
		</div>
	</div>
</div>