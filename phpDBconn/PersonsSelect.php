<?php
	require_once('./library.php');
	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
		return null;
	}

	$result = mysqli_query($db_connection,"SELECT * FROM Persons ORDER BY LastN");

	while($row = mysqli_fetch_array($result)) {
		echo $row['FirstN'];
		echo " " . $row['LastN'];
		echo " " . $row['Age'];
		echo "<br>";
	}

	mysqli_close($db_connection);
?>
