<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assign Instructor</h4>
		</div>
		<div class="panel-body">
            <?php
                $owner = $this->api->getUserCollege();
                $systemVal = $this->api->systemValue();
                // $cl = $this->db->query("SELECT * FROM tbl_classallocation a,tbl_subject b
                //     WHERE a.subject = b.id
                //     AND b.owner = $owner
                //     AND academicterm = {$systemVal['currentacademicterm']}")->result_array();

                $instruc = $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();

                $cl = $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a, tbl_subject b WHERE a.subject = b.id AND academicterm = {$systemVal['currentacademicterm']} LIMIT 20")->result_array();
             ?>
             <table class="table">
                 <tr>
                     <th>Subject</th>
                     <th style="width:30%;">Course</th>
					 <th>Room</th>
					 <th>Period</th>
                     <th>Instructor</th>
                     <th>Action</th>
                 </tr>
                 <?php
                    foreach($cl as $class)
                    {
						$room = $this->edp_classallocation->getRooms($class['cl_id']);
						$time = $this->edp_classallocation->getPeriod($class['cl_id']);
						// this checking will be not be used in testing
						if(!empty($room) AND !empty($time))
						{
                        ?>
                        <tr>
                            <td><?php echo $class['code'].' '.$class['cl_id'] ?></td>
                            <td>
                                <?php
                                    if ($class['coursemajor'] != 0) {
                                        $this->db->where('id', $class['coursemajor']);
                                        $this->db->select('description');
                                        $cc = $this->db->get('tbl_course')->row_array();
                                        echo $cc['description'];
                                    }
                                    else
                                        echo 'Not Available';
                                ?>
                            </td>
							<td><?php echo $room ?></td>
							<td><?php echo $time ?></td>
                            <td>
                                <select class="form-control" name="instructor">
                                    <?php if($class['instructor'] == 0) { ?>
                                        <option value="option">No Instructor</option>
                                    <?php
                                    }
                                    // auto check if the instructor is available for that day/period
                                     foreach($instruc as $i){ ?>
                                        <option value="<?php echo $i['id'] ?>">
                                            <?php
                                                $this->db->where('id', $i['id']);
                                                $this->db->select('firstname,lastname,middlename');
                                                $tt = $this->db->get('tbl_party')->row_array();
                                                echo $tt['lastname'].', '.$tt['firstname'].' '.$tt['middlename'];
                                            ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm" name="button">Add</button>
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
