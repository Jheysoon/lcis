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
                                <label>Header</label>
                                <input type="text" class="form-control" name="header">
                                <label>Priority Number</label>
                                <select class="form-control" name="priors">
                                <?php 
                                    $this->db->select_max('priors');
                                    $max = $this->db->get('tbl_option_header')->row();
                                    $max = $max->priors;
                                    for ($i = 0; $i <= $max ; $i++) { 
                                        $ii = $i;
                                        ++$ii;
                                ?>
                                    <option value="<?php echo $ii; ?>"><?php echo $ii ?></option>
                                <?php } ?>
                                </select>
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
                                        <a href="#" class="btn btn-primary btn-sm header_modal" data-name="<?php echo $header->name ?>" data-priors="<?php echo $header->priors ?>" data-id="<?php echo $header->id ?>">Update</a>
                                        <a href="/useroption/delete_header/<?php echo $header->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form action="/useroption/update_header" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title" id="myModalLabel">Update Option</h3>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="">
                                    <label>Header</label>
                                    <input type="text" class="form-control" name="form_header" value="">
                                    <label>Priority</label>
                                    <select class="form-control" id="update_header" name="header">
                                        <?php 
                                            for ($i = 0; $i <= $max ; $i++) { 
                                                $ii = $i;
                                                ++$ii;
                                        ?>
                                            <option id="header_up<?php echo $ii ?>" value="<?php echo $ii ?>"><?php echo $ii ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="submit" class="btn btn-primary pull-right top-sign" name="name" value="Update">
                                    <span class="clearfix"></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
