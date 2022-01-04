<?php
require_once "libs/database.php";


class CreateData
{



    function Create_DataBase()
    {
        $data = new Database();

        $query = $data->connect()->prepare("CREATE SCHEMA IF NOT EXISTS studio");
        if ($query->execute()) {
            return "ok";
        } else {
            return "err";
        }
    }
}
