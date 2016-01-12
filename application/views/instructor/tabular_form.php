<div class="col-md-3"></div>
<div class="col-md-9 body-container">
    <div class="panel p-body">
        <div class="panel-heading">
            <h4><?php echo $party; ?></h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <caption>
                    <h3>
                        <b>Class And Teacher's Program</b><br>
                        <b><?php echo $academicterm ?></b>
                    </h3>
                </caption>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Subject</th>
                    <th>Room</th>
                    <th style="text-align: center">Units</th>
                </tr>
                <?php
                    $units = 0;
                    foreach ($classes as $class) {
                        $day        = $this->edp_classallocation->getDayShort($class->id);
                        $time       = $this->edp_classallocation->getPeriod($class->id);
                        $subject    = $this->subject->find($class->subject);
                        $units      = $units + $subject['units'];
                        $rooms      = $this->edp_classallocation->getRooms($class->id);
                        ?>
                        <tr>
                            <td><?php echo $day ?></td>
                            <td><?php echo $time ?></td>
                            <td><?php echo $subject['code'] ?></td>
                            <td><?php echo $rooms ?></td>
                            <td style="text-align: center"><?php echo $subject['units'] ?></td>
                        </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align: center"><b>TOTAL TEARCHER'S LOAD</b></td>
                    <td>
                        <b>UNITS: <?php echo $units ?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>