<?php
    class DbUtil{
    public static $user = "xl9yr";
    public static $pass = "ytxwz19Y!";
    public static $host = "usersrv01.cs.virginia.edu";
    public static $schema = "xl9yr_alldbs";
    public static function loginConnection() {
    $db = new mysqli(DbUtil::$host, DbUtil::$user,
    DbUtil::$pass, DbUtil::$schema);
    if($db->connect_errno) {
    echo "fail";
    $db->close();
    exit();
    }
    return $db;
    }
    }
?>