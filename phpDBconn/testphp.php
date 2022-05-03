<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <h1>Mint's home page here! </h1>
        <?php 
        // include_once("./library.php");
        $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

        // //check connection
        
        // $sql = "INSERT INTO PERSONS (FirstN, LastN, Age)
        // VALUES
        // ('$_POST[firstname]','$_POST[lastname]','$_POST[age')";

        if (!mysqli_query($con, $sql))
        {
            die("Error: " . mysqli_error($con));////
        }
        // echo "1 record added";
        // mysqli_close($con);
        ?>

    </body>

</html>