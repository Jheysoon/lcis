<?php
  $getRefid = $this->account->getpayment($refid);
  $enrolmentid = $this->account->getEnrolmentId($getRefid['billing']);
   $getStud = $this->account->getstudents($getRefid['billing']);
   $course = $this->api->getCourseMajor($getStud['coursemajor']);
   $getPhase = $this->account->getphase($getRefid['phase']);
   $getCash = $this->account->getCashier($getRefid['cashier']);
 ?>

 <div class="container-fluid">
     <div class="col-md-6">
          <form class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" value="<?php echo $getStud['fullname'] ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Course</label>
                <div class="col-sm-9">
                  <input type="text" name="name" value="<?php echo $course ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date OR</label>
                <div class="col-sm-9">
                  <input type="text" name="name" value="<?php echo $getRefid['ordate'] ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phase</label>
                <div class="col-sm-9">
                  <input type="text" name="name" value="<?php echo $getPhase ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
          </form>
     </div>
     <div class="col-md-6">
          <form class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">Billing ID</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $getRefid['billing']; ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-4 control-label">Enrolment ID</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $enrolmentid ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div> -->

              <div class="form-group">
                <label class="col-sm-4 control-label">Cashier.</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $getCash ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">OR NO.</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $getRefid['officialreceipt'] ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Amount</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo number_format($getRefid['amount'], 2) ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
          </form>
     </div>
    </div>
