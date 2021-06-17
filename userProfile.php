<?php
session_start();
if(!isset($_SESSION['logged'])) //w każdej podstronie tylko dla zalogowanych
{
    header('Location: index.php');
    exit();
}
echo "zalogowany jest:".$_SESSION['logged']." imie: ".$_SESSION['name']." o radze: ".$_SESSION['userRank'];
if(file_exists('templates/headerForUsers.php')) include('templates/headerForUsers.php');
?>

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
        echo "<h1><p>Witaj ".$_SESSION['name']."</h1>";             
    ?>

            <p class="text-white-55"><strong>Twój ogród Ci podziękuje!</strong></p>
        </div>
    </header>

    <section>
        <div class="py-5 bg-image-full"
            style="background-image: url('https://img.freepik.com/darmowe-zdjecie/zielona-akwarela-malowane-tekstura-tlo_23-2147836295.jpg?size=626&ext=jpg')">
            <section>
                <div class="container overflow-hidden">
                    <div class="row gy-5">
                        <div class="col-md-12 col-lg-6">
                            <div class="p-3">
                                <p class="mb-0">
                                <h2>Twoje aktualne ustawienia to:</h2>
                                </p>
                                
                                NAWILŻENIE MA SIĘ WYŚWIETLAĆ

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <img src="https://static.fajnyogrod.pl/media/uploads/media_image/original/wpis/3898/pomysly-na-ogrod.jpg"
                                class="card-img-top" alt="tutaj powinien wyświetlić się obraz">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <section>
        <div class="container overflow-hidden">
            <div class="row gy-5">
                <div></div>
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                    <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" class="card-img-top" class="card-img-top" viewBox="0 0 16 16" alt="tutaj powinien wyświetlić się obraz">
                            <path d="M6.174 1.184a2 2 0 0 1 3.652 0A2 2 0 0 1 12.99 3.01a2 2 0 0 1 1.826 3.164 2 2 0 0 1 0 3.652 2 2 0 0 1-1.826 3.164 2 2 0 0 1-3.164 1.826 2 2 0 0 1-3.652 0A2 2 0 0 1 3.01 12.99a2 2 0 0 1-1.826-3.164 2 2 0 0 1 0-3.652A2 2 0 0 1 3.01 3.01a2 2 0 0 1 3.164-1.826zM8 1a1 1 0 0 0-.998 1.03l.01.091c.012.077.029.176.054.296.049.241.122.542.213.887.182.688.428 1.513.676 2.314L8 5.762l.045-.144c.248-.8.494-1.626.676-2.314.091-.345.164-.646.213-.887a4.997 4.997 0 0 0 .064-.386L9 2a1 1 0 0 0-1-1zM2 9l.03-.002.091-.01a4.99 4.99 0 0 0 .296-.054c.241-.049.542-.122.887-.213a60.59 60.59 0 0 0 2.314-.676L5.762 8l-.144-.045a60.59 60.59 0 0 0-2.314-.676 16.705 16.705 0 0 0-.887-.213 4.99 4.99 0 0 0-.386-.064L2 7a1 1 0 1 0 0 2zm7 5-.002-.03a5.005 5.005 0 0 0-.064-.386 16.398 16.398 0 0 0-.213-.888 60.582 60.582 0 0 0-.676-2.314L8 10.238l-.045.144c-.248.8-.494 1.626-.676 2.314-.091.345-.164.646-.213.887a4.996 4.996 0 0 0-.064.386L7 14a1 1 0 1 0 2 0zm-5.696-2.134.025-.017a5.001 5.001 0 0 0 .303-.248c.184-.164.408-.377.661-.629A60.614 60.614 0 0 0 5.96 9.23l.103-.111-.147.033a60.88 60.88 0 0 0-2.343.572c-.344.093-.64.18-.874.258a5.063 5.063 0 0 0-.367.138l-.027.014a1 1 0 1 0 1 1.732zM4.5 14.062a1 1 0 0 0 1.366-.366l.014-.027c.01-.02.021-.048.036-.084a5.09 5.09 0 0 0 .102-.283c.078-.233.165-.53.258-.874a60.6 60.6 0 0 0 .572-2.343l.033-.147-.11.102a60.848 60.848 0 0 0-1.743 1.667 17.07 17.07 0 0 0-.629.66 5.06 5.06 0 0 0-.248.304l-.017.025a1 1 0 0 0 .366 1.366zm9.196-8.196a1 1 0 0 0-1-1.732l-.025.017a4.951 4.951 0 0 0-.303.248 16.69 16.69 0 0 0-.661.629A60.72 60.72 0 0 0 10.04 6.77l-.102.111.147-.033a60.6 60.6 0 0 0 2.342-.572c.345-.093.642-.18.875-.258a4.993 4.993 0 0 0 .367-.138.53.53 0 0 0 .027-.014zM11.5 1.938a1 1 0 0 0-1.366.366l-.014.027c-.01.02-.021.048-.036.084a5.09 5.09 0 0 0-.102.283c-.078.233-.165.53-.258.875a60.62 60.62 0 0 0-.572 2.342l-.033.147.11-.102a60.848 60.848 0 0 0 1.743-1.667c.252-.253.465-.477.629-.66a5.001 5.001 0 0 0 .248-.304l.017-.025a1 1 0 0 0-.366-1.366zM14 9a1 1 0 0 0 0-2l-.03.002a4.996 4.996 0 0 0-.386.064c-.242.049-.543.122-.888.213-.688.182-1.513.428-2.314.676L10.238 8l.144.045c.8.248 1.626.494 2.314.676.345.091.646.164.887.213a4.996 4.996 0 0 0 .386.064L14 9zM1.938 4.5a1 1 0 0 0 .393 1.38l.084.035c.072.03.166.064.283.103.233.078.53.165.874.258a60.88 60.88 0 0 0 2.343.572l.147.033-.103-.111a60.584 60.584 0 0 0-1.666-1.742 16.705 16.705 0 0 0-.66-.629 4.996 4.996 0 0 0-.304-.248l-.025-.017a1 1 0 0 0-1.366.366zm2.196-1.196.017.025a4.996 4.996 0 0 0 .248.303c.164.184.377.408.629.661A60.597 60.597 0 0 0 6.77 5.96l.111.102-.033-.147a60.602 60.602 0 0 0-.572-2.342c-.093-.345-.18-.642-.258-.875a5.006 5.006 0 0 0-.138-.367l-.014-.027a1 1 0 1 0-1.732 1zm9.928 8.196a1 1 0 0 0-.366-1.366l-.027-.014a5 5 0 0 0-.367-.138c-.233-.078-.53-.165-.875-.258a60.619 60.619 0 0 0-2.342-.572l-.147-.033.102.111a60.73 60.73 0 0 0 1.667 1.742c.253.252.477.465.66.629a4.946 4.946 0 0 0 .304.248l.025.017a1 1 0 0 0 1.366-.366zm-3.928 2.196a1 1 0 0 0 1.732-1l-.017-.025a5.065 5.065 0 0 0-.248-.303 16.705 16.705 0 0 0-.629-.661A60.462 60.462 0 0 0 9.23 10.04l-.111-.102.033.147a60.6 60.6 0 0 0 .572 2.342c.093.345.18.642.258.875a4.985 4.985 0 0 0 .138.367.575.575 0 0 0 .014.027zM8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                          </svg>
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">USTAWIENIA NAWADNIANIA</h5>
                            <p class="card-text" style="text-align: center;">
                                <span
                                    style="color: #000000; font-family: 'Arial'; font-size: 12pt; font-weight: normal; vertical-align: baseline; text-align: center">
                                    </br></br>
                                    W tym miejscu możesz edytować Swoje ustawienia nawadniania. 
                                    Myślisz, że Twoje rośliny potrzebują więcej wody? A może są podlewane za często?
                                    Albo nie Ustawiłeś jeszcze preferencji nawadniania?
                                    Dla Nast to żaden problem! Wypełnij formularz ustawień nawadniania, 
                                    który możesz w każdej chwili edytować!
                                </span>
                            </p>
                            <div class="d-grid">
                                <a href="userPreferecesForm.php" class="btn btn-success">Ustawienia</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <a class="btn btn-success" href="SingIn/editUser.php">Edytuj dane użytkownika</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card text-center">
                    <div class="card-header">
                        <h5>USUWANIE KONTA</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Nie jesteś zadowolony z Podlewaczki? Chcesz usunąć konto? Jest nam bardzo przykro, jednak możesz dokonać tego tutaj.</h6>
                        <div class="d-grid">
                            <a class="btn btn-success" href="deleteUser.php">Usuń konto</a>
                        </div>
                    </div>
                </div>    

            </div>
        </div>
        </div>
    </section>

   <br><br><br>
<?php
if(file_exists('templates/footer.php')) include('templates/footer.php');
ob_end_flush();
?>