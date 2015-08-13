<?php
    $res = $this->tor->getAssignatories();
    $ctr = 1;
    foreach ($res as $key => $value) {
        extract($value);
        ${'f'.$ctr.'1'} = $assignatory;
        ${'f'.$ctr.'2'} = $designation;
        $ctr+=1;
    }
        $order_title = 'Granted under Authority of Special Order No.';
        $order_no    = '';
        $series      = '';
        $remarks     = '';

        if ($this->session->has_userdata('fields')) {
            extract($this->session->userdata('fields'));
        }
 ?>
<div class="panel">
    <div class="panel-heading">
        <h4>Edit Print Fields</h4>
    </div>
    <div class="panel-body p-body">
        <form class="form" action="/registrar/updateFields" method="post">
            <div class="col-md-6">
                <input type="hidden" name="sid" value="<?php echo $sid; ?>">
                <div class="form-group col-md-12">
                    <h3>Assignatories Field</h3>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center; font-weight: bold; text-transform: uppercase;" class="form-control" type="text" name="f-1-1" value="<?php echo $f11; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center; font-weight: bold; text-transform: uppercase;" class="form-control" type="text" name="f-2-1" value="<?php echo $f21; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center" class="form-control" type="text" name="f-1-2" value="<?php echo $f12; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center" class="form-control" type="text" name="f-2-2" value="<?php echo $f22; ?>" required>
                    <br/><br/>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center; font-weight: bold; text-transform: uppercase;" class="form-control" type="text" name="f-3-1" value="<?php echo $f31; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center; font-weight: bold; text-transform: uppercase;" class="form-control" type="text" name="f-4-1" value="<?php echo $f41 ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center" class="form-control" type="text" name="f-3-2" value="<?php echo $f32; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input style="text-align: center" class="form-control" type="text" name="f-4-2" value="<?php echo $f42; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <h3>Other Fields</h3>
                </div>
                <div class="form-group col-md-7">
                    <label class="label-control">Order Title</label>
                    <input name="order_title" type="text" required class="form-control" value="<?php echo $order_title; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label class="label-control">Order No.</label>
                    <input name="order" type="text" class="form-control" value="<?php echo $order_no; ?>">
                </div>
                <div class="form-group col-md-2">
                    <label class="label-control">Series</label>
                    <input name="series" type="text" class="form-control" value="<?php echo $series; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label class="label-control">Remarks</label>
                    <input name="remarks" type="text" class="form-control" value="<?php echo $remarks; ?>">
                </div>
                <div class="form-group col-md-12">
                    <a href="<?php echo base_url('registrar_tor/'.$sid); ?>"class="btn btn-warning pull-right">Go Back</a>
                    <button style="margin-right: 5px;" class="btn btn-primary pull-right" type="submit">Save & Go Back</button>
                </div>
            </div>
        </form>
    </div>
</div>
