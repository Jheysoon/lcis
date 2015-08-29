<div class="center-block" style="max-width:600px;">
    <div class="alert alert-danger" style="text-align:center;">
        <?php echo $message; ?>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="text-align:center;">
                Dean's Activity
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <td style="text-align:center;">College</td>
                <td style="text-align:center;">Status</td>
                <td style="text-align:center;">Date Completed</td>
            </tr>
            <?php
                $college = $this->edp_classallocation->getAllCollege();
                foreach ($college as $col)
                {
                    if($col['id'] == 6)
                    {
                        continue;
                    }
            ?>
            <tr>
                <td>
                    <?php echo $col['description']; ?>
                </td>
                <td style="text-align:center;">
                    <?php
                        $c = $this->edp_classallocation->count_complete($col['dean'],$stage);
                        if($c > 0)
                        {
                            $s = $this->edp_classallocation->get_status($col['dean'],$stage);
                            if($s['status'] == 'O')
                                echo 'Attested';
                        }
                        else
                            echo 'Untouched';
                     ?>
                </td>
                <td style="text-align:center;">
                    <?php
                        if($c > 0)
                            echo $s['statusdate'];
                        else
                            echo 'Not Available';
                     ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>
                    Computer Subjects
                </td>
                <td style="text-align:center;">
                    <?php
                        $systemVal = $this->api->systemValue();
                        $c = $this->edp_classallocation->count_complete($systemVal['employeeid'], $stage);
                        if($c > 0)
                        {
                            $s = $this->edp_classallocation->get_status($systemVal['employeeid'], $stage);
                            if($s['status'] == 'O')
                                echo 'Attested';
                        }
                        else
                            echo 'Untouched';
                     ?>
                </td>
                <td style="text-align:center;">
                    <?php
                        if($c > 0)
                            echo $s['statusdate'];
                        else
                            echo 'Not Available';
                     ?>
                </td>
            </tr>
        </table>
    </div>
</div>
