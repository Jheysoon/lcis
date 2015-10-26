<div class="alert alert-info center-block" style="max-width:400px;text-align:center">
    <?php
        $systemVal = $this->api->systemValue();
        if($systemVal['classallocationstatus'] == 99){
            echo '<strong>Class Allocation program is finished</strong>';
        }
        else{
            $r = $systemVal['classallocationstatus'] + 1;
            echo '<strong>The classallocation is now in step no. '.$r.'</strong>';
        }
    ?>
</div>
