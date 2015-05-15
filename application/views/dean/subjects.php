
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">

  		<div class="panel p-body">
    		<div class="panel-heading search">
          <h4>Subject</h4>
        </div>
        <div class="panel-body">

          <form class="form" method="post" action="/dean/save_subject" role="form">
          <input type="hidden" name="sid" value="<?php echo $sid; ?>">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('message'); ?>
              <h3>Subject Form</h3>
              <hr/>
            </div>

            <div class="col-md-6">

              <div class="form-group col-md-12">
                <label for="subname">Code</label>
                <input type="text" class="form-control" required value="<?php echo $code; ?>" name="code" placeholder="Code">
              </div>

              <div class="form-group col-md-12">
                <label for="title">Descriptive Title</label>
                <input type="text" class="form-control" required name="title" value="<?php echo $descriptivetitle; ?>" placeholder="Descriptive Title">
              </div>

              <div class="form-group col-md-7">
                <label for="shortname">Short Name</label>
                <input type="text" class="form-control" value="<?php echo $shortname; ?>" name="shortname" placeholder="Shortname">
              </div>

              <div class="form-group col-md-5">
                <label for="units">Units</label>
                <input type="number" minlength="1" required value="<?php echo $units; ?>" class="form-control" name="units" placeholder="Units">
              </div>

              <div class="form-group col-md-6">
                <label for="hours">Hours</label>
                <input type="number" minlength="1" required class="form-control" value="<?php echo $hours; ?>" name="hours" placeholder="Hours">
              </div>

              <div class="form-group col-md-6">
                <label for="booklet">Booklet Charge</label>
                <input type="number" minlength="1" required value="<?php echo $bookletcharge; ?>" class="form-control" name="booklet" placeholder="Booklet Charge">
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group col-md-12">
                <label for="major">Major Subject</label>
                <select class="form-control" name="major">
                  <option value="0">Major Subject</option>
                  <option value="1">Not Major Subject</option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label for="major">College</label>
                <select class="form-control" name="owner">
                    <?php 
                        if($owner == 0)
                        {
                    ?>
                        <option value="0">Select College</option>
                    <?php 
                        } 
                        $col = $this->college->all();
                        foreach($col as $college)
                        {
                            if($owner == $college['id'])
                            {
                    ?>
                        <option value="<?php echo $college['id']; ?>" selected><?php echo $college['description']; ?></option>
                    <?php
                            }
                            else
                            {
                        
                    ?>
                         <option value="<?php echo $college['id']; ?>"><?php echo $college['description']; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label for="group">Group</label>
                <select class="form-control" name="group">
                  <?php 
                        $gr = $this->group->all();
                        foreach($gr as $g)
                        {
                    ?>
                    <option value="<?php echo $g['id']; ?>"><?php echo $g['description']; ?></option>
                    <?php
                        }
                   ?>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="title">Non Academic</label>
                <?php if($academic == 0) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="academic" value="1">
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="academic" value="0" checked>
                    No
                  </label>
                </div>
                <?php }else{ ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="academic" value="1" checked>
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="academic" value="0">
                    No
                  </label>
                </div>
                <?php } ?>
              </div>

              <div class="form-group col-md-4">
                <label for="title">GE Subject</label>
                <?php if($ge == 0){ ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="ge" value="1">
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="ge" value="0" checked>
                    No
                  </label>
                </div>
                <?php }else{ ?>
                    <div class="radio">
                  <label>
                    <input type="radio" name="ge" value="1" checked>
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="ge" value="0">
                    No
                  </label>
                </div>
                <?php } ?>
              </div>

              <div class="form-group col-md-4">
                <label for="title">Computer Subject</label>
                <?php if($comp == 0){ ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="comp" value="1">
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="comp" value="0" checked>
                    No
                  </label>
                </div>
                <?php }else{ ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="comp" value="1" checked>
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="comp" value="0">
                    No
                  </label>
                </div>
                <?php } ?>
              </div>

            </div>
            <div class="col-md-12">
              <hr/>
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Save</button>
              </div>
            </div>

          </form>
        </div>
      </div>
  </div>