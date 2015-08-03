<?php
    $res = $this->tor->getAssignatories();
    $ctr = 1;
    foreach ($res as $key => $value) {
        extract($value);
        ${'f'.$ctr.'1'} = $assignatory;
        ${'f'.$ctr.'2'} = $designation;
        $ctr+=1;
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
                <div class="form-group col-md-8">
                    <label class="label-control">Granted under Authority of Special Order No.</label>
                    <input name="order" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label class="label-control">Series</label>
                    <input name="serial" type="text" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label class="label-control">Remarks</label>
                    <input name="remarks" type="text" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
