<br/>
<table class="table">
    <tr>
      <td class="tbl-header" style="text-align: center;" colspan="8"><strong>Disapproved Registration</strong></td>
    </tr>
    <tr>
        <th style="text-align:center;">Student Number</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Course</th>
        <th style="text-align:center;">Major</th>
        <th style="text-align:center;">Action</th>
    </tr>
    <?php
        $this->db->where('status', 'D');
        $this->db->select('student,id,coursemajor');
        $r = $this->db->get('tbl_registration')->result_array();
        foreach($r as $reg)
        {
            $this->db->where('id', $reg['student']);
            $this->db->select('id,firstname,lastname,middlename,legacyid');
            $t = $this->db->get('tbl_party')->row_array();
            ?>
        <tr>
            <td style="text-align:center;"><?php echo $t['legacyid']; ?></td>
            <td style="text-align:center;"><?php echo $t['firstname'].' ,'.$t['lastname'].' '.$t['middlename']; ?></td>
            <td style="text-align:center;"><?php echo $this->api->getCourse($reg['coursemajor']); ?></td>
            <td style="text-align:center;">
                <?php
                    $i = $this->api->getMajor($reg['coursemajor']);
                    $ii = $i->row_array();
                    echo $ii['description'];
                 ?>
            </td>
            <td>
                <a href="/update_registration/<?php echo $reg['student'] ?>" class="btn btn-primary btn-xs">View</a>
            </td>
        </tr>
    <?php
        }
     ?>

</table>
