<html>
<head>
	<title>MySQLi Example</title>
</head>
<body>
<?php

function printList() {
	
	include_once("./library.php");
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
		
	?>
	<h2>Registered Clicks from this IP address</h2>
	<table border=1 width=100%>
		<tr background=#ff8c00>
			<th>IP</th>
			<th>User Agent</th>
			<th>Date</th>
		</tr>

	<?php

	$stmt = $db_connection->stmt_init();

	$totalClicks = 0;
	if($stmt->prepare("select * from address where ip = ?")) {
		$stmt->bind_param("s", $_SERVER["REMOTE_ADDR"]);
		$stmt->execute();
		$stmt->bind_result($ip, $user, $readable);
			
			while ($stmt->fetch()) {
				echo "<tr><td>" . $ip . "</td>";
				echo "\n";
				echo '<td>' . $user . '</td>';
				echo "\n";
				echo "<td>". $readable . "</td></tr>";
				echo "\n";
				echo "\n";
			}
			
		echo "</table>";
		$stmt->close();
	}
	$db_connection->close();
}


printList();


?>
</body>
</html>

