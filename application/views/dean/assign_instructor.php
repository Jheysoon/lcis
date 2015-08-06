<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Assign Instructor</h4>
		</div>
		<div class="panel-body">
            <?php
                $owner 		= $this->api->getUserCollege();
                $systemVal 	= $this->api->systemValue();
				$user 		= $this->session->userdata('uid');

                $cl 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a,tbl_subject b
                    WHERE a.subject = b.id
                    AND b.owner = $owner
                    AND academicterm = {$systemVal['currentacademicterm']}")->result_array();

                $instruc = $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();

                //$cl = $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a, tbl_subject b WHERE a.subject = b.id AND academicterm = {$systemVal['currentacademicterm']} LIMIT 20")->result_array();
             ?>
             <table class="table">
                 <tr>
                     <th>Subject</th>
                     <th>Course</th>
					 <th>Room</th>
					 <th>Period</th>
                     <th style="width:200px;">Instructor</th>
					 <th>Status</th>
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
						<form class="save_instructor" method="post">
	                        <tr>
								<input type="hidden" name="cl_id" value="<?php echo $class['cl_id'] ?>">
	                            <td><?php echo $class['code'] ?></td>
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
	                                        <option value="option" class="text-justify">No Instructor</option>
	                                    <?php
	                                    }
										else {
											?>
											<option value="<?php echo $class['instructor'] ?>" class="text-justify" selected><?php echo $this->common_dean->getParty($class['instructor']) ?></option>
										<?php
										}
	                                    // auto check if the instructor is available for that day/period

	                                    foreach($instruc as $i)
										{
											$all_cl = $this->common_dean->getAllCl($i['id']);
											$subj_t = explode(' / ', $time);

											// instructor time looping
											$isConflict = FALSE;
											foreach($all_cl as $cl1)
											{
												$f 		= $this->db->get_where('tbl_time', array('id' => $cl1['from_time']))->row_array();
												$t 		= $this->db->get_where('tbl_time', array('id' => $cl1['to_time']))->row_array();
												$from 	= $f['time'];
												$to 	= $t['time'];

												// subject time looping
												foreach ($subj_t as $key) {
													$key1 		= explode('-', $key);
													$isConflict =  $this->api->intersectCheck($from, $key1[0], $to, $key1[1]);
												}
												if($isConflict)
													break;
											}
											if(!$isConflict)
											{
										?>
	                                        <option value="<?php echo $i['id'] ?>" style="text-align:center">
	                                            <?php
	                                                $this->db->where('id', $i['id']);
	                                                $this->db->select('firstname,lastname,middlename');
	                                                $tt = $this->db->get('tbl_party')->row_array();
	                                                echo $tt['lastname'].', '.$tt['firstname'].' '.$tt['middlename'];
	                                            ?>
	                                        </option>
	                                    <?php
											}
										}
										?>
	                                </select>
	                            </td>
								<td><strong><?php echo ($class['instructor'] == 0) ? 'Not Assigned':'Assigned' ?></strong></td>
	                            <td>
	                                <button type="submit" class="btn btn-primary btn-sm" name="button">Save</button>
	                            </td>
	                        </tr>
						</form>
                <?php
						}
                    }
                  ?>
             </table>
			 <!-- <a href="#" class="btn btn-primary pull-right">Attest All</a> -->
		</div>
	</div>
</div>
