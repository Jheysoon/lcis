<?php if (uri_string() == 'designation'){
    $action = '/admin/addDesignation';
    $id     = '';
    $val    = '';
    $title  = 'Add Designation';
}
else{
    $action = '/admin/updateDesignation';
    $title  = 'Update Designation';
} ?>

<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
              <h4><?php echo $title; ?></h4>
            </div>
            <div class="panel-body">
                <?php echo $this->session->flashdata('message'); ?>
                <form class="col-lg-offset-6 col-lg-6" role="form" method="post" action="<?php echo $action; ?>">
                    <input type="hidden" name='id' value="<?php echo $id; ?>">
                    <div class="input-group">
                      <input type="text" class="form-control" required name="designation" value="<?php echo $val; ?>" placeholder="add designation">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-save" ></span> Save</button>
                        <?php if (uri_string() != 'designation'): ?>
                            <a class="btn btn-danger" href="/designation">Cancel</a>
                        <?php endif ?>
                      </span>
                    </div>
                </form>
                <br/><br/>
                <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Designation Name</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $res = $this->designation->getDesignations();
                        foreach ($res as $key => $value): extract($value);?>
                            <tr>
                                <td><?php echo $description; ?></td>
                                <td>
                                    <a class="label label-primary" href="/update_designation/<?php echo $id; ?>"><span class="glyphicon glyphicon-pencil "></span>&nbsp; Edit</a>
                                    <a class="label label-danger" href="/admin/deleteDesignation/<?php echo $id; ?>"  onclick="return confirm('Are you sure you wan to delete <?php echo $description ?> from designations?')"><span class="glyphicon glyphicon-trash "></span>&nbsp; Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>