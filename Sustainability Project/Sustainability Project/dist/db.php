<?php

$dsn = "mysql:host=localhost;dbname=projecttest;charset=utf8mb4" ;
$dbuser = "root" ;
$pass = "" ;

try {
    $db = new PDO($dsn, $dbuser, $pass) ;
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
} catch (Exception $ex) {
   echo "DB Connection Error : " .  $ex->getMessage() ;
}