<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
                <h4>Option</h4>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Option</h3>
                        </div>
                        <div class="card-block">
                            <?php echo $this->session->flashdata('message') ?>
                            <form action="/useroption/add_option" method="post">
                                <input type="hidden" name="userid" value="<?php echo isset($uid) ? $uid : '' ?>">
                                <label>Path</label>
                                <input type="text" class="form-control" name="path" value="<?php echo isset($path) ? $path : '' ?>" required autofocus>
                                <label>Description</label>
                                <input type="text" class="form-control" name="option" value="<?php echo isset($option) ? $option : '' ?>" required>
                                <input type="submit" class="btn btn-primary pull-right top-sign" name="name" value="Add">
                                <span class="clearfix"></span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Path</th>
                            <th>Option</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $p = $this->db->get('tbl_option')->result();

                            foreach ($p as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value->link; ?></td>
                            <td><?php echo $value->desc ?></td>
                            <td>
                                <a href="#" data-param="<?php echo $value->id ?>" data-param1="<?php echo $value->link ?>" data-param2="<?php echo $value->desc ?>" class="btn btn-primary btn-sm myModal">Update</a>
                                <a href="/useroption/delete/<?php echo $value->id ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel">Update Option</h3>
                    </div>
                    <div class="modal-body">
                        <form action="/useroption/update_option" method="post">
                            <input type="hidden" name="id" value="">
                            <label>Path</label>
                            <input type="text" class="form-control" name="form_path" value="">
                            <label>Description</label>
                            <input type="text" class="form-control" name="form_desc" value="">
                            <input type="submit" class="btn btn-primary pull-right top-sign" name="name" value="Update">
                            <span class="clearfix"></span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
