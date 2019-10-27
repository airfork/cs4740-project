<?php
class DbUtil{
    public static $loginUser = "osa2qx";
    public static $loginPass = '';
    public static $host = "cs4750.cs.virginia.edu";
    public static $schema = "osa2qx_project"; // DB Schema

    public static function loginConnection(){
        DbUtil::$loginPass = getenv('DB_PASS');
        $db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);

        if($db->connect_errno){
            echo("Could not connect to db");
            $db->close();
            exit();
        }

        return $db;
    }

}
?>