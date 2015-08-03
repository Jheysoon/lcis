
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
				<h4>Transcript of Records: List of Requests</h4>
		</div>

        <div class="panel-body">
            <div class="col-md-6">
            <?php
                $config['base_url'] = base_url().'index.php/menu/registrar-tor_studlist';
                $config['total_rows'] = $this->tor->getRows();
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
                $data = array();
            ?>
            </ul>
            </div>
            <div class="col-md-6">
            <form class="navbar-form navbar-right" action="/registrar/tor_preview" method="post" role="search">
                <div class="form-group">
                    <input type="text" name="search" id="studentlist" class="form-control" autocomplete="off" placeholder="Student Id">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

            </form>
            </div>
            <input type="hidden" name="param" value="<?php echo $param; ?>"/>
    		<div id="studlist_wrapper" class="table-responsive col-md-12">
                <table class="table table-striped table-bordered table-hover">
					<tr>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Course</th>
						<th colspan="2">Action</th>
					</tr>

				    <?php
				        $result = $this->tor->getStud($param);

				        foreach($result as $info)
				        {
				            extract($info);
				            if ($major != 0) {
				                $major2 = $this->api->getMajor($major)->row_array();
				                $description = $description." (".$major2['description'].")";
				            }

				                ?>
				                <tr>
				                    <td><?php echo $legacyid; ?></td>
				                    <td><?php echo $lastname . ' , ' . $firstname ?></td>
				                    <td><?php echo $description; ?></td>
			                         <td>
				                            <a class="a-table label label-danger" href="/registrar_tor/<?php echo $legacyid; ?>">View TOR<span class="glyphicon glyphicon-eye"></span></a>
			                        </td>

				                </tr>
				            <?php
				        }
				    ?>
				</table>

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
