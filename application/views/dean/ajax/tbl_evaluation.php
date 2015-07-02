<?php
	$res = $this->student->getClassAloc($term, $student, $coursemajor);
	$legid = $id;
	$registration = $this->student->getRegID($student);

	if ($message == '') {
		$eval = $this->student->checkEvaluation($student, $term);
		if ($eval) {
			$Evalue = $this->student->getEvaluation($eval['id']);
			foreach ($Evalue as $key => $value) {
				$select[] = $value['classallocation'];
			}
		}
	}
 ?>
<div class="table-responsive" id="evaluation">
				<form class="form" action="/dean/evaluation/<?php echo $legid; ?>" method="post" role="form">
					<input type="hidden" name="student" value="<?php echo $student; ?>">
					<input type="hidden" name="coursemajor" value="<?php echo $coursemajor; ?>">
					<input type="hidden" name="registration" value="<?php echo $registration; ?>">
					<input type="hidden" name="academicterm" value="<?php echo $term; ?>">
						<!-- <tr>
							<td colspan="5">
								<input style="width: 70px;" class="pull-right form-control" name="counter" readonly type="text" value ='<?php echo $units; ?>'>
								<label class="pull-right">Max Units &nbsp;&nbsp;&nbsp;</label>
							</td>
						</tr><br/><br/>
 -->					<table class="table table-bordered table-hover" id = "tabletest">
						<tr class="main-table-header">
							<th  style="background: #2F5836" colspan="7">
								<h4 style="float: left">Select Subject</h4>
							</th>
						</tr>
						<tr>
							<th width="25"></th>
							<th>Days</th>
							<th>Period</th>
							<th>Room</th>
							<th>Location</th>
							<th width="10">Reserved</th>
							<th width="10">Enrolled</th>
						</tr>
						<?php
							$ctr = 1;
							$ctr2 = 1;
							foreach ($res as $aloccation) {
								$sub = $this->student->getSubDetail($aloccation['subject']);
						?>
								<tr>
									<td class="tbl-header" colspan="2"><strong>Code: </strong><?php echo $sub['code']; ?></td>
									<td class="tbl-header" colspan="4"><strong>Subject: </strong><?php echo $sub['descriptivetitle']; ?></td>
									<td class="tbl-header"><strong>Units: </strong><?php echo $sub['units']; ?></td>
								</tr>
						<?php

								$sched = $this->student->getSched($term, $aloccation['subject']);
								foreach ($sched as $aloc) {
									$p = $this->edp_classallocation->getPeriod($aloc['id']);
									$d = $this->edp_classallocation->getDayShort($aloc['id']);


									$ss = '';
									// $cl = $this->student->getRoom($aloc['classroom']);
									$cl = array('loc'=> '','legacycode'=>'');
									$reserved = $this->student->getReserved($aloc['id']);
									$enrolled = $this->student->getEnrolled($aloc['id']);
								?>
									<tr onclick="clickRow(<?php echo $ctr.','.$ctr2.','.$sub['units']; ?>)">
										<td  id = 'r-<?php echo "$ctr"; ?>' >
										    <input
										    	class="rad-<?php echo $ctr; ?>"
										    	type="radio"
										    	name = "rad-<?php echo $ctr; ?>"
										    	id = "rad-<?php echo $ctr2; ?>"
										    	value = "<?php echo $aloc['id']; ?>"
										    	<?php
										    		if (isset($select)) {
														if (in_array($aloc['id'], $select)) {
															echo 'checked';
														}
										    		}
										    		echo  set_radio('rad-'.$ctr, $aloc['id']);
										    	?>
										    >
										</td>
										<td><?php echo $d; ?></td>
										<td><?php echo $p; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['legacycode']; ?></td>
										<td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['loc']; ?></td>
										<td style="text-align: center;"><?php echo $reserved['reserved']; ?></td>
										<td style="text-align: center;"><?php echo $enrolled['enrolled']; ?></td>
									</tr>
						<?php
								$ctr2++;}$ctr++;
							}
						 ?>

					</table>
					<table class="table table-bordered table-hover" id = "tblAddSubject">
					<tr class="main-table-header">
						<th  style="background: #2F5836" colspan="8">
							<h4 style="float: left">Additional Subject</h4>
							<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addEvalSub">Add Subject</button>
						</th>
					</tr>
						<tr>
							<th >Subject</th>
							<th >Days</th>
							<th >Period</th>
							<th >Room</th>
							<th >Location</th>
							<th width="10">Reserved</th>
							<th width="10">Enrolled</th>
							<th width="100">Action</th>
						</tr>
						<?php
							if ($ret) {
								foreach ($ret as $key => $cid) {
						            $sub = $this->student->getSubject($cid);

						            $p = $this->edp_classallocation->getPeriod($cid);
						            $d = $this->edp_classallocation->getDayShort($cid);

						            $reserved = $this->student->getReserved($cid);
						            $enrolled = $this->student->getEnrolled($cid);
								?>
						            <tr>
						                <input type='hidden' name='additional[]' value='<?php echo $cid; ?>'>
						                <td><?php echo $sub['code']; ?></td>
						                <td><?php echo $d; ?></td>
						                <td><?php echo $p; ?></td>
						                <td></td>
						                <td></td>
						                <td><?php echo $reserved['reserved']; ?></td>
						                <td><?php echo $enrolled['enrolled']; ?></td>
						                <td>
						                    <button type='button' class='btn btn-danger remove' data-param='<?php echo $sub['code']; ?>'>Remove
						                    <span class='glyphicon glyphicon-trash'></span></button>
						                </td>

						            </tr> <?php
								}
							}
						 ?>
					</table>
					<input type='hidden' name='count' value = '<?php echo $ctr; ?>'>
					<input type='hidden' name='legid' value = '<?php echo $legid; ?>'>
					<div class="form-group">
						<!-- <a class="btn btn-info" href="/dean/calculatebill/50">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></a> -->
						<button type="submit" name="btn" value="1" class="btn btn-primary pull-right">Summarize and Validate  <span class="glyphicon glyphicon-pencil"></span></button>
					</div>
				</form>
			</div>

<!-- Modal -->
<div class="modal fade" id="addEvalSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false" style="background: rgba(0,0,0, .5)">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header panel-heading ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add subject</h4>
      </div>
      <div class="modal-body col-md-12"  style="background-color: #fff;">
            <form id = "searchSubject" class="navbar-form navbar-right col-md-12" role="search" onsubmit="return false">
            	<input type="hidden" name="term" value="<?php echo $term; ?>">
            	<input type="hidden" name="student" value="<?php echo $student; ?>">
            	<input type="hidden" name="coursemajor" value="<?php echo $coursemajor; ?>">
                <div class="form-group">
                    <input type="text" type="text" name="subject" id="inputdata" class="form-control" required autocomplete="off" placeholder="Subject">
                </div>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>
            <div id="alert1" class="alert alert-info" role="alert">
                  <strong>Please search a subject!</strong>
            </div>
            <div id="alert2" class="alert alert-danger" role="alert">
                  <strong>Subject not found! Please search another subject!</strong>
            </div>
			<form id="modal-table" class="form" role="form" onsubmit="return false">
            	<div id = "div_eval">
	            <?php
	            	// echo $term;
	            	$param = array(
	            		'term' => $term,
	            		'student' => $student,
	            		'coursemajor' => $coursemajor,
	            		'subject' => ''
	            	);
	            	$this->load->view('dean/ajax/modal_evaluation', $param)
	            ?>
            	</div>
		      		<div class="pull-right">
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary">Save</button>
		        	</div>
	        </form>
      </div>
    </div>
  </div>
</div>
