    <?php
        $this->load->view('templates/header');
        $this->load->view('templates/header_title1');
    ?>
    <!-- =================================== login ===================================== -->
    <div class="row">
      <div class="col-md-12 header">
          <div class="jumbotron col-md-8">
            <div class="col-md-offset-4 col-md-3">
              <img class="login-pic" src="<?php echo base_url('assets/images/LC Logo.jpg'); ?>">
            </div>
          </div>

          <div class = "col-md-4">
              <?php
                  $attrib = array('class'=>'form-horizontal login','role'=>'form');
                  echo form_open('',$attrib);
              ?>
            <!--<form class="form-horizontal login" method="post" action="." role="form">-->
                <h2 class="sign">
                    <b>Sign in</b>
                </h2>
                <br/>
                <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                <!--<input type="hidden" name="page" value="validate">-->
                <div class="form-group">
                <!--<label for="username" class="col-sm-3 control-label">Username</label>-->
                    <?php echo form_label('Username','username',['class'=>'col-sm-3 control-label']); ?>
                <div class="col-sm-9">
                  <!--<input id="username" type="text" class="form-control" name="username"
                         required placeholder="Username" value="" autofocus>-->
                    <?php
                        $attrib = array('name'=>'username','id'=>'username','placeholder'=>'Username',
                            'class'=>'form-control');
                        echo form_input($attrib,'','required autofocus');
                    ?>
                </div>
              </div>
              <div class="form-group">
                <!--<label for="password" class="col-sm-3 control-label">Password</label>-->
                  <?php echo form_label('Password','password',['class'=>'col-sm-3 control-label']); ?>
                <div class="col-sm-9">
                  <!--<input type="password" class="form-control" name="password" required
                  id="password" placeholder="Password">-->
                    <?php
                        $attrib = array('class'=>'form-control','name'=>'password','placeholder'=>'Password');
                        echo form_password($attrib,'','required');
                    ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <!--<button type="submit" class="btn btn-success">Sign in</button>-->
                    <?php echo form_submit(['class'=>'btn btn-success'],'Sign in'); ?>
                </div>
              </div>
            <!--</form>-->
              <?php echo form_close(); ?>
          </div>
          <br>
      </div>
    </div>
    <!-- =============================================================================== -->


    <!-- =================================== body ====================================== -->
      <div class="row">
        <div class="col-md-12 bg-panel">
          <div class="row">

            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <div class="caption">
                  <h3>Goal</h3><hr/>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <div class="caption">
                  <h3>Mission</h3><hr/>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <div class="caption">
                  <h3>Vision</h3><hr/>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    <!-- =============================================================================== -->
    <?php $this->load->view('templates/footer'); ?>