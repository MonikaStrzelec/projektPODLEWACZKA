<?php
    session_start();
	if(isset($_POST['email'])) //może być jakakolwiek zmienna
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$userName=$_POST['userName'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];

		$goodWalidation=true;
		 //Imię od 3 do 20 znaków
		if((strlen($name)<3) || (strlen($name)>20)){
			$goodWalidation=false;
			$_SESSION['error_name']="Imię musi posiadać od 3 do 20 znaków";
		}

		 //sanityzacja email
		$emailSafe=filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false) || ($emailSafe!=$email)){
			$goodWalidation=false;
			$_SESSION['error_email']="Podaj poprawny adres e-mail";			
		}

		 //Nick od 3 do 25 znaków
		if((strlen($userName)<3) || (strlen($userName)>25)){
			$goodWalidation=false;
			$_SESSION['error_userName']="Nick musi posiadać od 3 do 25 znaków";
		}
		if(ctype_alnum($userName)==false){
			$goodWalidation=false;
			$_SESSION['error_userName']="Nick mmoże składac się tylko z liter i cyfr(bez polskich znaków)";
		}

		 //poprawność hasła. od 6 do 20 znaków
		if((strlen($password)<6) || (strlen($password)>20)){
			$goodWalidation=false;
			$_SESSION['error_password']="Hasło musi posiadać od 6 do 20 znaków";
		}
		if($password!=$password2){
			$goodWalidation=false;
			$_SESSION['error_password']="Hasła nie są identyczne!";
		}
		$passwordHash = password_hash($password, PASSWORD_DEFAULT); //255ZNAKÓW NA HASŁO w bazie przez hash!!

		if(!isset($_POST['acceptRegulations'])){ //akceptacja regulaminu
			$goodWalidation=false;
			$_SESSION['error_acceptRegulations']="Zaakceptuj regulamin";
		}
		
		//Bot or not
		$secretKey = "6LfoExobAAAAAB1mJJCO_UWvd-hUfblQ80BIvtPb";
		$checkKey = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey
		.'&response='.$_POST['g-recaptcha-response']);
		$replyRecaptcha = json_decode($checkKey);
		if($replyRecaptcha->success==false){
			$goodWalidation=false;
			$_SESSION['error_bot']="Potwierdź, że nie jesteś botem";
		}

		require_once '../config/connect.php';
		//raportowanie błędów oparte o wyjątki a nie ostrzeżenia. chroni roota
		mysqli_report(MYSQLI_REPORT_STRICT); 
		try{
			if ($mysqli->connect_errno!=0) {
				throw new Exception(mysqi_connect_errno());
			} else{
				// Sprawdzamy czy użytkownik z takim emailem już nie istnieje
				$result = $mysqli->query("SELECT id FROM users WHERE email ='$email'");
				if (!$result){
					throw new Excpetion($mysqli->error);}
				$isEmailExists = $result->num_rows;

				if($isEmailExists>0){
					$goodWalidation=false;
					$_SESSION['error_email']="Taki e-mail juz istnieje";
				}

				// Sprawdzamy czy nick istnieje
				$result = $mysqli->query("SELECT id FROM users WHERE userName='$userName'");
				if (!$result) {
					throw new Excpetion($mysqli->error);}
				$isUserNameExists = $result->num_rows;
				if($isUserNameExists>0){
					$goodWalidation=false;
					$_SESSION['error_UserName']="Nazwa użytkownika jest już zajęta!";
				}

				if($goodWalidation==true){//poprawne dane
					if($mysqli->query("INSERT INTO users VALUES (NULL, '$name', '$email', '$userName', '$$passwordHash', 0 , now())"))
					{
						$_SESSION['logged']=true;
						$user = $result->fetch_array(); //tablicja asocacyjna
						$_SESSION['id'] = $user['id'];
						$_SESSION['name'] = $user['name'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['userName'] = $user['userName'];
						$_SESSION['userRank'] = $user['userRank'];
						$_SESSION['dataRegister'] = $user['dataRegister'];

						unset($_SESSION['loginError']); //usunięcie z sesji zmienną
						$result->free_result();
						header('Location: ../userProfile.php');
					} else{ 
						throw new Excpetion($mysqli->error);
					}
				}
				$mysqli->close();
			}
		} catch(Exception $error){
			echo '<span style="color:red">Błąd serwera, przepraszamy za niegodoność. Zarejestruj sie puźniej</span>';
		}
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Podlewaczka</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" autocomplete="off">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('https://www.bracia.net.pl/wp-content/uploads/2018/10/zielone-tlo-196325.jpg')">
			<div class="login100-more"
				style="background-image: url('https://www.bracia.net.pl/wp-content/uploads/2018/10/zielone-tlo-196325.jpg');">
			</div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-30 p-b-30">
				<form class="login100-form validate-form">
					<!-- Linijka klasy odpowoiedzialna za walidację -->

					<div class="wrap-login100 p-b-10">
						<a class="txt1" href="../index.php">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
							class="bi bi-x-square" viewBox="0 0 16 16">
							<path
								d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
							<path
								d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
						</svg>
						</a>
					</div>

					<span class="login100-form-title p-b-59">
						Rejestracja
					</span>
				
					<div class="wrap-input100">
						<span class="label-input100">Imię:</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Pole: imię jest wymagane">
						<input class="input100" type="text" name="name" placeholder="podaj imię" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
								class="bi bi-person" viewBox="0 0 16 16">
								<path
									d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
							</svg>
						</span>
					</div>
					<?php
						if (isset($_SESSION['error_name'])){
							echo '<div class="error" style="color:red">'.$_SESSION['error_name'].'</div>';
							unset($_SESSION['error_name']);
						}
					?>


					<div class="wrap-input100">
						<span class="label-input100">Email</span>
					</div>
					<div class="wrap-input100 validate-input m-b-16"
						data-validate="Adres e-mail jest wymagany">
						<input class="input100" type="text" name="email" placeholder="adres e-mail">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>
					<?php
						if (isset($_SESSION['error_email'])){
							echo '<div class="error" style="color:red">'.$_SESSION['error_email'].'</div>';
							unset($_SESSION['error_email']);
						}
					?>

					<div class="wrap-input100">
						<span class="label-input100">Nazwa użytkownika</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Musisz podać nazwę użytkownika">
						<input class="input100" type="text" name="userName" placeholder="podaj nazwię użytkownika">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
								class="bi bi-person" viewBox="0 0 16 16">
								<path
									d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
							</svg>
						</span>
					</div>
					<?php
						if (isset($_SESSION['error_userName'])){
							echo '<div class="error">'.$_SESSION['error_userName'].'</div>';
							unset($_SESSION['error_userName']);
						}
					?>


					<div class="wrap-input100">
						<span class="label-input100">Hasło</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Musisz podać hasło">
						<input class="input100" type="text" name="password" placeholder="*************">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>
					<?php
						if (isset($_SESSION['error_password'])){
							echo '<div class="error">'.$_SESSION['error_password'].'</div>';
							unset($_SESSION['error_password']);
						}
					?>


					<div class="wrap-input100">
						<span class="label-input100">Powtóż hasło</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Musisz podać identyczne hasło jak wyżej">
						<input class="input100" type="text" name="password2" placeholder="*************">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>


					<div class="text-center p-t-40">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="acceptRegulations">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Zhadzam się z
									<a href="#" class="txt2 hov1">
										Warunki użytkowania PODLEWACZKA
									</a>
								</span>
							</label>
						</div>
					</div>
					<?php
						if (isset($_SESSION['error_acceptRegulations'])){
							echo '<div class="error">'.$_SESSION['error_acceptRegulations'].'</div>';
							unset($_SESSION['error_acceptRegulations']);
						}
					?>

					<div class="g-recaptcha" data-sitekey="6LfoExobAAAAACQupftbrJqsH128VzpSyWl8w4VY"></div>
					
					<?php
						if (isset($_SESSION['error_bot'])){
							echo '<div class="error">'.$_SESSION['error_bot'].'</div>';
							unset($_SESSION['error_bot']);
						}
					?>

					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn" type="submit">
							Zarejestruj się
						</button>
					</div>
				

					<div class="text-center w-full p-t-40">
						<span class="txt1">
							Masz już konto?
						</span>
						<a class="txt1 bo1 hov1" href="loginForm.php">
							Zaloguj się
						</a>
					</div>
				</form>	
				</form>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>