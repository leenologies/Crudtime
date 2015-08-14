<?php
$dsn = 'mysql:host=yourhost;dbname=yourDatabase'
$user='yourUsername';
$password='yourPassword';



try{
$dbconn = new PDO($dsn,$user,$password);
$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

Catch(PDOException $e){
echo "Connection Failed".$e->getMessage();
}

include_once 'class.employee.php';
$employee = new employee($db_conn);


?>
