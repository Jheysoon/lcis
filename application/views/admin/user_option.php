<div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body">
            <div class="panel-heading search">
                <h4>User Option</h4>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                    <?php
                        $academics  = $this->db->get('tbl_academic')->result();
                        $admins     = $this->db->get('tbl_administration')->result();

                        $users      = array_merge($academics, $admins);

                        foreach ($users as $user) {
                            $this->db->where('id', $user->id);
                            $count = $this->db->count_all_results('tbl_party');

                            if ($count > 0) {
                                $party = $this->db->get_where('tbl_party', array('id' => $user->id))->row();
                    ?>
                        <tr>
                            <td><?php echo $party->firstname ?></td>
                            <td><?php echo $party->lastname ?></td>
                            <td>
                                <a href="/useroption/<?php echo $party->id?>" class="btn btn-primary btn-xs">
                                    Add / Update Option
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>