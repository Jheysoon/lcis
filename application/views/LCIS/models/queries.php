<?php 
	function validate( $username, $password){

		$result = mysql_query("SELECT * FROM user_accounts WHERE username  = '$username' AND 
			password = AES_ENCRYPT('$password', 'key') AND status = 'active' LIMIT 1")
		or die(mysql_error());

		return $result;
	}

	function getEmpInfo($id){
		$result = mysql_query("SELECT * FROM users WHERE eid = '$id'")
		or die(mysql_error());

		return $result;
	}
	
	function getUname($id){
		$result = mysql_query("SELECT username FROM students WHERE sid = '$id'")
		or die(mysql_error());

		return $result;
	}

 ?>