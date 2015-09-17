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
            <form action="/combine_subject" method="post">
                <?php
                //$e = explode('|', 'ED');
                //echo 'substr(subcode,1,2) ='.implode($e, ' OR substr(subcode,1,2)=');
                 ?>
                <div class="col-md-6">
                    <div class="panel p-body">
        				<div class="panel-heading search">
        					<div class="col-md-6">
        					<h4>Curriculum Subjects</h4>
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
                                        $owner = $this->api->getUserCollege();
                                        if($owner == 1)
                                        {
                                            $cur = array('14', '18');
                                        }
                                        elseif($owner == 2)
                                        {
                                            $cur = array('53', '49', '51', '48');
                                        }
                                        elseif ($owner == 3) {
                                            $cur = array('17', '15');
                                        }
                                        elseif ($owner == 4) {
                                            $cur = array('42', '50');
                                        }
                                        elseif($owner == 5)
                                        {
                                            $cur = array('16', '54');
                                        }
                                        $curs = implode($cur, ',');
                                        $r = $this->db->query("SELECT DISTINCT(b.id) as subject,code,descriptivetitle,units
                                            FROM tbl_curriculumdetail a,tbl_subject b WHERE curriculum IN($curs)
                                            AND a.subject = b.id ORDER BY yearlevel,term,descriptivetitle")->result_array();
                                        // $r = $this->db->get('view_cur_subjects')->result_array();
                                        foreach($r as $sub)
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="radio" name="cur_sub" value="<?php echo $sub['subject'] ?>">
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
                                        $r = $this->db->query("SELECT * FROM tbl_enrolment_legacy WHERE subject_id = 0 GROUP BY grouping ORDER BY grouping ASC LIMIT 200")->result_array();
                                        foreach($r as $rr)
                                        {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="legacyname[]" value="<?php echo $rr['grouping'] ?>">
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
                        <div class="panel-body">
                            <button type="submit" class="btn btn-warning pull-right">Same Subject</button>
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
