<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Leyte Colleges Information System</title>

    <link rel="icon" type="image/jpg" href="<?php echo base_url('assets/images/LC Logo.jpg'); ?>">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo  base_url('assets/images/LC logo.jpg'); ?>">

    <!-- ================================ css library ================================== -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jasny-bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <!-- =============================================================================== -->
     <script type="text/javascript" src="<?php echo base_url('assets/js/javascript_functions.js'); ?>"></script>

  </head>
<body>
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
    <br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel p-body">
    				<div class="panel-heading search">
    					<div class="col-md-6">
    					<h4>Curriculum Subjects</h4>
    					</div>
    				</div>
                    <table class="table table-bordered">
                        <thead>
                            <th></th>
                            <th>Code</th>
                            <th>Descriptive Title</th>
                            <th>Units</th>
                        </thead>
                        <tbody style="height:400px;overflow-y:auto;">
                            <?php
                                $r = $this->db->get('view_cur_subjects')->result_array();
                                foreach($r as $sub)
                                {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="cur_sub[]" value="<?php echo $sub['id'] ?>">
                                        </td>
                                        <td>
                                            <?php echo $sub['code'] ?>
                                        </td>
                                        <td>
                                            <?php echo $sub['descriptivetitle'] ?>
                                        </td>
                                        <td>
                                            <?php echo $sub['units'] ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                             ?>
                        </tbody>
                    </table>
    			</div>
            </div>
            <div class="col-md-6">
                <div class="panel p-body">
    				<div class="panel-heading search">
    					<div class="col-md-6">
    					<h4>Legacy Subjects</h4>
    					</div>
    				</div>
                    <table class="table table-bordered">
                        <thead>
                            <th></th>
                            <th>Code</th>
                            <th>Descriptive Title</th>
                            <th>Units</th>
                        </thead>
                        <tbody>
                            <?php
                                $r = $this->db->query("SELECT * FROM tbl_enrolment_legacy WHERE subject_id = 0 GROUP BY grouping ORDER BY grouping ASC LIMIT 200")->result_array();
                                foreach($r as $rr)
                                {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="name[]" value="<?php echo $rr['id'] ?>">
                                        </td>
                                        <td>
                                            <?php echo $rr['SUBNAME'] ?>
                                        </td>
                                        <td>
                                            <?php echo $rr['SUBTITLE'] ?>
                                        </td>
                                        <td>
                                            <?php echo $rr['UNITS'] ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                             ?>
                        </tbody>
                    </table>
    			</div>
            </div>
        </div>
    </div>
<script type="text/javascript">

</script>
</body>
</html>
