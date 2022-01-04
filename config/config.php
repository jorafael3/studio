<?php
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$u = "$_SERVER[HTTP_HOST]";
//define('URL','http://10.5.2.191:8080/cartimexed/');// ip local:puerto
define('URL','http://'.$u.'/studio/');// ip local:puerto


define('HOST', 'localhost');
define('DB', 'studio');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');

?>
