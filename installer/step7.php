<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<br><br>
<div class = "container">
<?php
session_start();
if(isset($_SESSION['error_connection'])){
    echo $_SESSION['error_connection'];
    unset($_SESSION['error_connection']);
}
include_once("../config/connect.php");

$name = $_POST['admin_login'];
$userName = $_POST['admin_login'];
$password = $_POST['passwd'];

if(!$mysqli){
    header("Location: step6.php");
    $_SESSION['error_connection'] = '<script language="javascript">alert("Nie udało się połączyć z bazą danych!")</script>';
} else {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $insertUsers = "INSERT INTO 'users' VALUES (NULL, '$name', 'admin@wp.pl' , '$userName', '$passwordHash', 1 , now())";

    $sqli=mysqli_query($mysqli, $insertUsers);
    if($sqli){
        echo "Udało się wstawić dane administratora";
    } else {
        echo "Nie udało się wstawić danych administratora"; 
    }                                
}            
?>

<br>
<form action="step6.php" method="POST">
    <button type="submit" name="next" class="btn btn-primary btn-lg">Powrót do poprzedniego kroku</button>
</form>
<form action="../index.php" method="POST">
    <button type="submit" name="next" class="btn btn-success btn-lg">Zakończ</button><br>
    <h3>Gratulacja - instalacja zakończona</h3>
    <h5>Po zakończeniu usuń folder "installer.php"!</h5>
    <h5>Zmień prawa dostępu do "connect.php"</h5>
</form>
</div>