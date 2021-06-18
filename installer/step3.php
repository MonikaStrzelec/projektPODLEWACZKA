<?php
    session_start();
    $host = $_POST['host'];
    $user = $_POST['user'];
    $password =$_POST['password'];
    $dbname =$_POST['dbname'];

    $mysqli = @new mysqli($host, $user, $password, $dbname);

    if(!$mysqli){
        header("Location: step2.php");
        $_SESSION['error_connection'] = '<script language="javascript">alert("Nie udało się połączyć z bazą danych!")</script>';
    } else {
        $holder = fopen("../config/connect.php", "w");  
        fwrite($holder,
        "<?php"."\n"
        .'$host='."'".$_POST['host']."'".';'."\n"
        .'$user='."'".$_POST['user']."'".';'."\n"
        .'$password='."'".$_POST['password']."'".';'."\n"
        .'$dbname='."'".$_POST['dbname']."'".';'."\n"
        .'$prefix='."'".$_POST['prefix']."'".';'."\n"
        ."\n"
        .'$mysqli = @new mysqli($host, $user, $password, $dbname);'."\n"
        ."\n"
        .'if ($mysqli->connect_errno!=0) {'."\n"
        .'echo "Error".$mysqli->connect_errno."Opis: ".$mysqli->connect_error;'."\n"
        .'exit();}'."\n"
        ."\n"
        .'$url = "http://localhost/PROJEKTPODLEWACZKA/";'."\n"
        .'?>'."\n" );
        fclose($holder);

        $_SESSION['success_config'] = '<script language="javascript">alert("Plik connect.php został uzupełniony danymi!")</script>';
        header("Location: step4.php");                                    
    }            
?>