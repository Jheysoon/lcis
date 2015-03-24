
<?php 
	$result   = getEmpInfo($_SESSION['id']);
	$row      = mysql_fetch_row($result);
	$name     = $row[2]." ".$row[4];
    $address  = $row[7];
    $dob      = $row[5];
    $desig    = $row[8];
    $eid      = $row[1];
    $gender   = $row[7];
    $dept 	  = $row[9];
    $uname    = $_SESSION['uname'];
?>
	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body">
			<div class="panel-heading"><h4>Personal Information</h4></div>
			<div class="panel-body">
				<div class="col-md-12 pic-con">
					<a data-toggle="modal" data-target=".modal-pic">
						<img class="profile-main" src="images/sample.jpg">
					</a><br>
					<h3><?php echo $name; ?> <small> (<?php echo $_SESSION['uname']; ?>)</small></h3>
				</div><hr/>	
				<div class="col-md-12 det">
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">ID</div>
						<div class="col-md-10 text-main-16"><?php echo $eid; ?></div>
				</div>
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">Name</div>
						<div class="col-md-10 text-main-16"><?php echo $name; ?></div>
				</div>	
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">Address</div>
						<div class="col-md-10 text-main-16"><?php echo $address; ?></div>
				</div>
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">Date of Birth</div>
						<div class="col-md-10 text-main-16"><?php echo $dob; ?></div>
				</div>
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">Designation</div>
						<div class="col-md-10 text-main-16"><?php echo $desig; ?></div>
				</div>
				<div class="col-md-12 pad-bottom-10">
						<div class="col-md-2">Department</div>
						<div class="col-md-10 text-main-16"><?php echo $dept; ?></div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-pic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<form class="form">
        		<img class="profile-modal" src="images/profile_pics/<?php echo $_SESSION['id']; ?>.jpg">
        	</form>
        </div>
      </div>
    </div>
