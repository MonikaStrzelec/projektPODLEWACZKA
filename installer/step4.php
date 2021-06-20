<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<?php
    session_start();
    if(isset($_SESSION['success_config'])){
        echo $_SESSION['success_config'];
        unset($_SESSION['success_config']);
    }
?>
<br><br>
<div class = "container">
<h2>Tworzenie struktury tabel:</h2>
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
        echo '<h4>Udało się utworzyć tabele "users" <br></h4>';
    } else {
        echo '<h4>Niestety nie udało się utworzyć tabeli "users"! <br></h4>'; 
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
        echo '<h4>Udało się utworzyć tabele "usersPreferences"</h4>';
    } else {
        echo '<h4>Nie udało się utworzyć tabeli "usersPreferences"</h4>'; 
    }
?>

<br>
<form action="step5.php" method="POST">
    <button type="submit" name="nextStep" class="btn btn-success btn-lg">Utwórz strukturę tabel</button><br>
</form>
</div>