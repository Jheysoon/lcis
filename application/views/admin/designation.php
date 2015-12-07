<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
              <h4>Designation</h4>
            </div>
            <div class="panel-body">
                <form class="col-lg-offset-6 col-lg-6" role="form" method="post" action="">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="add designation">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-save" ></span> Save</button>
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
                                    <a class="label label-primary" href=""><span class="glyphicon glyphicon-pencil "></span>&nbsp; Edit</a>
                                    <a class="label label-danger" href=""><span class="glyphicon glyphicon-trash "></span>&nbsp; Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>