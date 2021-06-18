<?php
    session_start();
	if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Location: userProfile.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
	<title>Podlewaczka</title>
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
<form class="loginForm" method="POST" action="loginAutorization.php">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('https://www.bracia.net.pl/wp-content/uploads/2018/10/zielone-tlo-196325.jpg')">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-30 p-b-30">

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

				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-55">
						Logowanie
					</span>
					
    <!-- userName -->

					<div class="wrap-input100 validate-input m-b-16"
						data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="userName" placeholder="Nazwa użytkownika">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

    <!-- password -->
					<div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Hasło">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Zapamiętaj
						</label>
					</div>

					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn" type="submit">
							Zaloguj się
						</button>
					</div>


					<div class="text-center w-full p-t-40">
						<span class="txt1">
							Nie masz konta?
						</span>
						<a class="txt1 bo1 hov1" href="registerForm.php">
							Zarejestruj się
						</a>
					</div>
					</form>
				</form>
			</div>
		</div>
	</div>

	<?php
		if(isset($_SESSION['loginError']))
		echo $_SESSION['loginError'];
	?>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>