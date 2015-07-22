<?php
$user='root';
$password='portmore38';
$db='TheCompany';


try{
$dbconn = new PDO('mysql:host=localhost;dbname=TheCompany','root','portmore38');
$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

Catch(PDOException $e){
echo "Connection Failed".$e->getMessage();
}

include_once 'class.employee.php';
$employee = new employee($db_conn);


?>