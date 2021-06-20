<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<br><br>
<div class = "container">
<h2>Uzupełnianie tabel danymi:</h2>
<?php
    session_start();
    include_once("../config/connect.php");

    //Uzupełnienie tabel
    $password ="admin";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $insertUsers="INSERT INTO `users` VALUES (NULL, 'admin', 'admin@wp.pl', 'admin', '$passwordHash', 1 , now())";
    
    $sqli=mysqli_query($mysqli, $insertUsers);
    if($sqli){
        echo "<h3>Udało się wstawić dane do tabeli users</h3>";
    } else {
        echo "<h3>Nie udało się wstawić danych tabeli users</h3>"; 
    }
?>

<br>
<form action="step6.php" method="POST">
    <button type="submit" name="next" class="btn btn-primary btn-lg">Powrót do poprzedniego kroku</button>
</form>
</div>