<?php
    $office = $this->api->getUserOffice();
    $col = $this->api->getUserCollege();
    $val = $this->api->systemValue();
    $stat = $val['classallocationstatus'];
    $phase = $val['phase'];
    if ($stat == 99 && ($phase == 1 || $phase == 5)) {
        $disable = '';
        $alert = '';
    }
    else{
        $alert = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        Unable to make evaluation. Please make sure that enrollment period is set and class allocation is done.</div>';

        $disable = 'disabled';
    }
 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
				<h4>Student Information Management: List of Students</h4>
		</div>

        <div class="panel-body">
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo $alert; ?>
            <div class="col-md-6">
            <?php
                $config['base_url'] = base_url().'index.php/menu/dean-studentlist';
                if ($office == 3) {
                    $config['total_rows'] = $this->student->getRows2();
                }
                else{
                    $config['total_rows'] = $this->student->getRows($col);
                }
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
                $data = array(
                    'param' => $param,
                    'col' => $col,
                    'stat' => $stat,
                    'office' => $office,
                    'phase' => $phase
                );
            ?>
            </ul>
            </div>
            <div class="col-md-6">
            <form class="navbar-form navbar-right" action="/dean/searchStud" method="post" role="search">

                <div class="form-group">
                    <input type="hidden" name="cur_url" value="<?php echo current_url(); ?>"/>
                    <input type="hidden" name="col" value="<?php echo $col; ?>"/>
                    <input type="hidden" name="office" value="<?php echo $office; ?>"/>
                    <input type="text" name="search" <?php echo $disable; ?> id="studentlist" class="form-control" autocomplete="off" placeholder="Student Id">
                </div>
                <button type="submit" class="btn btn-primary"  <?php echo $disable; ?> >
                    <span class="glyphicon glyphicon-search"></span>
                </button>

            </form>
            </div>
            <input type="hidden" name="param" value="<?php echo $param; ?>"/>
    		<div id="studlist_wrapper" class="table-responsive col-md-12">
                <?php
                    $this->load->view('dean/ajax/tbl_student',$data);
                 ?>
            <ul class="pagination">
                <?php
                    echo $this->pagination->create_links();
                ?>
            </ul>
    		</div>

		</div>
		</div>
	</div>
</div>
