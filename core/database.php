<?php

class Database
{
    static public function GetConnection()
    {
        try
        {
            return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USR, DB_PWD );
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
            die();
        }
    }
}

?>