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
                      <input type="text" class="form-control" name="firstname" value="<?php echo $getInfo['firstname'] ?>" disabled>
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Middle Name</strong>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $getInfo['middlename'] ?>" disabled>
                    </div>
                    <div class="col-md-12 pad-bottom-10">
                        <strong class="strong">Last Name</strong>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $getInfo['lastname'] ?>" disabled>
                    </div>

              </div>
                <div class="table-responsive" style="padding: 20px;">
                  <div class="col-md-12" style="padding:0">
                        <a href="/student-movement/up_mo/<?php echo $param; ?>" class="btn btn-info pull-right" data-toggle="modal">Edit</a>
                        <br /><br />
                  </div>
                    <table class="table table-bordered">
                        <tr>
                            <th class="tbl-header-main">Date</th>
                            <th class="tbl-header-main">Reference Type</th>
                            <th class="tbl-header-main">Reference ID</th>
                            <th class="tbl-header-main">Description</th>
                            <th class="tbl-header-main">Type</th>
                            <th class="tbl-header-main" style="text-align:right">Amount</th>
                            <th class="tbl-header-main" style="text-align:right">Running Balance</th>
                        </tr>
                            <?php
                              $getacad = $this->account->breakAcad($getAccountid);

                              $prevs = 0;
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
                                        <td><?php echo $systemdate ?></td>
                                        <td><a href="#"><?php echo $referencetype ?></a></td>
                                        <td><a class="ch" href="#" data-refid="<?php echo $referenceid ?>" data-reftype="<?php echo $referencetype ?>" data-toggle="modal" data-target="#myModal"><?php echo $referenceid ?></a></td>
                                        <td><?php echo $description ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td  style="text-align:right"><?php echo number_format($amount, 2); ?></td>
                                        <td  style="text-align:right"><?php echo number_format($prevs + $amount,2) ?></td>
                                        <?php
                                        $total += $amount;
                                          $prevs += $amount ;
                                        ?>
                                    </tr>
                                  <?php
                                        $counter += 1;
                                       endforeach;
                                 ?>
                                  <tr>
                                    <input type="hidden" value="<?php echo $param ?>" name="param">
                                    <input type="hidden" name="accountid" value="<?php echo $getAccountid ?>">
                                    <input type="hidden" name="count" value="<?php echo  $counter ?>">
                                    <td class="tbl-header" colspan="6">Total:</td>
                                    <!-- <td class="tbl-header"><button type="submit" class="btn btn-info pull-right" name="button">Save & Recalculate</button>  </td> -->
                                    <td class="tbl-header" style="text-align:right"><strong><?php echo $total; ?></strong><label for="">&nbsp;&nbsp;&nbsp;</label></label>
                                </tr>
                          </form>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="6" style="background-color:#2f5836"><h4>Current Balance</h4></td>
                                <td  style="text-align:right;background-color:#2f5836"><h4 style="padding:0"><strong><?php echo number_format($total, 2); ?><label>&nbsp;&nbsp;&nbsp;</label></strong></h4></td>
                            </tr>
                    </table>
                </div>



            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reference Detail</h4>
                  </div>
                  <div class="modal-body" id="mods">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>


    </div>
</div>
