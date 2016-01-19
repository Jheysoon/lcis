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
                                <label>Header</label>
                                <select class="form-control" name="header">
                                    <?php 
                                        $headers = $this->db->get('tbl_option_header')->result();
                                        
                                        foreach ($headers as $header) {
                                    ?>
                                    <option value="<?php echo $header->id ?>" <?php echo (isset($header) AND $header == $header->id) ? 'selected' : '' ?>><?php echo $header->name ?></option>
                                    <?php } ?>
                                </select>
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
                            <th style="text-align:center;">Header</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $p = $this->db->get('tbl_option')->result();

                            foreach ($p as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value->link; ?></td>
                            <td><?php echo $value->desc ?></td>
                            <td style="text-align:center;">
                                <?php 
                                    if ($value->header == 0) {
                                        echo '<b>Not Assign</b>';
                                    } else {
                                        $this->db->where('id', $value->header);
                                        $h = $this->db->get('tbl_option_header')->row();
                                        echo $h->name;
                                    }
                                 ?>
                            </td>
                            <td>
                                <a href="#" data-param="<?php echo $value->id ?>" data-param1="<?php echo $value->link ?>" data-param2="<?php echo $value->desc ?>" data-param3="<?php echo $value->header ?>" class="btn btn-primary btn-sm myModal">Update</a>
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
                            <label>Header</label>
                            <select class="form-control" id="update_header" name="header">
                                <?php 
                                    $headers = $this->db->get('tbl_option_header')->result();
                                    
                                    foreach ($headers as $header) {
                                ?>
                                <option id="header_up<?php echo $header->id ?>" value="<?php echo $header->id ?>"><?php echo $header->name ?></option>
                                <?php } ?>
                            </select>
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
