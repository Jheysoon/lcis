<?php 	
	$res = $this->student->getStudInfo($id);
	extract($res);
	if ($major != 0) {
		$r  = $this->student->getMajor($major);
		$description = $description." ( ".$r['des']." )";
	}
	$sys = $this->api->systemValue();
	$term = $sys['phaseterm'];
	$sy = $this->student->getAcTerm($term);
	$yl = $this->api->getYearLevel($pid);
	extract($yl);
	if ($level < 4 and $count != 0) {
		if ($count%2 != 1) {
			$level = $level + 1;
		}
	}

	if ($level == 1 || $level == 0) {
		$level = 'FIRST';
		$lvl = 1;
	}
	else if($level == 2){
		$level = 'SECOND';
		$lvl = 2;
	}
	else if($level == 3){
		$level = 'THIRD';
		$lvl = 3;
	}
	else{
		$level = 'FOURTH';
		$lvl = 4;
	}

	$un = $this->student->getUnit($curriculum, $lvl, $sy['term']);
	$cur = $this->student->getAllCur($curriculum);
	$cur = extract($cur);
	$cur = $systart."-".$syend;
 ?>
<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		
		<div class="panel-heading search">
			<h4>Pre Enrollment Evaluation</h4>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<?php 
					echo $message;
				 ?>
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT ID</label>
				<input class="form-control" type="text" readonly value="<?php echo $id; ?>">							
			</div>
			<div class="col-md-6 ">
				<label class="lbl-data">STUDENT NAME</label>
				<input class="form-control" type="text" readonly value="<?php echo $res['lastname'].", ".$res['firstname'] ?>">							
			</div>

			<div class="col-md-3 ">
				<label class="lbl-data">SCHOOL YEAR</label>
				<input class="form-control" type="text" readonly value="<?php echo $sy['systart'].'-'.$sy['syend']; ?>">							
			</div>

			<div class="col-md-3 ">
				<label class="lbl-data">TERM</label>
				<input class="form-control" type="text" readonly value="<?php echo $sy['term']; ?>">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">YEAR LEVEL</label>
				<input class="form-control" type="text" readonly value="<?php echo $level.' YEAR'; ?>">							
			</div>

			<div class="col-md-6 ">
				<label class="lbl-data">COURSE</label>
				<input class="form-control" type="text" readonly value="<?php echo $description; ?>">							
			</div>

			<div class="col-md-4 ">
				<label class="lbl-data">CURRICULUM</label>
				<input class="form-control" type="text" readonly value="<?php echo $cur; ?>">							
			</div>
			
			<div class="col-md-2">
						<br/><br/>
                        <a class="btn btn-primary pull-right" href="/lc_curriculum/viewcurriculum/<?php echo $pid; ?>/<?php echo $dte; ?>/<?php echo $cid; ?>" target="_blank" style="margin-right:10px">View Curriculum</a>
			</div>
			<div class="col-md-12">&nbsp;</div>
		<div class="col-md-12" id="tbl-eval">		
			<?php 
				$data['term'] = $term;
				$data['id'] = $id;
				$data['student'] = $pid;
				$data['units'] = $un['unit'];
				$data['coursemajor'] = $cid;
				$this->load->view('dean/ajax/tbl_evaluation', $data); 
			?>
		</div>

		</div>
		</div>
	</div>
</div>