<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<br><br>
<div class = "container">
<?php
    if(file_exists("../config/connect.php"))
    {
        echo "<h3>Plik connect.php już istnieje</h3>";
        if (!is_writable( "../config/connect.php") ) {
            echo "W pliku connect.php ustaw prawa dostępu tak aby plik był zapisywalny. np. <code>chmod o+w ".$connect_file."</code></p>";
        }
?>
    <br>
    <form action='step2.php' method='POST'>
        <button type='submit' class='btn btn-success btn-lg' name='nextStep'>Przejdź do następnego kroku</button>
    </form>
<?php

    } else {
        echo '<h2>Plik connect.php nie istnieje</h2>';
        echo "Stwórz plik connect.php w folderze PROJEKTPODLEWACZKA/config ";
        echo "W pliku Config.php ustaw prawa dostępu tak aby plik był zapisywalny.";
    }
?>
</div>