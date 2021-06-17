<?php
    session_start();
    if(!isset($_SESSION['logged']))
    {
        header('Location: index.php');
        exit();
    }
    $id = $_SESSION['id'];
	require_once 'config/connect.php';

    if($result = @$mysqli->query(sprintf("DELETE FROM users WHERE id = '%s'",
    mysqli_real_escape_string($mysqli, $id))))
    {
        session_unset();
        header('Location: index.php');     
    } else{ 
        echo "Usunięcie konta nie powiodło się";
    }
    $mysqli->close();  
?>