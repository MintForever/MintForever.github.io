<?php
	# start session
	session_start();
	require_once('./library.php');
	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
		return null;
	}

	if ($_SESSION['type'] == 'user'){
		$movieid = &$_POST[movieid];
		$user = &$_SESSION['userID'];
		$comment = &$_POST[comment];
		$result = mysqli_query($db_connection,"SELECT * FROM comment WHERE userID = $user AND id = $movieid");

		$cnt = mysqli_num_rows($result);
		if ($cnt == 0){
			$sql = "INSERT INTO comment (userID, id, comment)
			VALUES
			($user,$movieid,'$comment')";

			if (!mysqli_query($db_connection, $sql)){
				die("Error: " . mysqli_error($db_connection));
			}
			else{
				echo "success!";
			}
		}
		else{
			$row = mysqli_fetch_array($result);
			$prev_comment = $row ['comment'];
			echo "You have already written a comment for this movie: " . $prev_comment;
			echo "<br>";
			echo "your new comment will be updated.";
			echo "<br>";

			$sql = "UPDATE comment
			SET comment = '$comment'
			WHERE userID = $user AND id = $movieid";

			if (!mysqli_query($db_connection, $sql)){
				die("Error: " . mysqli_error($db_connection));
			}
		}
	}

	elseif ($_SESSION['type'] == 'admin'){

		$result = mysqli_query($db_connection,"SELECT * FROM comment WHERE userID = $_POST[userid] AND id = $_POST[movieid]");
		$cnt = mysqli_num_rows($result);


		if ($_POST[operation] == "delete"){
			if ($cnt == 0){
				echo "the record you try to delete does not exist!";
				break;
			}
			$sql = "DELETE FROM comment
			WHERE userID = $_POST[userid] AND id = $_POST[movieid]";

			if (!mysqli_query($db_connection, $sql)){
				die("Error deleting: " . mysqli_error($db_connection));
			}
			else{
				echo "You are about to delete a record!";
				echo "<br>";
			}
		}
		elseif ($_POST[operation] == 'update'){
			if ($cnt == 0){
				echo "the record you try to update does not exist!";
				break;
			}

			### need to change
			$sql = "UPDATE comment
			SET comment = '$comment'
			WHERE userID = $_POST[userid] AND id = $_POST[movieid]";

			if (!mysqli_query($db_connection, $sql)){
				die("Error updating: " . mysqli_error($db_connection));
			}
			else{
				echo "You are about to update a record!";
				echo "<br>";
			}
		}
		elseif ($_POST[operation] == 'add'){
			$movieid = &$_POST[movieid];

			$user = &$_SESSION['userID'];
	
			###change requires here###
			$comment = &$_POST[comment];
	
			$result = mysqli_query($db_connection,"SELECT * FROM comment WHERE userID = $user AND id = $movieid");
	
			$cnt = mysqli_num_rows($result);
			if ($cnt == 0){
				$sql = "INSERT INTO comment (userID, id, comment)
				VALUES
				($user,$movieid,'$comment')";
	
				if (!mysqli_query($db_connection, $sql)){
					die("Error: " . mysqli_error($db_connection));
				}
				else{
					echo "success!";
				}
			}
			else{
				$row = mysqli_fetch_array($result);
				$prev_comment = $row ['comment'];
				echo "You have already written a comment for this movie: " . $prev_comment;
				echo "<br>";
				echo "your new comment will be updated.";
				echo "<br>";
	
				$sql = "UPDATE comment
				SET comment = '$comment'
				WHERE userID = $user AND id = $movieid";
	
				if (!mysqli_query($db_connection, $sql)){
					die("Error: " . mysqli_error($db_connection));
				}
			}
		}
	}

	else{
		echo "please log in first!";
		echo "<br>";
	}


	

	// if($_SESSION["type"] === 'admin'){
	// 	echo "yayyyyyyyyyyyy";
	// 	exit;
	// }
	mysqli_close($db_connection);
?>
