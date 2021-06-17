<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "test";
//$prefix = "ms";

// Create connection
$mysqli = @new mysqli($host, $user, $password, $dbname);

// Check connection
if ($mysqli->connect_errno!=0) {
    echo "Error".$mysqli->connect_errno."Opis: ".$mysqli->connect_error;
    exit();
}

$url = "http://localhost/PROJEKTPODLEWACZKA/";
?>