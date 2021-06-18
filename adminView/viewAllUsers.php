<?php
    session_start();
    require_once '../config/connect.php';
    if(!isset($_SESSION['logged'])) //w każdej podstronie tylko dla zalogowanych
    {
        header('Location: index.php');
        exit();
    }
    if(file_exists('../templates/headerForAdmin.php')) include('../templates/headerForAdmin.php');

    mysqli_report(MYSQLI_REPORT_STRICT); 
    try{
        if ($mysqli->connect_errno!=0) {
            throw new Exception(mysqi_connect_errno());
        } else{
            $result = $mysqli->query("SELECT * FROM `users`");
            if (!$result){
                throw new Excpetion($mysqli->error);
                $mysqli->close();
            }
        }
    }catch(Exception $error){
        echo '<span style="color:red">Błąd serwera, przepraszamy za niegodoność. Zarejestruj sie puźniej</span>';
    }
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full"
        style="background-image: url('https://www.bracia.net.pl/wp-content/uploads/2018/10/zielone-tlo-196325.jpg')">
        <div class="text-center my-5">
            <!-- LOGO!!! pod adresem-->
            <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" class="card-img-top" viewBox="0 0 16 16" alt="tutaj powinien wyświetlić się obraz">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>

            <?php
                echo "<h4><p>Witaj administratorze: </h4><h2>".$_SESSION['name']."</h2>";             
            ?>

        </div>
    </header>

    <section>
            <div class="card">
                <div class="card-header">
                    <br>
                    <h3>Lista wszystkich uzytkowników</h3>
                </div>
                <form action="deleteSelectedUsers.php" metod="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <?php
                                    //Definicja nagłówków tabeli
                                    echo "<td><strong>id</strong></td>";
                                    echo "<td><strong>Imię</strong></td>";
                                    echo "<td><strong>e-mail</strong></td>";
                                    echo "<td><strong>Nazwa użytkownika</strong></td>";
                                    echo "<td><strong>Ranga</strong></td>";
                                    echo "<td><strong>Data rejestracji</strong></td>";
                                    echo "<td><strong>Usuń</strong></td>";
                                    echo "</tr>";
                                ?>
                            </thead>
                            <tbody>
                                <?php
                                    //Wyświetlenie kolejnych wierszy z tabeli users
                                    while ( $row = mysqli_fetch_row($result) ) {
                                        echo "</tr>";    
                                        echo "<td>" . $row[0] . "</td>";
                                        echo "<td>" . $row[1] . "</td>";
                                        echo "<td>" . $row[2] . "</td>";
                                        echo "<td>" . $row[3] . "</td>";
                                        echo "<td>" . $row[5] . "</td>";
                                        echo "<td>" . $row[6] . "</td>";
                                        echo '<td><a href="deleteSelectedUsers.php?delete='.$row[0].'" class="btn btn-danger" >Usuń</a></td>';
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                ?>
                            </tbody>
                        </table>

                        <br>
                    </div>
                </form>
            </div>
    </section>

    <br>
<?php
    if(file_exists('../templates/footer.php')) include('../templates/footer.php');
    ob_end_flush();
?>