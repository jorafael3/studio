<?php
require_once "libs/database.php";


class CreateData
{



    function Create_DataBase()
    {
        $data = new Database();

        $query = $data->connect()->prepare("SHOW DATABASES LIKE 'studio'");
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return "err";
        }
    }
}
