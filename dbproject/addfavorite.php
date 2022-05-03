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
        if ($_POST[operation] == 'add'){
            $movieid = &$_POST[movieid];
            $user = &$_SESSION[userID];
            $result = mysqli_query($db_connection,"SELECT * FROM userfavorite WHERE userID = $user");
            $cnt = mysqli_num_rows($result);
            if ($cnt == 0){
                $sql = "INSERT INTO userfavorite (userID, id)
                VALUES
                ($user,$movieid)";

                if (!mysqli_query($db_connection, $sql)){
                    die("Error: " . mysqli_error($db_connection));
                }
                else{
                    echo "success!";
                }
            }
            else{
                $row = mysqli_fetch_array($result);
                $prev_comment = $row ['id'];

                $prev_result = mysqli_query($db_connection,"SELECT * FROM movie WHERE id = $movieid");
                $prev_row = mysqli_fetch_array($prev_result);
                $prev_title = $prev_row['title'];

                echo "Your previous favorite is " . $prev_title;
                echo "<br>";
                echo "your new favorite will be updated.";
                echo "<br>";

                $sql = "UPDATE userfavorite
                SET id = $movieid
                WHERE userID = $user";

                if (!mysqli_query($db_connection, $sql)){
                    die("Error: " . mysqli_error($db_connection));
                }
            }

        }
        elseif ($_POST[operation] == 'delete'){
            if ($_SESSION["userID"] != $_POST[userID]){
                echo "You are trying to delete other's record, but you can only delete your own record!";
                break;
            }

            $result = mysqli_query($db_connection,"SELECT * FROM userfavorite WHERE userID = $_SESSION[userID]");
            $cnt = mysqli_num_rows($result);

			if ($cnt == 0){
				echo "the record you try to delete does not exist!";
				break;
			}
			$sql = "DELETE FROM userfavorite
			WHERE userID = $_POST[userID]";

			if (!mysqli_query($db_connection, $sql)){
				die("Error deleting: " . mysqli_error($db_connection));
			}
			else{
				echo "You are about to delete your record!";
				echo "<br>";
			}

        }
    }
    elseif ($_SESSION['type'] == 'admin'){


		$result = mysqli_query($db_connection,"SELECT * FROM userfavorite WHERE userID = $_POST[userID]");
		$cnt = mysqli_num_rows($result);


		if ($_POST[operation] == "delete"){
			if ($cnt == 0){
				echo "the record you try to delete does not exist!";
				break;
			}
			$sql = "DELETE FROM userfavorite
			WHERE userID = $_POST[userID]";

			if (!mysqli_query($db_connection, $sql)){
				die("Error deleting: " . mysqli_error($db_connection));
			}
			else{
				echo "You are about to delete a record!";
				echo "<br>";
			}
		}
		// elseif ($_POST[operation] == 'update'){
		// 	if ($cnt == 0){
		// 		echo "the record you try to update does not exist!";
		// 		break;
		// 	}
			
        //     $sql = "UPDATE userfavorite
		// 	SET id = $_POST[movieid]
		// 	WHERE userID = $_POST[userid] AND id = $_POST[movieid]";


		// 	if (!mysqli_query($db_connection, $sql)){
		// 		die("Error updating: " . mysqli_error($db_connection));
		// 	}
		// 	else{
		// 		echo "You are about to update a record!";
		// 		echo "<br>";
		// 	}
		// }
		elseif ($_POST[operation] == 'add'){
            $movieid = &$_POST[movieid];
            $user = &$_SESSION[userID];
            $result = mysqli_query($db_connection,"SELECT * FROM userfavorite WHERE userID = $user");

            $cnt = mysqli_num_rows($result);
            if ($cnt == 0){
                $sql = "INSERT INTO userfavorite (userID, id)
                VALUES
                ($user,$movieid)";

                if (!mysqli_query($db_connection, $sql)){
                    die("Error: " . mysqli_error($db_connection));
                }
                else{
                    echo "success!";
                }
            }
            else{
                $row = mysqli_fetch_array($result);
                $prev_comment = $row ['id'];
                $prev_result = mysqli_query($db_connection,"SELECT * FROM movie WHERE id = $prev_comment");
                $prev_row = mysqli_fetch_array($prev_result);
                $prev_title = $prev_row['title'];

                echo "You have entered a favorite movie before, which is " . $prev_title;
                echo "<br>";
                echo "your new favorite will be updated.";
                echo "<br>";

                $sql = "UPDATE userfavorite
                SET id = $movieid
                WHERE userID = $user";

                if (!mysqli_query($db_connection, $sql)){
                    die("Error: " . mysqli_error($db_connection));
                }
            }
		}     

    }
    else{
		echo "Please log in first!";
		echo "<br>";
	}


	mysqli_close($db_connection);
?>
