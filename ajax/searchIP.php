<?php
	require "dbutil.php";
	// require "../phpDBconn/dbconnect.php";
	$db = DbUtil::loginConnection();

	// require_once('./library.php');
	
	// $db = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from address where ip like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchIP'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($ip, $user, $datetime);
		echo "<table border=1><th>IP</th><th>User Agent</th><th>Date of Access</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$ip</td><td>$user</td><td>$datetime</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>