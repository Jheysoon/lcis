<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<?php
				$systemVal 	= $this->api->systemValue();
				$acam 		= $this->db->get_where('tbl_academicterm', array('id' => $systemVal['currentacademicterm']))->row();
				$term 		= $this->db->get_where('tbl_term', array('id' => $acam->term))->row();
			?>
			<h4>Class List for <?php echo $acam->systart.' - '.$acam->syend.' Term : '.$term->shortname ?></h4>
		</div>
		<div class="panel-body">
            <table class="table">
                <tr>
                    <th>Course</th>
                    <th>Subject</th>
					<th>Room</th>
					<th>Day</th>
					<th>Time</th>
                    <th>Action</th>
                </tr>

            <?php
                $where 		= array(
                            'academicterm'  => $systemVal['currentacademicterm'],
                            'instructor'    => $this->session->userdata('uid')
                        );
                $this->db->where($where);
                $this->db->select(array('id', 'instructor', 'coursemajor', 'subject'));
                $r = $this->db->get('tbl_classallocation')->result_array();

                foreach ($r as $rr) {
                ?>
                    <tr>
                        <td>
                            <?php
                                $this->db->where('id', $rr['coursemajor']);
                                $this->db->select('description');
                                $t = $this->db->get('tbl_course')->row_array();
                                echo $t['description'];
                             ?>
                        </td>
						<td>
                            <?php
                                $this->db->where('id', $rr['subject']);
                                $this->db->select('code,descriptivetitle');
                                $s = $this->db->get('tbl_subject')->row_array();
                                echo $s['code'].' | '.$s['descriptivetitle'];
                             ?>
                        </td>
						<td>
							<?php echo $this->edp_classallocation->getRooms($rr['id']) ?>
						</td>
						<td>
							<?php echo $this->edp_classallocation->getDayShort($rr['id']) ?>
						</td>
						<td>
							<?php echo $this->edp_classallocation->getPeriod($rr['id']) ?>
						</td>
                        <td>
                            <a href="/add_grade/<?php echo $rr['id'] ?>" class="btn btn-primary btn-xs">Add grades</a>
                        </td>
                    </tr>
            <?php
                }
             ?>
            </table>
		</div>
	</div>
</div>
