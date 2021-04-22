<?php
class DbUtil{
    public static $loginUser = 'psr4pv';
    public static $loginPass = '$AquariumPass10';
    public static $host = 'usersrv01.cs.virginia.edu'; // DB Host
    public static $schema = 'psr4pv'; // DB Schema

    public static function loginConnection(){
        $db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);

        if($db->connect_errno){
            echo('Could not connect to DB');
            $db->close();
            exit();
        } else {
            // echo('Connected to the DB');
        }
        return $db;
    }
}
?>