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
    <br>
    <a href="<?php echo base_url() ?>" class="btn btn-primary btn-sm pull-right"> <<< Back </a>
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <form action="/registrar/legacy_matching" method="post">
                <div class="col-md-6">
                    <div class="panel p-body">
        				<div class="panel-heading search">
        					<div class="col-md-6">
        					<h4>All Subjects</h4>
        					</div>
        				</div>
                        <div style="max-height: 440px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <th></th>
                                    <th>Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                </thead>
                                <tbody>
                                <?php
                                    $this->db->order_by('descriptivetitle', 'ASC');
                                    $this->db->order_by('code', 'ASC');
                                    $p = $this->db->get('tbl_subject')->result_array();
                                    foreach($p as $sub)
                                    {
                                        ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="tbl_subject" value="<?php echo $sub['id'] ?>">
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
                </div>
                <div class="col-md-6">
                    <div class="panel p-body">
        				<div class="panel-heading search">
        					<div class="col-md-6">
        					    <h4>Legacy Subjects</h4>
        					</div>
        				</div>
                        <div style="max-height: 440px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <th></th>
                                    <th>Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                </thead>
                                <tbody>
                                <?php
                                    $this->db->group_by('grouping');
                                    $this->db->where('subject_id', 0);
                                    $u = $this->db->get('tbl_enrolment_legacy')->result_array();
                                    foreach($u as $uu)
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="legacy[]" value="<?php echo $uu['grouping'] ?>">
                                            </td>
                                            <td>
                                                <?php echo $uu['SUBNAME'] ?>
                                            </td>
                                            <td>
                                                <?php echo $uu['SUBTITLE'] ?>
                                            </td>
                                            <td>
                                                <?php echo $uu['UNITS'] ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                 ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <button type="submit" class="btn btn-warning pull-right">Match Subject</button>
                        </div>
        			</div>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript">

</script>
</body>
</html>
