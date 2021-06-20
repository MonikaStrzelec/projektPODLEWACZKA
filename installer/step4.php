<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<?php
    session_start();
    if(isset($_SESSION['success_config'])){
        echo $_SESSION['success_config'];
        unset($_SESSION['success_config']);
    }
?>

<h3>Tworzenie struktury tabel</h3>

<br><br>
<form action="step5.php" method="POST">
    <button type="submit" name="nextStep" class="btn btn-success btn-lg">Utwórz strukturę tabel</button><br>
</form>