<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<?php
    session_start();
    if(isset($_SESSION['error_connection'])){
        echo $_SESSION['error_connection'];
        unset($_SESSION['error_connection']);
    }
?>
<br><br>
<div class = "container">
    <h3>Formularz</h3>
    <br>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <form action="step7.php" method="POST" >

        <h3>Konto administratora</h3>
        
        <input type="text" placeholder="Login administratora" name="admin_login" required="">
        <br><br>

        <input type="text" placeholder="Hasło administratora" name="passwd" required="">
        <br><br>

        <input type="text" placeholder="Powtórzenie hasła administratora" name="dbname" required="">
        <br><br>

        <button type="submit" class="btn btn-success btn-lg" name="nextStep">Przejdź dalej</button>
    </form>
</div>