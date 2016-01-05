<?php 
    $getflag = $this->common->theflag($partyid);
    if ($getflag < 1 AND ($position == 'C' or $position == 'B')):
 ?>
    <form action="/registrar/insert_flag" method="POST">
        <input type="hidden" name="url" value="<?php echo current_url(); ?>"/>
        <input type="hidden" name="tm" value="<?php echo $status; ?>"/>
        <input type="hidden" name="flag_status" value="C"/>
        <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
        <input type="submit" class="btn btn-primary pull-right" value="Confirm" onclick="return confirm('Are you sure?')">
    </form>
     
    <form action="/registrar/insert_flag" method="POST">
        <input type="hidden" name="flag_status" value="R"/>
        <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
        <input type="submit" class="btn btn-primary" value="Return to Clerk">
    </form>
     
<?php elseif ($this->session->userdata('status') != 'S'): ?>
    <form action="/registrar/insert_flag" method="POST">
        <input type="hidden" name="url" value="<?php echo current_url(); ?>"/>
        <input type="hidden" name="flag_status" value="S"/>
        <input type="hidden" name="partyid" value="<?php echo $partyid; ?>">
        <input type="submit" class="btn btn-primary pull-right" value="Submit" onclick="return confirm('Are you sure?')">
    </form>
<?php endif ?>