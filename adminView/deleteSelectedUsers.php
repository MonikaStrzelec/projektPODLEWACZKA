<?php
    session_start();
    if(!isset($_SESSION['logged']))
    {
        header('Location: ../index.php');
        exit();
    }
	require_once '../config/connect.php';

    if(isset($_GET['delete'])) {
        if($result = @$mysqli->query(sprintf("DELETE FROM users WHERE id = %s", $_GET['delete'])))
        {
            echo 'Usunięto z bazy wybrane rekordy';
            header('Location: adminView/viewAllUsers.php'); 
        } else{ 
            echo "Usunięcie konta nie powiodło się<br/>".mysqli_error($mysqli);
        }
    }
?>