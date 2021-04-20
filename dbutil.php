<?php
class DbUtil{
    public static $loginUser = "jab7yp";
    public static $loginPass = "Spr1ng2021!";
    public static $host = "usersrv01.cs.virginia.edu"; // DB Host
    public static $schema = "jab7yp_dummy"; // DB Schema

    public static function loginConnection(){
        $db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);

        if($db->connect_errno){
            echo("Could not connect to DB");
            $db->close();
            exit();
        } else {
            // echo("Connected to the DB");
        }
        return $db;
    }
}
?>