<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<?php
    include_once("../config/connect.php");

    //tabela users
    $Users="CREATE TABLE `users` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(20) NOT NULL,
    `email` varchar(55) NOT NULL,
    `userName` varchar(25) NOT NULL,
    `password` varchar(255) NOT NULL,
    `userRank` int(1) NOT NULL,
    `dataRegister` datetime NOT NULL
    PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $sqli=mysqli_query($mysqli, $Users);
    if($sqli){
        echo '<h3>Udało się utworzyć tabele "users" <br></h3>';
    } else {
        echo '<h3>Niestety nie udało się utworzyć tabeli "users"! <br></h3>'; 
    }


    //tabela usersPreferences
    $usersPreferences = "CREATE TABLE `usersPreferences` (
    `idUsersPreferences` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `idUser` int(11) NOT NULL,
    `userArea` int(6) DEFAULT NULL,
    `maxIrrigation` varchar(20) DEFAULT NULL,
    `flexRadioDefault` varchar(20) DEFAULT NULL,
     KEY `idUser` (`idUser`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $sqli=mysqli_query($mysqli, $usersPreferences);
    if($sqli){
        echo '<h3>Udało się utworzyć tabele "usersPreferences"</h3>';
    } else {
        echo '<h3>Nie udało się utworzyć tabeli "usersPreferences"</h3>'; 
    }
 

    //Uzupełnienie tabel
    $password ="admin";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $insertUsers="INSERT INTO `users` VALUES (NULL, 'admin', 'admin@wp.pl', 'admin', '$passwordHash', 1 , now())";
    
    $sqli=mysqli_query($mysqli, $insertUsers);
    if($sqli){
        echo "Udało się wstawić dane do tabeli users";
    } else {
        echo "Nie udało się wstawić danych tabeli users"; 
    }
?>

<!-- <br>
<form action="step4.php" method="POST">
    <button type="submit" name="next" class="btn btn-primary btn-lg">Powrót do poprzedniego kroku</button><br>
</form>
<br>
<form action="../index.php" method="POST">
    <button type="submit" name="next" class="btn btn-success btn-lg">Zakończ</button><br>
    <h3>Gratulacja - instalacja zakończona</h3>
    <h5>Po zakończeniu usuń folder "installer.php"!</h5>
    <h5>Zmień prawa dostępu do "connect.php"</h5>
</form> -->

<br>
<form action="step4.php" method="POST">
    <button type="submit" name="next" class="btn btn-primary btn-lg">Powrót do poprzedniego kroku</button>
</form>
<form action="../index.php" method="POST">
    <button type="submit" name="next" class="btn btn-success btn-lg">Zakończ</button><br>
    <h3>Gratulacja - instalacja zakończona</h3>
    <h5>Po zakończeniu usuń folder "installer.php"!</h5>
    <h5>Zmień prawa dostępu do "connect.php"</h5>
</form>