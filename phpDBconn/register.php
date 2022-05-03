<html>
<head>
	<title>MySQLi Example Insert</title>
</head>
<body>

<?php

function insertResponse($ip, $user, $readable) {
	require_once('./library.php');
	
	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	
	/*
	or
	  require_once('dbconnect.php');

	  $db_connection = DbUtil::loginConnection();
        */
    
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}
			
	$stmt = $db_connection->stmt_init();
	$returnValue = "invalid";
	if($stmt->prepare("insert into address values(?,?,?)") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->bind_param("sss", $ip, $user, $readable);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	$stmt->close();
	$db_connection->close();
	$returnValue = "success";
	return $returnValue;
}

$ip = $_SERVER['REMOTE_ADDR'];
$user = $_SERVER["HTTP_USER_AGENT"];
$readable = date("F j, Y, g:i a");     
echo "Recording " . $user . " on " . $readable;

if(insertResponse($ip, $user, $readable) != "success") {
	echo "<br><br>UBER FAIL!<br><br>";
}

else {
	echo "<br><br>You have been successfully marked present from ip address " . $_SERVER['REMOTE_ADDR'];
}
?>

</body>
</html>
