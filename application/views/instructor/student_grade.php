<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Student List for the Subject (<?php echo $subject['code'].' '.$subject['descriptivetitle'] ?>)</h4>
		</div>
		<div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th style="width:75%;">Student Name</th>
                    <th colspan="2">Grade</th>
                </tr>
                <?php
                    $count = 0;
                    foreach($g as $grade)
                    {
                        $count++;
						$this->db->where('id', $grade['studentgrade_id']);
						$this->db->select('semgrade');
						$gg = $this->db->get('tbl_studentgrade')->row_array();
						if($gg['semgrade'] == 0)
							$init_grade = 44;
						else
							$init_grade = $gg['semgrade'];
                        ?>
                        <tr>
							<form method="post" class="update_grade">
								<input type="hidden" name="classallocation" value="<?php echo $id ?>">
								<input type="hidden" name="studentgrade_id" value="<?php echo $grade['studentgrade_id'] ?>">
								<td><?php echo $count.'.) '.$grade['lastname'].', '.$grade['firstname'].' '.$grade['middlename']; ?></td>
	                            <td>
	                                <select class="form-control" name="grade">
										<?php foreach ($all_grade as $val) { ?>
											<option value="<?php echo $val['id'] ?>" <?php echo ($val['id'] == $init_grade) ? 'selected':'' ?>><?php echo ($val['id'] == 44 OR $val['value'] == '0.00') ? $val['description']:$val['value'] ?></option>
										<?php } ?>
	                                </select>
	                            </td>
	                            <td>
	                                <button type="submit" class="btn btn-primary btn-sm" name="button">Save Grade</button>
	                            </td>
							</form>
                        </tr>
                <?php
                    }
                 ?>
            </table>
            <a href="#" class="btn btn-primary pull-right">Attest All</a>
		</div>
	</div>
</div>
