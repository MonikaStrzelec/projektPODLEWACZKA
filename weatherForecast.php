<?php
session_start();
if(!isset($_SESSION['logged'])){
	if(file_exists('templates/header.php')) include('templates/header.php');
} else {
	if($_SESSION['userRank'] == 1){
		if(file_exists('templates/headerForAdmin.php')) include('templates/headerForAdmin.php');
	} else{
		if(file_exists('templates/headerForUsers.php')) include('templates/headerForUsers.php');
	}
}

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://community-open-weather-map.p.rapidapi.com/find?q=lodz&cnt=15&mode=null&lon=0&type=link%2C%20accurate&lat=0&units=metric&lang=pl',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
			"x-rapidapi-key: f63e430983msh02ccfee40012d8ap19b6f4jsne4035dc38ea5"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		echo "cURL Error #:" . $err;
	}
	$oldData = json_decode($response);
	$data = $oldData ->list[0];
	$currentTime = time();





?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full"
        style="background-image: url('https://www.bracia.net.pl/wp-content/uploads/2018/10/zielone-tlo-196325.jpg')">
        <div class="text-center my-5">
            <!-- LOGO!!! pod adresem-->
			<svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16" alt="tutaj powinien wyświetlić się obrazek">
				<path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
			</svg>
			<h2>Prognoza pogody</h2>
        </div>
    </header>


                        
<br><br>
    <section>
        <div class="container overflow-hidden">
            <div class="row gy-5 ">
		
                <div class="col-md-12 col-lg-6">
				<div class="card">
					<div class="report-container text-center">
					<br><br>
						<h3>Pogoda dla: </h3><h1><?php echo $data->name; ?></h1>
						<div class="time">
							<div><?php echo date("l G:i ", $currentTime); ?></div>
						</div>
						<div class="weather-forecast" >
							<br><br>
							<img
								class="weather-icon" /> <br>Aktualnie temperatura wynosi: <h2><?php echo $data->main->temp; ?>°C </h2><br>
								<!-- <span class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span> -->
						</div>
						<div class="time">
							<div>Wilgotność: <h2><?php echo $data->main->humidity; ?> %</h2></div>
							<div>Wiatr: <h2><?php echo $data->wind->speed; ?> km/h</h2></div>
							<br>
						</div>
					</div>
                	</div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card text-center">
                    <br>
					<img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" width="500" height="500" class="weather-icon" />
						<h2><?php echo ucwords($data->weather[0]->description); ?></h2>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

	<br><br>
</html>


<section>
    <div class="container overflow-hidden">
        <div class="row gy-5">
            <div class="card text-center">
                <div class="card-header">
                        <h5>WPROWADŹ NAZWĘ MIASTA DLA KTÓREGO MA WYŚWIETLIĆ SIĘ POGODA</h5>
                </div>
				<?php
					$max_words = 2;
					$max_length = 15;

					if (!isset($_POST['submit'])){ ?>
						<form action="" method="post"> 
						<div class="card-body">
							<input type="post" style="width: 200px;" name="cityName" maxlength="'.$max_length.'">
							<div class="d-grid">
							<br>
								<input type="submit" name="submit" class="btn btn-success" value="Pokaż pogodę"> 
							</div>
						</div>
						</form>
				<?php 
					} else { //pobrana nazwa miasta
						$curl2 = curl_init();
						$cityName = $_POST['cityName'];    
						//$cityName = ($_POST['cityName']);
						curl_setopt_array($curl2, [
							CURLOPT_URL => 'https://community-open-weather-map.p.rapidapi.com/forecast?q='.$cityName.'&lat=0&units=metric&lang=pl',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_HTTPHEADER => [
								"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
								"x-rapidapi-key: f63e430983msh02ccfee40012d8ap19b6f4jsne4035dc38ea5"
							],
							]);

						$response = curl_exec($curl2);
						$oldData = json_decode($response);
						$data = $oldData ->list[0];
						$currentTime = time();
					
				?>
		<div class="container overflow-hidden">
            <div class="row gy-5 ">
                <div class="col-md-12 col-lg-6">
				<div class="card">
					<div class="report-container text-center">
					<br><br>
						<h3>Pogoda dla: </h3><h1><?php echo $oldData->city->name; ?></h1>
						<div class="time">
							<div><?php echo date("l G:i ", $currentTime); ?></div>
						</div>
						<div class="weather-forecast" >
							<br><br>
							<img
								class="weather-icon" /> <br>Aktualnie temperatura wynosi: <h2><?php echo $data->main->temp; ?>°C </h2><br>
								<!-- <span class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span> -->
						</div>
						<div class="time">
							<div>Wilgotność: <h2><?php echo $data->main->humidity; ?> %</h2></div>
							<div>Wiatr: <h2><?php echo $data->wind->speed; ?> km/h</h2></div>
							<br>
						</div>
					</div>
                	</div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card text-center">
                    <br>
					<img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" width="500" height="500" class="weather-icon" />
						<h2><?php echo ucwords($data->weather[0]->description); ?></h2>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

				<?php } ?>
			</div>




<section>
    <div class="container overflow-hidden">
        <div class="row gy-5">
            <div class="card text-center">
                <div class="card-header">
                        <h5>WYŚWIETL POGODĘ GODZINOWĄ</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid">
					<a href="weatherEveryHour.php" class="btn btn-success">Pokaż szczegółową prognozę pogody</a>
                    </div>
                </div>

				</div>
            </div>
        </div>
    </div>
</section>

<?php
    if(file_exists('templates/footer.php')) include('templates/footer.php');
?>