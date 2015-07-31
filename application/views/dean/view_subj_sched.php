<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
			<div class="col-md-12">
                <br/>
			<?php
                $systemVal  = $this->api->systemValue();
                $owner      = $this->api->getUserCollege();
                //$systemVal['classallocationstatus'] == 4
                if($systemVal['classallocationstatus'] == 4)
                {
                    $cm = $this->edp_classallocation->getCM_groupBy();
                    foreach ($cm as $val)
                    {
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4">
                                <?php
                                    $this->db->where('id', $val['coursemajor']);
                                    $r = $this->db->get('tbl_course')->row_array();
                                    echo $r['description'];
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Subject
                            </td>
                            <td>
                                Descriptive Title
                            </td>
                            <td>
                                Room
                            </td>
                            <td>
                                Period
                            </td>
                        </tr>
                        <?php
                            $this->db->where('coursemajor', $val['coursemajor']);
                            $this->db->where('academicterm', $systemVal['nextacademicterm']);
                            $q = $this->db->get('tbl_classallocation')->result_array();
                            foreach ($q as $key)
                            {
								if($this->session->userdata('uid') == $systemVal['employeeid'])
								{
									$this->db->where('id', $key['subject']);
									$this->db->where('computersubject', 1);
								}
								elseif($owner == 1)
								{
									$this->db->where('id', $key['subject']);
									$this->db->where('gesubject', 1);
								}
								else {
									// check the owner of that subject
									$this->db->where('id', $key['subject']);
									$this->db->where('owner', $owner);
								}

								$count_subj = $this->db->count_all_results('tbl_subject');
								if ($count_subj > 0)
								{
	                                $this->db->where('id', $key['subject']);
	                                $t = $this->db->get('tbl_subject')->row_array();
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $t['code']; ?>
                                    </td>
                                    <td>
                                        <?php echo $t['descriptivetitle']; ?>
                                    </td>
                                    <td>
                                        <?php
                                            // change this to look like this Tb 10/tb 11
                                            $cl = $this->edp_classallocation->getRoom($key['id']);
                                            echo $cl['room'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $this->edp_classallocation->getPeriod($key['id']); ?>
                                    </td>
                                </tr>
                            <?php
								}
                            }
                         ?>
                    </table>
                    <?php
                    }
                }
                else
                {
            ?>
                    <div class="alert alert-danger center-block" style="text-align:center;max-width:400px;">
                        You cannot run this program
                    </div>
            <?php
                }
             ?>
			</div>
		</div>
	</div>
</div>
