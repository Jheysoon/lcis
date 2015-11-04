<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">
			<?php //if ($page == "updateOldStudents"): ?>
				<h4>Student Information Management: List of Students</h4>
			<?php //else: ?>
				<h4>Permanent Records: List of Students</h4>
			<?php //endif ?>

			</div>
			<div class="col-md-6">


			</div>
		</div>
            <?php echo $this->session->flashdata('message'); ?>
            <div class="col-md-6">
            <?php
                $config['base_url'] 		= base_url().'index.php/menu/registrar-student_list';
                $config['total_rows'] 		= $this->enrollment->getRows();
                $config['per_page'] 		= 15;
                $config['num_links'] 		= 2;
                $config['first_link'] 		= 'First';
                $config['last_link'] 		= 'Last';
                $config['first_tag_open'] 	= '<li>';
                $config['first_tag_close'] 	= '</li>';
                $config['last_tag_open'] 	= '<li>';
                $config['last_tag_close'] 	= '</li>';
                $config['num_tag_open'] 	= '<li>';
                $config['num_tag_close'] 	= '</li>';
                $config['cur_tag_open'] 	= '<li class="active"><a href="javascript:void(0);">';
                $config['cur_tag_close'] 	= '</a></li>';
                $config['next_tag_open'] 	= '<li>';
                $config['next_tag_open'] 	= '</li>';
                $config['prev_tag_open'] 	= '<li>';
                $config['prev_tag_close'] 	= '</li>';
                $config['next_tag_open'] 	= '<li>';
                $config['next_tag_close'] 	= '</li>';
                $config['prev_link'] 		= 'Prev';
                $config['next_link'] 		= 'Next';
                //$config['next_link'] = '<li><a href="#">&gt;</a></li>';
                if(empty($param))
                {
                    $param = 0;
                }
                $this->pagination->initialize($config);
            ?>
            <ul class="pagination">

            <?php
                echo $this->pagination->create_links();
                $data = array('param' => $param );
            ?>
            </ul>
            </div>
            <div class="col-md-6"><br/>
            <form class="navbar-form navbar-right" action="/registrar/search" method="post" role="search">
                <input type="hidden" id = "thestatus" name = "stats">
                <label>Status Filter</label>
                <?php $pos = $this->session->userdata('datamanagement'); ?>
                <select class="form-control" name="status" id = "status">

                    <?php if($pos == 'E') { ?>
	                    <option value="N" <?php echo ($this->session->userdata('status') == 'N') ? 'selected' : ''  ?>>Not Open</option>
	                    <option value="O" <?php echo ($this->session->userdata('status') == 'O') ? 'selected' : '' ?>>Open</option>
                    	<option value="E" <?php echo ($this->session->userdata('status') == 'E') ? 'selected' : '' ?>>Editing</option>
                    <?php } ?>

                    <option value="S" <?php echo ($this->session->userdata('status') == 'S') ? 'selected' : '' ?>>Submitted</option>
                    <option value="C" <?php echo ($this->session->userdata('status') == 'C') ? 'selected' : '' ?>>Confirmed</option>
                    <option value="R" <?php echo ($this->session->userdata('status') == 'R') ? 'selected' : '' ?>>Returned</option>
                </select>

                <div class="form-group">
                    <input type="hidden" name="cur_url" value="<?php echo current_url(); ?>"/>
                    <input type="text" name="search" id="student_search" class="form-control" placeholder="Student Id">
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>

            </form>
            </div>
		<div class="panel-body">
            <input type="hidden" name="param" value="<?php echo $param; ?>"/>
    		<div id="studlist_wrapper" class="table-responsive">
                <?php $this->load->view('registrar/ajax/tbl_studlist',$data); ?>
    		</div>

            <ul class="pagination">
                <?php echo $this->pagination->create_links(); ?>
            </ul>
		</div>
		</div>
	</div>
