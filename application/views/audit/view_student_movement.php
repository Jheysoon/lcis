<?php
    $getInfo = $this->account->getstudent($param);
    $getAccountid = $this->account->getAccountids($getInfo['partyid']);
    $total = 0;
    $counter = 1;
 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container" >
		<div class="panel p-body">
      		<div class="panel-heading search">
      			<div class="col-md-6">
      				<h4>Account Movement</h4>
      			</div>
      		</div>
          <br />
              <div class="col-md-6" >
                    <div class="col-md-12 pad-bottom-10">
                      <strong class="strong">Student ID</strong>
                      <input type="text" class="form-control" value = "<?php echo $param ?>" disabled style="background-color:white">
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                      <strong class="strong">First Name</strong>
                      <input type="text" class="form-control" name="firstname" value="<?php echo $getInfo['firstname'] ?>">
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Middle Name</strong>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $getInfo['middlename'] ?>">
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Last Name</strong>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $getInfo['lastname'] ?>">
                    </div>

              </div>
                <div class="table-responsive" style="padding: 20px;">
                  <div class="col-md-12" style="padding:0">
                        <a href="/student-movement/up_mo/<?php echo $param; ?>" class="btn btn-info pull-right" data-toggle="modal">Edit</a>
                        <br /><br />
                  </div>
                    <table class="table table-bordered">
                        <tr>
                            <th class="tbl-header-main">Accounting Set</th>
                            <th class="tbl-header-main">Reference</th>
                            <th class="tbl-header-main">Date</th>
                            <th class="tbl-header-main" style="width:100px">Type</th>

                            <th class="tbl-header-main" >Previous Balance</th>
                            <th class="tbl-header-main" >Amount</th>
                            <th class="tbl-header-main" >Running Balance</th>

                        </tr>
                            <?php
                              $getacad = $this->account->breakAcad($getAccountid);
                              foreach ($getacad as $key => $value):
                              extract($value);
                            ?>
                            <form class="" action="/movement_update" method="post">
                                  <tr><td class="tbl-header-main" colspan="7"><?php echo $sy; ?> &nbsp;&nbsp;&nbsp; SEMESTER: <?php if ($term == 3) { $term = 'Summer'; } echo $term ?> </td></tr>
                                    <?php
                                    $debit = 0;
                                    $credit = 0;
                                    $counter = 1;
                                   foreach ($this->account->getmovement($getAccountid, $acad) as $key => $value):
                                  extract($value);
                                        ?>
                                    <tr>
                                        <td><?php echo $accountingset ?></td>
                                        <td><a href="#"><?php echo $referenceid ?></a></td>
                                        <td><?php echo $systemdate ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $previousbalance; ?></td>
                                        <td><?php echo $amount; ?>
                                              <!-- <input type="text" class="form-control pull-right" name="<?php echo "am-".$counter ?>" value="<?php echo $amount; ?>" style="width:150px;text-align:right">
                                              <input type="hidden" class="form-control pull-right" name="<?php echo "id-".$counter ?>" value="<?php echo $id; ?>"> -->

                                        </td>
                                        <td><?php echo $runbalance ?></td>
                                        <?php $total += $amount; ?>
                                    </tr>
                                  <?php
                                        $counter += 1;
                                       endforeach;
                                 ?>
                                  <tr>
                                    <input type="hidden" value="<?php echo $param ?>" name="param">
                                    <input type="hidden" name="accountid" value="<?php echo $getAccountid ?>">
                                    <input type="hidden" name="count" value="<?php echo  $counter ?>">
                                    <td class="tbl-header" colspan="6">Total: <?php echo $counter ?></td>
                                    <!-- <td class="tbl-header"><button type="submit" class="btn btn-info pull-right" name="button">Save & Recalculate</button>  </td> -->
                                    <td class="tbl-header" style="text-align:right"><strong><?php echo $total; ?></strong><label for="">&nbsp;&nbsp;&nbsp;</label></label>
                                </tr>
                          </form>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="6" style="background-color:#2f5836"><h4>Total Balance</h4></td>
                                <td  style="text-align:right;background-color:#2f5836"><h4 style="padding:0"><strong><?php echo number_format($total, 2); ?><label>&nbsp;&nbsp;&nbsp;</label></strong></h4></td>
                            </tr>
                    </table>
                </div>
                <div class="modal fade" id="add_movement" data-backdrop="false">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Movement</h4>
                      </div>
                      <div class="modal-body">
                            <div class="container-fluid">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label ">Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="type">
                                                  <option value="D">Debit</option>
                                                  <option value="D">Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Amount</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Academicterm</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="academicterm">
                                          <?php foreach ($this->account->acad() as $key => $vals):
                                            extract($vals);
                                             ?>
                                            <option value="<?php echo $acad ?>">
                                              <?php
                                              if ($term == 3) {
                                                $term = 'Summer';
                                              }elseif($term == 1){
                                                $term = $term . "st Semester";
                                              }else{
                                                  $term = $term . "nd Semester";
                                              }
                                              echo $sy ."|". $term; ?>
                                            </option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                </form>
                            </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


    </div>
</div>