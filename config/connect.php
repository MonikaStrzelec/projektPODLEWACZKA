<?php
$host='localhost';
$user='root';
$password='';
$dbname='test';
$prefix='';

$mysqli = @new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_errno!=0) {
echo "Error".$mysqli->connect_errno."Opis: ".$mysqli->connect_error;
exit();}

$url = "http://localhost/PROJEKTPODLEWACZKA/";
?>
