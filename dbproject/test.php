<?php
    session_start();
    require_once('./library.php');
	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
        return null;
	}

    if (&$_SESSION['type'] == 'user'){
		// $movieid = &$_POST[movieid];
		// $user = &$_SESSION[userID];
		// $result = mysqli_query($db_connection,"SELECT * FROM userfavorite WHERE userID = $user AND id = $movieid");

		// $cnt = mysqli_num_rows($result);
		// if ($cnt == 0){
		// 	$sql = "INSERT INTO userfavorite (userID, id)
		// 	VALUES
		// 	($user,$movieid)";

		// 	if (!mysqli_query($db_connection, $sql)){
		// 		die("Error: " . mysqli_error($db_connection));
		// 	}
		// 	else{
		// 		echo "success!";
		// 	}
		// }
		// else{
		// 	$row = mysqli_fetch_array($result);
		// 	$prev_comment = $row ['id'];

        //     $prev_result = mysqli_query($db_connection,"SELECT * FROM movie WHERE id = $movieid");
        //     $prev_row = mysqli_fetch_array($prev_result);
        //     $prev_title = $prev_row['title'];

		// 	echo "Your previous favorite is " . $prev_title;
    	// 	echo "<br>";
		// 	echo "your new favorite will be updated.";
		// 	echo "<br>";

		// 	$sql = "UPDATE userfavorite
		// 	SET id = $movieid
		// 	WHERE userID = $user AND id = $movieid";

		// 	if (!mysqli_query($db_connection, $sql)){
		// 		die("Error: " . mysqli_error($db_connection));
		// 	}
		// }
    }
    elseif (&$_SESSION['type'] == 'admin'){

    }
    else{
		echo "Please log in first!";
		echo "<br>";
	}

    mysqli_close($db_connection);
?>