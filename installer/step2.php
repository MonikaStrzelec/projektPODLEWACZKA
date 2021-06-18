<?php
    session_start();
    if(isset($_SESSION['error_connection'])){
        echo $_SESSION['error_connection'];
        unset($_SESSION['error_connection']);
    }
?>

<h3>Formularz dla pliku connect</h3>
<br>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<form action="step3.php" method="POST" >

    <input type="text" placeholder="nazwa hosta" name="host" required="">
    <br><br>

    <input type="text" placeholder="user" name="user" required="">
    <br><br>

    <input type="password" placeholder="hasło" name="password">
    <br><br>
     
    <input type="text" placeholder="nazwa bazy danych" name="dbname" required="">
    <br><br>

    <input type="text" placeholder="prefix (nie jest wymagany)" name="prefix">
    <br><br>

    <button type="submit" class="btn btn-success btn-lg" name="nextStep">Przejdź dalej</button>
</form>