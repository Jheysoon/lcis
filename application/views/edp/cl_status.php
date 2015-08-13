<div class="alert alert-info center-block" style="max-width:400px;text-align:center">
    <?php
        $systemVal = $this->api->systemValue();
     ?>
     The classallocation is now in step no. <?php echo ($systemVal['classallocationstatus'] == 99) ? '<br/>Class Allocation program is finished' : $systemVal['classallocationstatus'] + 1  ?>
</div>
