<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Student List</h4>
		</div>
		<div class="panel-body">
            <table class="table">
                <tr>
                    <th style="width:75%;">Student Name</th>
                    <th colspan="2">Grade</th>
                </tr>
                <?php
                    $this->db->where('classallocation', $id);
                    $this->db->select('enrolment,semgrade');
                    $g = $this->db->get('tbl_studentgrade')->result_array();
                    $count = 0;
                    foreach($g as $grade)
                    {
                        $count++;
                        ?>
                        <tr>
                            <td>
                                <?php
                                    echo $count.'.) ';
                                    $p = $this->party->getStudent($grade['enrolment']);
                                    echo $p['lastname'].', '.$p['firstname'];
                                 ?>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm" name="name" value="">

                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" name="button">Add Grade</button>
                            </td>
                        </tr>
                <?php
                    }
                 ?>
            </table>
            <a href="#" class="btn btn-primary pull-right">Attest All</a>
		</div>
	</div>
</div>
