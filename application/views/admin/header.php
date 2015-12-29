<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
              <h4>Option Header</h4>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-header">
                            Add Option Header
                        </div>
                        <div class="card-block">
                            <input type="text" class="form-control" name="name" value="">
                            <input type="submit" class="btn btn-primary pull-right top-sign" name="name" value="Add">
                            <span class="clearfix"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Option Header</th>
                                <th style="width:25%;">Action</th>
                            </tr>
                            <?php
                                $headers = $this->db->get('tbl_option_header')->result();

                                foreach ($headers as $header) {
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $header->name ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Update</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
