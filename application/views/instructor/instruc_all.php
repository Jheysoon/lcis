<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<div class="panel p-body">
		<div class="panel-heading">
			<h4>Instructor's</h4>
		</div>
		<div class="panel-body">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                    foreach ($instruc as $key) {
                        ?>
                        <tr>
                            <td><?php echo $key['firstname'].' ,'.$key['lastname'] ?></td>
                            <td>
                                <a href="/instruc_sched/<?php echo $key['partyid'] ?>" class="btn btn-primary btn-xs">View</a>
                            </td>
                        </tr>
                <?php

                    }
                 ?>
            </table>
		</div>
	</div>
</div>
