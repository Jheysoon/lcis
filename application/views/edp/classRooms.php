<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">
		<div class="panel-heading search">
			<div class="col-md-6">		
				<h4>Class Allocation For The SY:
				<?php 
					$systemVal 	= $this->api->systemValue();
					$acam 		= $this->academicterm->findById($systemVal['nextacademicterm']);
					echo $acam['systart'].' - '.$acam['syend'].' Term:'.$this->academicterm->getLongName($acam['term']); 
				 ?>
				</h4>		
			</div>
			<div class="col-md-6">
				<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
			        <div class="form-group">
			          <input type="hidden" name="page" value="search">
			          <input type="text" name="search" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-warning">
			        <span class="glyphicon glyphicon-search"></span>
			        </button>
			     </form>
			</div>
		</div>
		<div class="col-md-12">
		<div class="panel-body">
		<a href="/add_room" class="btn btn-success btn-sm pull-right">Add Room</a>
		<span class="clearfix"></span>
		<br/>
		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>Room No.</th>
						<th>Campus</th>
						<th>Min. Capacity</th>
						<th>Max. Capacity</th>
						<th>Status</th>
						<th style="width:15%;">Action</th>
					</tr>
					<?php 
						$r = $this->classroom->all();
						foreach($r as $room)
						{
					?>
					<tr>
						<td><?php echo $room['legacycode']; ?></td>
						<td><?php echo $room['location']; ?></td>
						<td><?php echo $room['mincapacity']; ?></td>
						<td><?php echo $room['maxcapacity']; ?></td>
						<td><?php echo $room['status']; ?></td>
						<td>
							<a class="btn btn-success btn-xs btn-block" href="/view_sched/<?php echo $room['id']; ?>">View Schedule</a>
							<!-- <a class="btn btn-warning btn-xs" href="/edp/delete_room/<?php echo $room['id']; ?>">Edit Schedule</a> -->
						</td>
					</tr>
					<?php
						}
					 ?>
				</table>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>