<?php $sub = $this->student->getSubDetail($subject);?>
<div class="table-responsive col-md-12">
	<table class="table table-bordered">
            <tr>
                <td class="tbl-header" colspan="2"><strong>Code: </strong><?php echo $sub['code']; ?></td>
                <td class="tbl-header" colspan="4"><strong>Subject: </strong><?php echo $sub['descriptivetitle']; ?></td>
                <td class="tbl-header"><strong>Units: </strong><?php echo $sub['units']; ?></td>
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
                $sched = $this->student->getSched2($term, $subject);
                $ctr = 1;
                foreach ($sched as $aloc) {
                	$p = $this->edp_classallocation->getPeriod($aloc['id']);
                	$d = $this->edp_classallocation->getDayShort($aloc['id']);

                    $cl = $this->edp_classallocation->getRoom($aloc['id']);
                	// $cl = array('location'=> '','room'=>'');
                	$reserved = $this->student->getReserved($aloc['id']);
                	$enrolled = $this->student->getEnrolled($aloc['id']);
                ?>
                    <tr class="md">
                        <td  id = 'r-<?php echo "$ctr"; ?>' >
                            <input
                                class="rad-<?php echo $ctr; ?>"
                                type="radio"
                                name = "choose"
                                value = "<?php echo $aloc['id']; ?>"
                            >
                        </td>
                        <td><?php echo $d; ?></td>
                        <td><?php echo $p; ?></td>
                        <td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['room']; ?></td>
                        <td  id = 'r-<?php echo "$ctr"; ?>' ><?php echo $cl['location']; ?></td>
                        <td style="text-align: center;"><?php echo $reserved['reserved']; ?></td>
                        <td style="text-align: center;"><?php echo $enrolled['enrolled']; ?></td>
                    </tr>
            <?php $ctr++; } ?>
	</table>
</div>
