<?php
    $details = $this->tor->getStudDetails($id);
if ($details) {
    extract($details);
    $course = $description;
    $cm = '';
    $name = strtoupper($lastname).", ".ucwords(strtolower($firstname))." ".strtoupper($middlename);
    if ($major != 0) {
        $major2 = $this->api->getMajor($major)->row_array();
        $course = $description." (".$major2['description'].")";
        $cm = $major2['description'];
    }
 ?>
    <?php
        $sch = '';
        $aca = ''; ?>

<div class="col-md-3"></div>
  <div class="col-md-9 body-container">
    <div class="panel p-body">

    <div class="panel-heading search">
      <h4>Permanent Record</h4>
    </div>
    <div class="panel-body">

            <div class="col-md-3 ">
                <label class="lbl-data">STUDENT ID</label>
                <input class="form-control" type="text" readonly value="<?php echo $legacyid; ?>">
            </div>
            <div class="col-md-4 ">
                <label class="lbl-data">STUDENT NAME</label>
                <input class="form-control" type="text" readonly value="<?php echo $name ?>">
            </div>
            <div class="col-md-5 ">
                <label class="lbl-data">COURSE</label>
                <input class="form-control" type="text" readonly value="<?php echo $course ?>">
            </div>
            <div class="col-md-12">
            <br/>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td style="color: #FFFF6F; text-align: center; background-color: #2F5836;" rowspan="2" colspan="2">SUBJECTS<br/>(With Descriptive Title)</th>
                        <td style="color: #FFFF6F; text-align: center; background-color: #2F5836;" colspan="2">GRADES</th>
                        <td style="color: #FFFF6F; text-align: center; background-color: #2F5836;" rowspan="2">UNITS</th>
                    </tr>
                    <tr>
                        <td style="color: #FFFF6F; text-align: center; background-color: #2F5836;">Final</th>
                        <td style="color: #FFFF6F; text-align: center; background-color: #2F5836;">Re-Ex</th>
                    </tr>
                    <?php
                    $enrol = $this->tor->getEnrolment2($id, 0);
                    foreach ($enrol as $key => $val) {
                        extract($val);
                        // $group = $this->tor->getGroup($classallocation);
                        $acad = $systart."-".$syend." ".$shortname;
                        if ($school != $sch) {
                            echo "<tr><th class='tbl-header tblCenter' colspan='5'><strong>".$school."</strong></th></tr>";
                            $sch = $school;
                        }
                        if ($aca != $acad) {
                            echo "<tr><td class='tbl-header tblCenter' colspan='5'><strong'>".$acad."</strong></td></tr>";
                            $aca = $acad;;
                        }

                        // get sem grade
                        $g1 = $this->tor->getGrade($semgrade);
                        $gr1 = $g1['value'];
                        if ( $gr1 == 0.00) {
                                $gr1 = $g1['description'];
                                if ($gr1 == 'INCOMPLETE') {
                                    $gr1 = 'INC';
                                }
                                elseif ($gr1 == 'DROPPED') {
                                    $gr1 = 'DRP';
                                }
                                else{
                                    $gr1 = '';
                                }
                        }

                        // get re-exam grade
                        $g2 = $this->tor->getGrade($reexamgrade);
                        $gr2 = $g2['value'];
                        if ($gr2 == 0.00) {
                                $gr2 = $g2['description'];
                                if ($gr2 == 'INCOMPLETE') {
                                    $gr2 = 'INC';
                                }
                                elseif ($gr2 == 'DROPPED') {
                                    $gr2 = 'DRP';
                                }
                                else{
                                    $gr2 = '';
                                }
                        }
                        ?>
                        <tr>
                            <td><?php echo $code; ?></td>
                            <td><?php echo $descriptivetitle; ?></td>
                            <td><?php echo $gr1; ?></td>
                            <td><?php echo $gr2; ?></td>
                            <td><?php echo $units; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            </div>
        </div>
</div>
</div>
</div>
<?php }
    else{
        echo "No Data Found!";
    }
?>