<table class="table table-bordered" id="tbl_cl">
    <caption>
        <strong>
            Academicterm SY:
            <?php
                $nxt = $this->api->systemValue();
                $nnxt = $this->academicterm->findById($nxt['nextacademicterm']);
                echo $nnxt['systart'].' - '.$nnxt['syend'].' Term: '.$nnxt['term'];
             ?>
        </strong>
    </caption>
    <tr>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Course</th>
        <th style="text-align:center;">Day</th>
        <th style="text-align:center;">Period</th>
        <th style="text-align:center;">Action</th>
    </tr>
    <?php
        $r = $this->edp_classallocation->getEmptyRoom();
        foreach($r as $room)
        {
            $this->db->where('classallocation',$room['id']);
            $rr = $this->db->count_all_results('tbl_dayperiod');
            $this->db->where('classallocation', $room['id']);
            $this->db->where('classroom', 0);
            $rr1 = $this->db->count_all_results('tbl_dayperiod');
            if($rr < 1 OR $rr1 > 0)
            {
            ?>
    <tr>
        <td>
            <?php
                $s = $this->subject->find($room['subject']);
                echo $s['code'];
             ?>
        </td>
        <td>
            <?php
                echo $this->api->getCourseMajor($room['coursemajor']);
             ?>
        </td>
        <td style="text-align:center;">
            <?php echo $this->edp_classallocation->getDayShort($room['id']); ?>
        </td>
        <td style="text-align:center;">
            <?php echo $this->edp_classallocation->getPeriod($room['id']); ?>
        </td>
        <td>
            <a href="/assign_room/<?php echo $room['id']; ?>" class="btn btn-primary btn-xs btn-block">Assign Room</a>
        </td>
    </tr>
    <?php
            }
        }
     ?>
 </table>
