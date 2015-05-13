
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
              <h3>Update Subject Form</h3>
              <hr/>
            </div>

            <div class="col-md-6">

              <div class="form-group col-md-12">
                <label for="subname">Code</label>
                <input type="text" class="form-control" value="<?php echo $code; ?>" name="code" placeholder="Code">
              </div>

              <div class="form-group col-md-12">
                <label for="title">Descriptive Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $descriptivetitle; ?>" placeholder="Descriptive Title">
              </div>

              <div class="form-group col-md-7">
                <label for="shortname">Short Name</label>
                <input type="text" class="form-control" value="<?php echo $shortname; ?>" name="shortname" placeholder="Shortname">
              </div>

              <div class="form-group col-md-5">
                <label for="units">Units</label>
                <input type="number" maxlength="1" value="<?php echo $units; ?>" class="form-control" name="units" placeholder="Units">
              </div>

              <div class="form-group col-md-6">
                <label for="hours">Hours</label>
                <input type="number" maxlength="1" class="form-control" value="<?php echo $hours; ?>" name="hours" placeholder="Hours">
              </div>

              <div class="form-group col-md-6">
                <label for="booklet">Booklet Charge</label>
                <input type="number" minlength="1" value="<?php echo $bookletcharge; ?>" class="form-control" name="booklet" placeholder="Booklet Charge">
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group col-md-12">
                <label for="major">Major Subject</label>
                <select class="form-control" name="major">
                  <option value="0">Select Major </option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label for="group">Group</label>
                <select class="form-control" name="group">
                  <option value="0">Select Group </option>
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
              </div>

              <div class="form-group col-md-4">
                <label for="title">GE Subject</label>
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
              </div>

              <div class="form-group col-md-4">
                <label for="title">Computer Subject</label>
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