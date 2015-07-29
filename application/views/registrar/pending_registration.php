<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Pending Students</h4>
		</div>
		<div class="panel-body">
            <?php
				echo $this->session->flashdata('message');
                $this->db->where('status', 'E');
                $this->db->group_by('student');
                $r = $this->db->get('tbl_registration')->result_array();
             ?>
            <table class="table">
                <tr>
                    <th>Student Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                    foreach ($r as $key)
                    {
                        ?>
                        <tr>
                            <td>
                                <?php
                                    $this->db->where('id', $key['student']);
                                    $t = $this->db->get('tbl_party')->row_array();
                                    echo $t['legacyid'];
                                 ?>
                            </td>
                            <td>
                                <?php echo $t['lastname'].','.$t['firstname'] ?>
                            </td>
                            <td>
                                <a href="/pending_reg/<?php echo $t['id'] ?>" class="btn btn-primary btn-xs">Open</a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </table>

		</div>
	</div>
</div>
