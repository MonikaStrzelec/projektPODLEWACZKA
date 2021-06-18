<?php
    session_start();
    require_once '../config/connect.php';
    if(!isset($_SESSION['logged']))
    {
        header('Location: ../index.php');
        exit();
    }
	$id=$_GET['id'];

		// $name=$_POST['name'];
		// $email=$_POST['email'];
		// $userName=$_POST['userName'];
		// $password=$_POST['password'];
		// $password2=$_POST['password2'];

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
            // $goodWalidation=true;
            //  //Imię od 3 do 20 znaków
            // if((strlen($name)<3) || (strlen($name)>20)){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_name']="Imię musi posiadać od 3 do 20 znaków";
            // }
            $name = walidateTestInput($_POST['name']);
            $result = $mysqli->query("UPDATE users SET name = '$name' WHERE id = '$id'");
        }
        if(isset($_POST['email']))
        {
            //sanityzacja email
            // $emailSafe=filter_var($email, FILTER_SANITIZE_EMAIL);
            // if((filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false) || ($emailSafe!=$email)){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_email']="Podaj poprawny adres e-mail";			
            // }
            $email = walidateTestInput($_POST['email']);
            $result = $mysqli->query("UPDATE users SET email = '$email' WHERE id = '$id'");
        }
        if(isset($_POST['userName']))
        {
            //  //Nick od 3 do 25 znaków
            // if((strlen($userName)<3) || (strlen($userName)>25)){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_userName']="Nick musi posiadać od 3 do 25 znaków";
            // }
            // if(ctype_alnum($userName)==false){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_userName']="Nick mmoże składac się tylko z liter i cyfr(bez polskich znaków)";
            // }

            $userName = walidateTestInput($_POST['userName']);
            $result = $mysqli->query("UPDATE users SET userName = '$userName' WHERE id = '$id'");
        }
        if(isset($_POST['password2']))
        {   
            // $password=$_POST['password'];
		    // $password2=$_POST['password2'];

            //  //poprawność hasła. od 6 do 20 znaków
            // if((strlen($password)<6) || (strlen($password)>20)){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_password']="Hasło musi posiadać od 6 do 20 znaków";
            // }
            // if($password!=$password2){
            // 	$goodWalidation=false;
            // 	$_SESSION['error_password']="Hasła nie są identyczne!";
            // }
            // $passwordHash = password_hash($password, PASSWORD_DEFAULT); //255ZNAKÓW NA HASŁO w bazie przez hash!!

            $password = walidateTestInput($_POST['password2']);
            $result = $mysqli->query("UPDATE users SET password = '$password' WHERE id = '$id'");
        }
        $_SESSION['name'] = $name;
        $_SESSION['userName'] = $userName;
        $_SESSION['email'] = $email;        
        header('Location: ../index.php');

    } catch(Exception $error) {
        echo "<p class='pad'>Aktualizacja nieudana!</p>";
        $_SESSION['error'] = 'Nie udało się dodać użytkownika do bazy danych!';    
    }
?>