<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <?php 
        include_once("./library.php");
        $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

        // //check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // echo $_POST[firstname] . " , " . $_POST[lastname] ;

        $sql = "INSERT INTO Persons (FirstN, LastN, Age)
        VALUES
        ('$_POST[firstname]','$_POST[lastname]','$_POST[age]')";

        if (!mysqli_query($con, $sql)){
            die("Error: " . mysqli_error($con));
        }
        echo "1 record added";
        mysqli_close($con);
        ?>

</body>

</html>