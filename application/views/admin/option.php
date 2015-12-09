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
                            Add Option
                        </div>
                        <div class="card-block">
                            <?php echo $this->session->flashdata('message') ?>
                            <form action="/useroption/add_option" method="post">
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
                        </tr>
                        <?php 
                            $p = $this->db->get('tbl_option')->result();
                            
                            foreach ($p as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value->link; ?></td>
                            <td><?php echo $value->desc ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>