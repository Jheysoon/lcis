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

            <!-- ================= Left header ================ -->
            <div class="col-md-12">
                <table>
                    <tr>
                        <td width="100px">Name :</td>
                        <td class=""><strong><?php echo $name; ?></strong></td>
                        <td>Sex :</td>
                        <td class="center"><?php echo $sex; ?></td>
                    </tr>
                    <tr>
                        <td>Permanent Address :</td>
                        <td colspan="3" class=""><?php echo $address1 ?>   </td>
                    </tr>
                </table>
            </div>
            <!-- start of second row of tables for TOR -->

            <!-- ======================= Left TOR Body ========================= -->
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td class="menu-heading" rowspan="2" colspan="2"><strong class="text-center">SUBJECTS<br/>(With Descriptive Title)</strong></th>
                        <td class="menu-heading" colspan="2"><strong class="text-center">GRADES</strong></th>
                        <td class="menu-heading" rowspan="2"><strong class="text-center">CREDITS</strong></th>
                    </tr>
                    <tr>
                        <td class="menu-heading"><strong class="text-center">Final</strong></th>
                        <td class="menu-heading"><strong class="text-center">Re-Ex</strong></th>
                    </tr>
                    <?php
                    $enrol = $this->tor->getEnrolment($id, 0);
                    foreach ($enrol as $key => $val) {
                        extract($val);
                        // $group = $this->tor->getGroup($classallocation);
                        $acad = $systart."-".$syend." ".$shortname;
                        if ($school != $sch) {
                            echo "<tr><th class='tbl-header' colspan='5'>".$school."</th></tr>";
                            $sch = $school;
                        }
                        if ($aca != $acad) {
                            echo "<tr><td class='tbl-header' colspan='5'>".$acad."</td></tr>";
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
<?php }
    else{
        echo "No Data Found!";
    }
?>