<div class="alert alert-info center-block" style="max-width:400px;text-align:center">
    <?php
        $systemVal = $this->api->systemValue();
        if($systemVal['classallocationstatus'] == 99)
            echo '<br/>Class Allocation program is finished';
        else
            echo 'The classallocation is now in step no. '.$systemVal['classallocationstatus'] + 1;
    ?>
</div>
