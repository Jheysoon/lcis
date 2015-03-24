<?php 
  $result   = getEmpInfo($_SESSION['id']);
  $row      = mysql_fetch_row($result);
  $name     = $row[2]." ".$row[4];
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
              <img class="img-logo" src="./images/LC Logo.jpg"><h2 class="hd-title"><a class="title" href="">LEYTE COLLEGES Information System</a></h2>
            </div>
          </div>

          <div class="collapse navbar-collapse pull-right">
            <ul class="nav navbar-nav top-sign navbar-right">
              <li class="logout"><a href="index.php?page=logout">Logout</a></li>
            </ul> 

              <p class="navbar-text top-sign2 navbar-right">SY: 2014-2015 &nbsp;&nbsp;&nbsp;&nbsp; Term: First Semester</p>
            	<p class="navbar-text top-sign2 navbar-right">Signed in as &nbsp;
	            	<a href="index.php?page=home" class="navbar-link"><?php echo $_SESSION['uname']; ?></a>
	            </p>
            	<p class="navbar-text navbar-right">
	            	<img src="images/sample.jpg" 
	            	alt="<?php echo $name; ?>" class="img-rounded profile_pic">	
	            </p>
          </div>
        </div>
            <div class="collapse navbar-collapse panel menu-hide" id="bs-example-navbar-collapse-1">
              <div class="visible-xs">
                <?php 
          		    menu();
                ?>
              </div>
            </div>
      </nav>
    </div>
    <div class="row">
    <div class="col-md-3 side-bar-menu">
      <div class="collapse navbar-collapse">
          <?php
             if ($_SESSION['uname'] == 'registrar' ) {
                $office = "REGISTRAR'S Menu";
             }
             elseif ($_SESSION['uname'] == 'dean' ) {
                $office = "DEAN'S Menu";
             }
             elseif ($_SESSION['uname'] == 'edp' ) {
                $office = "EDP'S Menu";
             }
             elseif ($_SESSION['uname'] == 'cashier' ) {
                $office = "CASHIER'S Menu";
             }
             elseif ($_SESSION['uname'] == 'instructor' ) {
                $office = "INSTRUCTOR'S Menu";
             }
             elseif ($_SESSION['uname'] == 'faculty' ) {
                $office = "TEACHER'S Menu";
             }
             elseif ($_SESSION['uname'] == 'comptroller' ) {
                $office = 'ACCOUNTING Menu';
             }
             elseif ($_SESSION['uname'] == 'audit' ) {
                $office = "AUDIT'S Menu";
             }
             elseif ($_SESSION['uname'] == 'student' ) {
                $office = "STUDENT'S Menu";
             }
             elseif ($_SESSION['uname'] == 'hr' ) {
                $office = "HUMAN RESOURCE'S Menu";
             }
            ?><div class="panel-heading"><h2><?php echo $office; ?></h2></div><?php
           	menu();
          ?>
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

<?php 

  function menu(){
     if ($_SESSION['uname'] == 'registrar' ) {
       include 'view/templates/registrar_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'dean' ) {
       include 'view/templates/dean_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'cashier' ) {
       include 'view/templates/cashier_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'edp' ) {
       include 'view/templates/edp_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'faculty' ) {
       include 'view/templates/faculty_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'comptroller' ) {
       include 'view/templates/controller_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'instructor' ) {
       include 'view/templates/instructor_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'audit' ) {
       include 'view/templates/audit_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'student' ) {
       include 'view/templates/student_menu.php'; 
     }
     elseif ($_SESSION['uname'] == 'hr' ) {
       include 'view/templates/hr_menu.php'; 
     }
  }

 ?>