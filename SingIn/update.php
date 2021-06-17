<?php
    session_start();
    require_once '../config/connect.php';
    if(!isset($_SESSION['logged']))
    {
        header('Location: ../index.php');
        exit();
    }
	$id=$_GET['id'];
    try 
    {
        //walidacja danych za jednym razem
        function walidateTestInput($input) {
            $input = trim($input); //usuwa spacje, tabulatory itp
            $input = stripslashes($input); //usuwanie ukośników
            $input = htmlspecialchars($input);
            return $input;
        }

        $_SESSION['name'] = $_POST['name'];
        $_SESSION['userName'] = $_POST['userName'];

        if(isset($_POST['name']))
        {
            $name = walidateTestInput($_POST['name']);
            $result = $mysqli->query("UPDATE users SET name = '$name' WHERE id = '$id'");
        }
        if(isset($_POST['email']))
        {
            $email = walidateTestInput($_POST['email']);
            $result = $mysqli->query("UPDATE users SET email = '$email' WHERE id = '$id'");
        }
        if(isset($_POST['userName']))
        {
            $userName = walidateTestInput($_POST['userName']);
            $result = $mysqli->query("UPDATE users SET userName = '$userName' WHERE id = '$id'");
        }
        if(isset($_POST['password']))
        {
            $password = walidateTestInput($_POST['password']);
            $result = $mysqli->query("UPDATE users SET password = '$password' WHERE id = '$id'");
        }
        $_SESSION['name'] = $name;
        $_SESSION['userName'] = $userName;
        $_SESSION['email'] = $email;        
        header('Location: ../userProfile.php');

    } catch(Exception $error) {
        echo "<p class='pad'>Aktualizacja nieudana!</p>";
        $_SESSION['error'] = 'Nie udało się dodać użytkownika do bazy danych!';    
    }
?>