<?php
    session_start();
    require_once "../config/connect.php";    
    if((!isset($_POST['userName'])) || (!isset($_POST['password']))){
        header('Location: ../index.php');
        exit();
    }
    
    if ($mysqli->connect_errno!=0) {
        echo "Error".$mysqli->connect_errno."Opis: ".$mysqli->connect_error;
    } else{
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $userName = htmlentities($userName, ENT_QUOTES, "UTF-8");

        if ($result = @$mysqli->query(sprintf("SELECT * FROM users WHERE userName='%s'",
        mysqli_real_escape_string($mysqli, $userName)))){
            $howManyUsers = $result->num_rows;

            if ($howManyUsers > 0){
                $_SESSION['logged'] = true; //jesteśmy zalogowani
                $user = $result->fetch_array(); //tablicja asocacyjna
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['userName'] = $user['userName'];
                $_SESSION['userRank'] = $user['userRank'];
                $_SESSION['dataRegister'] = $user['dataRegister'];

                unset($_SESSION['loginError']); //usunięcie z sesji zmienną
                $result->free_result();
                header('Location: ../index.php');
            } else{
                $_SESSION['loginError']='<span style="color:red">Nieprawidłowe hasło!</span>';
                header('Location: ../SingIn/loginForm.php');
            }
        }
        $mysqli->close();
    }
?>