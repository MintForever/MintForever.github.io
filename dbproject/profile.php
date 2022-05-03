<!DOCTYPE html>
<html lang="en">

<head>
    <title>Uesr Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design for Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
     @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');
        * {
            margin: 0;
            padding: 0;
             font-family: 'Josefin Sans', sans-serif;
        }

        body,
        html {
            color: white;

            min-height: 100vh;
        }

        body {
            background-image: url('image/index.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: bottom;
        }

        .center .avatar img {
            border-radius: 50%;
            width: 160px;
            height: 160px;
            margin-top: 5%;
            object-fit: cover;
            object-position: 0 0px;
        }

        .center {
            transform: translate(65%,10%);
            width: 45%;
            background-color: rgba(0, 0, 0, 0.7);
            height: 50vh;
            text-align: center;
            border-radius: 5px;
        }

        .content {
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        h2 {
            color: wheat;
        }

        .content h3,
        p {
            font-weight: lighter;
            letter-spacing: 1px;
            width: 70%;
            margin: 10px auto;
        }

        .content h3 {
            font-weight: 400;
        }

        .content h4 {
            margin-top: 20px;
        }

        div.social i {
            padding: 0 10px;
            font-size: 30px;
            color: rgba(255, 255, 255, 0.6);
            transition: 0.4s;
        }

        div.social i:hover {
            color: rgba(255, 255, 255, 1);
        }
    </style>
</head>
<?php include('head.php');
      session_start();?>
<body>
    <?php
                global $db;
                require_once('./library.php');
                if ($_SESSION['type'] == NULL){
                        echo "<script>
                        alert('Please log in first!');
                        window.location.href='index.php';
                        </script>";
	            }
                $user = &$_SESSION['userID'];
                $type = &$_SESSION['type'];
                $db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
                $result = mysqli_query($db_connection,"SELECT user.userID, userFirst, userLast, userfavorite.id AS fav
                                                        FROM user LEFT JOIN userfavorite ON user.userID = userfavorite.userID 
                                                        WHERE user.userID = $user
                                                        ");
                $row = mysqli_fetch_array($result);
                ?>
    <div class="center">
        <div class="avatar">
            <img src="image/user.jpg"
                alt="face">
        </div>
        <div class="content">
            <h2><?php echo $row[userFirst];?>  <?php echo $row[userLast];?></h2>
            <h3>User Group: <?php echo $type;?></h3>
            <h3>Favorite Movie: <?php echo $row[fav];?>
            </h3>
            <form class="float-right" action = 'addfavorite.php' method='post'>
                <input type="hidden" name='operation' value='delete' />
                <input type = 'hidden'  name = 'userID' value='<?php echo $user; ?>' /></p>
                <button class="btn young-passion-gradient btn-lg float-right" type="submit">Remove Fevorite</button>
        </form>
        </div>
        </br>
        </br>
        <div class="social">
            <?php
                $comment = mysqli_query($db_connection,"SELECT user.userID, userFirst, userLast, comment.id, comment, movie.title
                                                        FROM user LEFT JOIN comment ON user.userID=comment.userID LEFT JOIN movie ON comment.id=movie.id
                                                        WHERE user.userID = $user
                                                        ");
                while($c = mysqli_fetch_array($comment)){;
                ?>
            	<div class="card winter-neva-gradient">
                    <div class="card-body ">
                        <h3 class="float-left"><?php echo $c['title'];?></h3>
                        <h5><?php echo $c['comment'];?></h5>
                    </div>
                </div>
                <?php }?>
        </div>
    </div>

</body>

</html>