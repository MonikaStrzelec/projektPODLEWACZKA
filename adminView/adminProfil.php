<?php
session_start();
if(file_exists('../config/connect.php')) require_once('../config/connect.php');

if(!isset($_SESSION['logged'])) //w każdej podstronie tylko dla zalogowanych
{
    header('Location: index.php');
    exit();
}
if(file_exists('../templates/headerForAdmin.php')) include('../templates/headerForAdmin.php');
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
        <div class="container overflow-hidden">
            <div class="row gy-5">
                <div></div>
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" class="card-img-top" viewBox="0 0 16 16" alt="tutaj powinien wyświetlić się obraz">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                          </svg>
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">EDYTUJ PROFIL</h5>
                            <p class="card-text" style="text-align: center;">
                                <?php
                                    echo "<p><b>Imię: </b>".$_SESSION['name'];
                                    echo "<p><b>Nick: </b>".$_SESSION['userName'];
                                    echo "<p><b>E-mail: </b>".$_SESSION['email'];
                                ?>
                            </p>
                            <div class="d-grid">
                            <a class="btn btn-success" href="../SingIn/editUser.php">Edytuj dane użytkownika</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                    <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" class="card-img-top" viewBox="0 0 16 16" alt="tutaj powinien wyświetlić się obraz">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">USUWANIE KONTA</h5>
                            <p class="card-text" style="text-align: center;">
                                <span
                                    style="color: #000000; font-family: 'Arial'; font-size: 14pt; font-weight: normal; vertical-align: baseline; text-align: center">
                                    </br></br>
                                    W tym miejscu Możesz usunąć swoje konto. Pamiętaj, że
                                    Masz uprawnienia administratora. Nim usuniesz konto, dobrze to przemyśl
                                    i najlepiej skontaktuj się z pracodawcą.
                                </span>
                            </p>
                            <div class="d-grid">
                                <a href="../deleteUser.php" class="btn btn-success">Usuń konto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

   <br><br><br>
<?php
    if(file_exists('../templates/footer.php')) include('../templates/footer.php');
    ob_end_flush();
?>