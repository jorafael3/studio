<?php
if (isset($_POST['install'])) {
    $ordenes = "asdasd";
    require_once "libs/database.php";
    $data = new Database();
    $db = $data->Create_DataBase();
    //unlink('././cf.txt');
    $ordenes = json_encode($db);
    echo $ordenes;
}
