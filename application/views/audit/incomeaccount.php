<?php
  $getCat = $this->account->getCategory();

 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
      		<div class="panel-heading search">
      			<div class="col-md-6">
      				<h4>List of Account</h4>
      			</div>
      		</div>
          		<div class="panel-body">
                <form class="form form-horizontal col-md-4" action="index.html" method="post">
                  <!-- <div class="form-group"> -->
                    <label class="col-md-4" for="">Select Category <?php echo $param ?></label>

                      <select class="form-control col-md-8 col-md-offset-4" name="" onchange="category(this)">
                          <?php foreach ($getCat as $key => $value):
                              extract($value);
                             ?>

                             <?php if ($param == $id): ?>
                                   <option value="/accountasset/<?php echo strtolower($description). '/' . $id ?>" onclick="" selected><?php echo $description; ?></option>
                            <?php else: ?>
                                     <option value="/accountasset/<?php echo strtolower($description). '/' . $id ?>" onclick=""><?php echo $description; ?></option>
                             <?php endif; ?>
                          <?php endforeach; ?>
                      </select>
                  <!-- </div> -->
                </form>
              		<div id="studlist_wrapper" class="table-responsive col-md-12">
                          <table class="table table-striped table-bordered table-hover">
                              <tr>
                                  <th>Name</th>
                                  <th colspan="2">Action</th>
                              </tr>

                          </table>
          		    </div>
          		</div>
	  </div>
      <script type="text/javascript">
      function category(id){
        location.href = id.value;
      }

      </script>
