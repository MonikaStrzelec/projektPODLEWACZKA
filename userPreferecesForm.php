<?php
session_start();
if(!isset($_SESSION['logged'])) //w każdej podstronie tylko dla zalogowanych
{
    header('Location: index.php');
    exit();
} 
echo "zalogowany jest:".$_SESSION['logged']." imie: ".$_SESSION['name']." o radze: ".$_SESSION['userRank'];
require_once 'config/connect.php';

$id = $_SESSION['id'];
//$mysqli="SELECT * FROM users WHERE id='$id'";

if(file_exists('templates/headerForUsers.php')) include('templates/headerForUsers.php');

// zdefiniuj zmienne i ustaw puste wartości
$userAreaErr = $hydrationLevelErr = $MaxIrrigationErr = $flexRadioDefaultErr = "";
$userArea = $hydrationLevel = $MaxIrrigation = $flexRadioDefault = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //sprawdzenie czy dane zostały przesłane
    $userArea = walidateTestInput($_POST['userArea']);
    $hydrationLevel = walidateTestInput($_POST['hydrationLevel']);
    $maxIrrigation = walidateTestInput($_POST['maxIrrigation']);
    $flexRadioDefault = walidateTestInput($_POST['flexRadioDefault']);

    require_once 'config/connect.php'; //zmienić strumień gdy zrobię nowy katalog
    $id=$_GET['id']; //ehh... no Why ja się pytam?!


    //raportowanie błędów oparte o wyjątki a nie ostrzeżenia. chroni roota
	mysqli_report(MYSQLI_REPORT_STRICT); 
	try{
		if ($mysqli->connect_errno!=0) {
			throw new Exception(mysqi_connect_errno());
        }
        else{
            // Sprawdzamy czy dane sa usupełnione dla użytkownika
            $result = $mysqli->query("SELECT * FROM usersPreferences WHERE idUser ='$id'");
                if (!$result){
                    echo "Formularz preferencji użytkownika jest nie wypełniony. Wypełnij go byśmy mogli określić twoje preferencje";
                    
                    if($mysqli->query("INSERT INTO usersPreferences VALUES ('$id', '$userArea', '$hydrationLevel', '$maxIrrigation', '$flexRadioDefault')"))
                    {
                        $_SESSION['logged']=true;
                        $usersPreferences = $result->fetch_array(); //tablicja asocacyjna
                        $_SESSION['idUser'] = $usersPreferences['idUser'];
                        $_SESSION['userArea'] = $usersPreferences['userArea'];
                        $_SESSION['hydrationLevel'] = $usersPreferences['hydrationLevel'];
                        $_SESSION['maxIrrigation'] = $usersPreferences['maxIrrigation'];
                        $_SESSION['flexRadioDefault'] = $usersPreferences['flexRadioDefault'];

                        unset($_SESSION['loginError']); //usunięcie z sesji zmienną
                        $result->free_result();
                        header('Location: ../userProfile.php');
                    } else{ 
                        throw new Excpetion($mysqli->error);
                    }
                }
                else{
                    if(isset($_POST['userArea']))
                    {
                        $userArea= $_POST['userArea'];
                        $result = $mysqli->query("UPDATE users SET userArea = '$userArea' WHERE idUser = '$id'");
                    }
                    if(isset($_POST['hydrationLevel']))
                    {
                        $hydrationLevel = $_POST['hydrationLevel'];
                        $result = $mysqli->query("UPDATE users SET hydrationLevel = 'hydrationLevel' WHERE idUser = '$id'");
                    }
                    if(isset($_POST['maxIrrigation']))
                    {
                        $maxIrrigation = $_POST['maxIrrigation'];
                        $result = $mysqli->query("UPDATE users SET maxIrrigation = '$maxIrrigation' WHERE idUser = '$id'");
                    }
                    if(isset($_POST['flexRadioDefault']))
                    {
                        $flexRadioDefault = $_POST['flexRadioDefault'];
                        $result = $mysqli->query("UPDATE users SET flexRadioDefault = '$flexRadioDefault' WHERE idUser = '$id'");
                    }     

                    $_SESSION['logged']=true;
                    //$usersPreferences = $result->fetch_array(); //tablicja asocacyjna
                    $_SESSION['idUser'] = $usersPreferences['idUser'];
                    $_SESSION['userArea'] = $usersPreferences['userArea'];
                    $_SESSION['hydrationLevel'] = $usersPreferences['hydrationLevel'];
                    $_SESSION['maxIrrigation'] = $usersPreferences['maxIrrigation'];
                    $_SESSION['flexRadioDefault'] = $usersPreferences['flexRadioDefault'];

                    unset($_SESSION['loginError']); //usunięcie z sesji zmienną
                    $result->free_result();
                    header('Location: ../userProfile.php');

                }
			$mysqli->close();
        }
	} catch(Exception $error){
		echo '<span style="color:red">Błąd serwera, przepraszamy za niegodoność. Zarejestruj sie puźniej</span>';
	}
}

  //walidacja danych za jednym razem
  function walidateTestInput($input) {
    $input = trim($input); //usuwa spacje, tabulatory itp
    $input = stripslashes($input); //usuwanie ukośników
    $input = htmlspecialchars($input);
    return $input;
  }

?>

    <section>
        <div class="py-3 bg-image-full"
            style="background-image: url('https://img.freepik.com/darmowe-zdjecie/zielona-akwarela-malowane-tekstura-tlo_23-2147836295.jpg?size=626&ext=jpg')">

            <section class="py-3">
                <div class="meMeImage">
                    <!-- my section-->
                    <p style="text-align: center;">
                        <strong>
                            <h4>Moje preferencje:</h4>
                        </strong>
                    </p>
                </div>
            </section>

            <section>
                <div class="container overflow-hidden">

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" autocomplete="off">    
                    <div class="row gy-5">
                        <div class="col-md-12 col-lg-6">
                            <!-- Responsive navbar-->
                            <div class="p-3">
                                <p class="mb-0">
                                <br><br>
                                <h4>Profil nawadniania: </h4>
                                <br>
                                Ile metrów kwadratowych ma Twoja działka? (int max 100 000)
                                <input type="number" name="userArea"/> <!-- strumień wejścia OD UŻYTKOWNIKA DO STRONY
                                        POST bez doklejonych do adresu danych-->
                                    <br/><br/>
                                Jaki poziom nawodnienia chces utrzymać (%)? (int max 100)
                                <input type="number" name="hydrationLevel"/>
                                    <br/><br/>
                                Jaki maksymalnie razy dziennie chcesz podlewac rośliny?
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="maxIrrigation" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        1
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="maxIrrigation" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        1-3
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="maxIrrigation" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        >5
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="maxIrrigation" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        wszystko jedno
                                    </label>
                                    </div>

                                    <br/>
                                Kiedy chcesz by odbywało się podlewanie?
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        rano
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        wieczorem
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        w nocy
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        obojętne
                                    </label>
                                    </div>
                                    <br/>
                                <input type="submit" class="btn btn-success" value="Zapisz dane"/>
                                </form>
                                </p>
                            </div>
                        </div>
                    
                        <div class="col-md-12 col-lg-6">
                            <img src="https://duze-podroze.pl/wp-content/uploads/2017/02/ogrod-botaniczny-amsterdam.jpg"
                                class="card-img-top" alt="tutaj powinien wyświetlić się obraz">
                        </div>
                    </form>    
                    </div>
                </form> 
                </div>
            </section>
        </div>
    </section>
</div>

<?php
if(file_exists('templates/footer.php')) include('templates/footer.php');
ob_end_flush();
?>