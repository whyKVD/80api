<?php
$db_user    = "root";
$db_passwd  = "";
$db_name    = "80api";

$db = new PDO("mysql:host=localhost;dbname=".$db_name,$db_user,$db_passwd);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define("APP_NAME", "80 api");
?>
