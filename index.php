<?php
require_once "libs/database.php";
require_once "libs/controller.php";
require_once "libs/view.php";
require_once "libs/model.php";
require_once "libs/app.php";
require_once "libs/createData.php";

require_once "config/config.php";


$data = new Database();
$cr = new CreateData();


//$db = $data->VAlidate();
//var_dump($db);


if ($data->connect()) {
    //include_once 'views/install/install.php';
    $d = $cr->Create_DataBase();
    if (count($d) <= 0) {
		header('Location: /studio/ins/install/instalar.php');

    } else {
        $app = new App();

    }
    //var_dump($d);



} else {
}
