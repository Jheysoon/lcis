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
                            <?php echo $this->session->flashdata('message') ?>
                            <form action="/useroption/add_option_header" method="post">
                                <input type="text" class="form-control" name="header">
                                <input type="submit" class="btn btn-primary pull-right top-sign" name="name" value="Add">
                                <span class="clearfix"></span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $this->session->flashdata('message2') ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Option Header</th>
                                <th>Priority Number</th>
                                <th style="width:25%;">Action</th>
                            </tr>
                            <?php
                                $this->db->order_by('priors');
                                $this->db->order_by('name');
                                $headers = $this->db->get('tbl_option_header')->result();

                                foreach ($headers as $header) {
                                    ?>
                                <tr>
                                    <td><?php echo $header->name ?></td>
                                    <td><?php echo $header->priors ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Update</a>
                                        <a href="/useroption/delete_header/<?php echo $header->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
