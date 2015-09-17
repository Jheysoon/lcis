<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Leyte Colleges-Transcript of Record</title>
        <link rel="icon" type="image/jpg" href="<?php echo base_url('assets/images/LC Logo.jpg'); ?>">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo  base_url('assets/images/LC logo.jpg'); ?>">
	    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	    <link href="<?php echo base_url('assets/css/bootstrap-theme.css'); ?>" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jasny-bootstrap.min.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    </head>
    <body>
        <div class="row">
          <nav class="navbar navbar-inverse nav-head" role="navigation">
            <div class="container-fluid">
              <div class="navbar-header">
                <div>
                  <img class="img-logo" src="<?php echo base_url('assets/images/LC Logo.jpg'); ?>">
                    <h2 class="hd-title">
                        <a class="title" href="<?php echo base_url(); ?>">LEYTE COLLEGES Information System</a>
                    </h2>
                </div>
            </div><!-- /.container-fluid -->
          </nav>
        </div>
        <div class="col-md-11" style="margin-top: 70px">
            <?php 
                echo $this->session->flashdata('message'); 
                $col = $this->group->getCol($this->api->getUserCollege());
            ?>
        </div>
        <div class="col-md-1" style="margin-top: 70px">
            <a href="/" class="btn btn-primary pull-right"> <<< Back</a>
        </div>
		<div class="col-md-6">
			<div class="panel p-body">
				<div class="panel-heading search">
					<h4>Legacy Subjects <small style="color: #FF0">(<?php echo $col['description']; ?>)</small></h4>
				</div>
                <form class="form" action="/dean/group" method="post">
                    <div style="max-height: 440px; overflow-y: scroll;">
                    <table class="table table-bordered">
                        <tr>
                            <th width="10px;"></th>
                            <th>Code</th>
                            <th>Descriptive Title</th>
                            <th>Unit</th>
                        </tr>
                        <?php 
                            $subcode = $this->api->get_subcode();
                            $res = $this->group->get_subjects($subcode); 
                        ?>
                        <?php foreach ($res as $key => $value): extract($value)?>
                            <tr>
                                <td><input type="checkbox" name="checked[]" value="<?php echo $SUBTITLE.'|'.$SUBNAME; ?>"></td>
                                <td><?php echo $SUBNAME; ?></td>
                                <td><?php echo $SUBTITLE; ?></td>
                                <td><?php echo $UNITS; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    </div>
                    <div class="panel-body">
                        <button type="submit" class="btn btn-warning pull-right">Add Group >></button>
                    </div>
                </form>
			</div>
		</div>



		<div class="col-md-6">
			<div class="panel p-body">
				<div class="panel-heading search">
					<div class="col-md-6">
					<h4>Grouped Subjects</h4>
					</div>
				</div>

                <div style="max-height: 440px; overflow-y: scroll;">
                    <table class="table table-bordered">
                        <tr>
                            <th>Code</th>
                            <th>Descriptive Title</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                            $subcode = $this->api->get_subcode();
                            $res = $this->group->get_grouped_subjects($subcode); ?>
                        <?php foreach ($res as $key => $value): extract($value)?>
                            <tr>
                                <td><?php echo $SUBNAME; ?></td>
                                <td><?php echo $SUBTITLE; ?></td>
                                <td><?php echo $UNITS; ?></td>
                                <td><a class="label label-danger a-table" href="/ungroup/<?php echo $grouping; ?>">Ungroup</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
			</div>
		</div>
	</body>
</html>
