<?php
  $enrolmentid = $this->account->getEnrolmentId($refid);
  $unit = $this->account->getTotalUnit($enrolmentid);
  $getBillDetail = $this->account->getBillDetail($refid);
  $misc = $this->account->get_miscellaneous($refid);
  $t_units= $this->account->get_sub_unit($enrolmentid);
  $total = 0;
  $counter = 0;
  $getStud = $this->account->getstudents($refid);
  $course = $this->api->getCourseMajor($getStud['coursemajor']);

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
          </form>
     </div>
     <div class="col-md-6">
          <form class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">Billing ID</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $refid ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Enrolment ID</label>
                <div class="col-sm-8">
                  <input type="text" name="name" value="<?php echo $enrolmentid ?>" class="form-control" disabled style="background-color: #fff">
                </div>
              </div>
          </form>
     </div>
   <!-- Table for Payments -->
   <div class="table-responsive col-md-6" style="padding:0;">
       <table class="table table-bordered">
         <tr ><td colspan="4" style="background-color:#2f5836"><h4>Bill Detail</h4></td></tr>
           <tr>
               <th class="tbl-header-main">Description</th>
               <th class="tbl-header-main">Units</th>
               <th style="text-align:right" class="tbl-header-main">Rate</th>
               <th style="text-align:right" class="tbl-header-main">Total</th>
           </tr>
            <tr>
              <td>MISCELLANEOUS</td>
              <td></td>
              <td style="text-align:right"><?php echo number_format($misc,2);
                                                  $total += $misc; 
                                                    $counter += 1;
                                                  ?></td>
           </tr>
           <?php foreach ($getBillDetail as $x): ?>
             <tr>
               <td><?php echo $x['description']; ?></td>
               <?php if ($x['description'] == 'TUITION' OR $x['description'] == 'MATRICULATION'): ?>
                 <td>
                    <?php echo $t_units ?>
                 </td>
               <?php else: ?>
                <td></td>
               <?php endif ?>
               <!-- <td><?php echo $unit; ?></td> -->
               <td style="text-align:right"><?php echo $x['rate']; ?></td>
               <td style="text-align:right"><?php echo number_format($x['amount'], 2); ?></td>
             </tr>
           <?php
           $total += $x['amount'];
           $counter += 1;
         endforeach; ?>

       
        <?php for ($i=$counter; $i < 5;  $i++) { ?>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
        <?php  } ?>
           <tr>
               <td colspan="3" style="background-color:#2f5836"><h4>Total</h4></td>
               <td  style="text-align:right;background-color:#2f5836"><h4 style="padding:0"><strong><?php echo number_format($total, 2); ?><label>&nbsp;&nbsp;&nbsp;</label></strong></h4></td>
           </tr>
       </table>
   </div>


   <?php
      $billclass = $this->account->billclass($enrolmentid);

    ?>
   <div class="table-responsive col-md-6" style="padding:0;">
       <table class="table table-bordered">
         <tr ><td colspan="2" style="background-color:#2f5836"><h4>Installment</h4></td></tr>
           <tr>
               <th class="tbl-header-main">Phase</th>
               <th class="tbl-header-main" style="text-align:right">Amount</th>
           </tr>
             <tr>
               <td>Enrolment</td>
               <td style="text-align:right"><?php echo $billclass['netenrolment']; ?></td>
             </tr>
             <tr>
               <td>Prelims</td>
               <td style="text-align:right"><?php echo $billclass['netprelim']; ?></td>
             </tr>
             <tr>
               <td>Midterm</td>
               <td style="text-align:right"><?php echo $billclass['netprelim']; ?></td>

             </tr>
             <tr>
               <td>Semi Final</td>
               <td style="text-align:right"><?php echo $billclass['netprelim']; ?></td>
             </tr>
             <tr>
               <td>Final</td>
               <td style="text-align:right"><?php echo $billclass['netprelim']; ?></td>
             </tr>
             <?php
             $counter -= 5;
              for ($i=0; $i < $counter; $i++) { ?>
                <tr>
                  <td>&nbsp;</td>
                  <td style="text-align:right">&nbsp;</td>
                </tr>
              <?php }       ?>
           <tr>
               <td colspan="" style="background-color:#2f5836"><h4>Total</h4></td>
               <td  style="text-align:right;background-color:#2f5836"><h4 style="padding:0"><strong><?php echo number_format($total, 2); ?><label>&nbsp;&nbsp;&nbsp;</label></strong></h4></td>
           </tr>
       </table>
   </div>
<?php

  $subj_unit = $this->account->getUnit($enrolmentid);
 ?>
   <div class="table-responsive col-md-12" style="padding:0;">
       <table class="table table-bordered">
         <tr >
           <td style="background-color:#2f5836"><h4>Subject</h4></td>
           <td  style="background-color:#2f5836"><h4>Number of Subject&nbsp;&nbsp;:&nbsp;&nbsp;<strong><?php echo $subj_unit['numberofsubject']; ?></strong></h4></td>
           <td style="background-color:#2f5836"><h4>Total Unit&nbsp;&nbsp;:&nbsp;&nbsp;<strong><?php echo $subj_unit['totalunit']; ?></strong></h4></td>
         </tr>
           <tr>
               <th class="tbl-header-main">Code</th>
               <th class="tbl-header-main">Descriptive Title</th>
               <th style="text-align:right" class="tbl-header-main">Units</th>
           </tr>
           <?php foreach ($this->account->getSubject($enrolmentid) as $subs): ?>
             <tr>
               <td><?php echo $subs['code']; ?></td>
               <td><?php echo $subs['descriptivetitle']; ?></td>
               <td style="text-align:right"><?php echo $subs['units']; ?></td>
             </tr>
           <?php
         endforeach; ?>
       </table>
   </div>

    </div>
