<?php 

    if (uri_string() == 'college' || uri_string() == 'colleges/addCollege'){
        $action = '/colleges/addCollege';
        $id             = '';
        $description    = '';
        $shortname      = '';
        $dean           = '';
        $title  = 'Add College';
    }
    else{
        $action = '/colleges/updateCollege';
        $title  = 'Update Colllege';
    } 

    $deans = $this->college->getDeans();
    $iid = $id;

?>

<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
              <h4><?php echo $title; ?></h4>
            </div>
            <div class="panel-body">
                <?php echo $this->session->flashdata('message'); ?>
                <form class="form" role="form" method="post" action="<?php echo $action; ?>">
                    <input type="hidden" name='id' value="<?php echo $id; ?>">
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" required name="description" value="<?php echo (uri_string() == 'college' || uri_string() == 'colleges/addCollege') ? set_value('description') : $description; ?>" placeholder="description">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" required name="shortname" value="<?php echo (uri_string() == 'college' || uri_string() == 'colleges/addCollege') ? set_value('shortname') : $shortname; ?>" placeholder="shortname">
                    </div>
                    <div class="form-group col-md-4">
                      <select class="form-control" required name="dean">
                          <option value="0">Select Dean</option>
                          <?php foreach ($deans as $key => $value): extract($value); ?>
                              <option <?php echo ($dean == $id) ? 'selected' : ''; ?> value="<?php echo $id; ?>"><?php echo $lastname." ".$firstname ?></option>
                          <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-md-12">
                        <?php if (uri_string() == 'update_college/'.$iid ): ?>
                            <a class="btn btn-danger pull-right" style="margin-left: 5px;" href="/college">Cancel</a>
                        <?php endif ?>
                        <button class="btn btn-primary pull-right" type="submit"><span class="glyphicon glyphicon-save" ></span> Save</button>
                        <br/><br/>
                    </div>
                </form>
                <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Designation Name</th>
                            <th>Shortname</th>
                            <th>Dean</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $res = $this->college->getColleges();
                        foreach ($res as $key => $value): extract($value);?>
                            <tr>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $shortname; ?></td>
                                <td><?php echo $firstname.' '.$lastname; ?></td>
                                <td>
                                    <a class="label label-primary" href="/update_college/<?php echo $id; ?>"><span class="glyphicon glyphicon-pencil "></span>&nbsp; Edit</a>
                                    <a class="label label-danger" href="/colleges/deleteCollege/<?php echo $id; ?>"  onclick="return confirm('Are you sure you wan to delete <?php echo $description ?> from designations?')"><span class="glyphicon glyphicon-trash "></span>&nbsp; Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>