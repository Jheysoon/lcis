<?php 
  /*$result   = getEmpInfo($_SESSION['id']);
  $row      = mysql_fetch_row($result);
  $name     = $row[2]." ".$row[4];*/
 ?>
    <div class="container-fluid main-body">

    <!-- ============================== header & navigation ============================ -->
    <div class="row">
      <nav class="navbar navbar-inverse nav-head" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1 ">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div>
              <img class="img-logo" src="<?php echo base_url('assets/images/LC Logo.jpg'); ?>"><h2 class="hd-title"><a class="title" href="<?php echo base_url(); ?>">LEYTE COLLEGES Information System</a></h2>
            </div>
          </div>

          <div class="collapse navbar-collapse pull-right">
            <ul class="nav navbar-nav top-sign navbar-right">
              <li class="logout"><a href="<?php echo base_url('index.php/logout'); ?>">Logout</a></li>
            </ul> 

              <p class="navbar-text top-sign2 navbar-right">SY: <?php echo $this->session->userdata('sy'); ?>&nbsp;&nbsp;&nbsp;&nbsp; Term: <?php echo $this->session->userdata('sem'); ?></p>
            	<p class="navbar-text top-sign2 navbar-right">Signed in as <?php echo $this->session->userdata('username'); ?>
	            	<a href="index.php?page=home" class="navbar-link"><?php //echo $_SESSION['uname']; ?></a>
	            </p>
            	<p class="navbar-text navbar-right">
	            	<img src="<?php echo base_url('assets/images/sample.jpg'); ?>"
	            	alt="<?php //echo $name; ?>" class="img-rounded profile_pic">
	            </p>
          </div>
        </div>
            <div class="collapse navbar-collapse panel menu-hide" id="bs-example-navbar-collapse-1">
              <div class="visible-xs">
                
              </div>
            </div>
      </nav>
    </div>
    <div class="row">
    <div class="col-md-3 side-bar-menu">
      <div class="collapse navbar-collapse">
          <div class="panel-heading"><h2><?php //echo $office; ?></h2></div>
          <?php

          $option_header = $this->useroption->getOptionHeader();
          foreach($option_header as $option_h)
          {
              ?>
          <li class="list-group-item">
              <a class="menu">
                  <span class="glyphicon glyphicon-th-list"></span>&nbsp;
                  &nbsp; <?php echo $this->option_header->getHeaderName($option_h['header']); ?>
              </a>
              <?php
              $menu = $this->useroption->getUserMenu($option_h['header']);

              foreach ($menu as $option)
              {
                  $menu_option = $this->option->getOption($option['optionid']);
                  $str = str_replace('/', '-', $menu_option['link']);
                  ?>
                  <ul class="sub-menu">
                      <li class="li-sub-menu">
                          <a class="menu" href="<?php echo base_url('menu/' . $str); ?>">
                              <span class="glyphicon glyphicon-chevron-right"></span>&nbsp;
                              &nbsp; <?php echo $menu_option['desc']; ?>
                          </a>
                      </li>
                  </ul>
              <?php
              }
          }
          ?>
          </li>
          <li class="list-group-item">
              <a class="menu" style="cursor: pointer;" id="change_sy_sem">
                  <span class="glyphicon glyphicon-cog"></span>&nbsp;
                    Change School Year & Sem
              </a>
          </li>
      </div>
    </div>

    <!-- =============================================================================== -->


    <div class="modal fade schoolYear" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="panel">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle close-modal"></span></button>
              <div class="panel-heading"><h4>Add Year and Semester</h4></div>
              <div class="panel-body">
                  <form role="form" method="post" action="index.php?page=addSem">
                    <div class="form-group">
                      <label class="add-label" for="sy">School Year</label>
                      <input type="text" class="form-control" name = "sy" placeholder="school year ">
                    </div>
                    <div class="form-group">
                      <label class="add-label" for="add">Semester</label>
                      <div class="radio col-sm-offset-1">
                          <label>
                            <input type="radio" name="sem" value="1" checked>
                            First Semester
                          </label>
                      </div>
                      <div class="radio col-sm-offset-1">
                          <label>
                            <input type="radio" name="sem" value="2">
                            Second Semester
                          </label>
                      </div>
                    </div>
                    <div class="button-group pull-right">
                      <button type="submit" class="btn btn-primary ">Add</button>
                      <button type="reset" class="btn btn-default ">Reset</button>
                    </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
        <!-- changing semester modal -->
        <div class="modal fade" id="modal_sy_sem">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <form action="sy_sem" id="form_sy_sem">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">School Year & Sem Settings</h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                <div class="col-sm-6">
                                    <input type="number" name="from_sy" max="2015" min="1999" class="form-control" placeholder="To" value="2014">
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="to_sy" readonly value="2015" class="form-control" placeholder="From">
                                </div>

                                <div class="form-group center-block" style="width: 150px;">
                                    <label style="margin: 5px -10px;">Semester</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="1" checked>
                                                First Semester
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="2">
                                                Second Semester
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="3">
                                                Summer
                                            </label>
                                        </div>
                                </div>
                            </p>
                            <span class="clearfix"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>