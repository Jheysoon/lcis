<?php
    $getInfo = $this->account->getstudent($param);
    $getAccountid = $this->account->getAccountids($getInfo['partyid'])

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
                    <table class="table table-bordered">
                        <tr>
                          <th>Accounting Set</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                        </tr>
                            <?php
                              $getacad = $this->account->breakAcad(1);
                              foreach ($getacad as $key => $value):
                              extract($value);
                            ?>
                              <tr><td class="tbl-header-main" colspan="6"><?php echo $sy; ?> &nbsp;&nbsp;&nbsp; SEMESTER: <?php if ($term == 3) { $term = 'Summer'; } echo $term ?> </td></tr>
                                <?php
                                $debit = 0;
                                $credit = 0;
                               foreach ($this->account->getmovement(1, $acad) as $key => $value):
                              extract($value);
                                ?>
                            <tr>
                              <?php if ($type == 'C'): ?>
                                  <td><?php echo $accountingset ?></td>
                                  <td><?php echo $referenceid ?></td>
                                  <td><?php echo $systemdate ?></td>
                                  <td>0</td>
                                  <td><?php echo $amount; ?></td>
                                  <td><?php echo $runbalance ; ?></td>
                                  <?php
                                    $credit += $amount
                                   ?>
                              <?php else: ?>
                                  <td><?php echo $accountingset ?></td>
                                  <td><?php echo $referenceid ?></td>
                                  <td><?php echo $systemdate ?></td>
                                  <td><?php echo $amount; ?></td>
                                  <td>0</td>
                                  <td><?php echo $runbalance; ?></td>
                                  <?php
                                    $debit += $amount;
                                   ?>
                              <?php endif; ?>
                            </tr>
                              <?php endforeach; ?>
                          <tr>
                            <td class="tbl-header-main" colspan="3">Total Balance:</td>
                            <td class="tbl-header-main"><?php echo $debit ?></td>
                            <td class="tbl-header-main"><?php echo $credit ?></td>
                            <td class="tbl-header-main"><?php echo $debit - $credit ?></td>

                        </tr>
                            <?php endforeach; ?>

                    </table>
                </div>

              <div>
      </div>
    </div>
</div>
