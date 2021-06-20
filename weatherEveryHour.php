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

$curl2 = curl_init();
if (!isset($_SESSION['cityName'])){
    $city = 'lodz';
}else{
    $city = $_POST['cityName'];    
}
curl_setopt_array($curl2, [
	CURLOPT_URL => 'https://community-open-weather-map.p.rapidapi.com/forecast?q='.$city.'&lat=0&units=metric&lang=pl',
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
//echo $response;
$err = curl_error($curl2);
curl_close($curl2);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data2 = json_decode($response); }
	//$data2 = $Data ->list[];
	// $data2 = $Data ->list[1];
// 	$cont = $Data -> cnd;
// 	echo $cont;
// 	$currentTime = time();
// 	echo '<br>';
// 	echo 'temp min '.$data2->main->temp_min;
// 	echo '<br>';
// 	echo 'temp max '.$data2->main->temp_max;
// 	echo '<br>';
// 	echo 'wiatr '.$data2->main->humidity;
// 	echo '<br>';
// 	echo 'część dnia '.$data2->sys->pod;
// 	echo '<br>';
// 	echo 'prognozowany czas '.$data2->dt_txt;
// }
?>

<section>
<link rel="stylesheet" type="text/css" href="watherCSS.css">
  <body>
  <div class="container">
  <?php if($data2 !== null){ ?>
          <h4>Prognoza pogody dla: <?php echo $data2->city->name?>, <?php echo $data2->city->country?>:</h4>
          <div>
              <table>
                  <thead>
                      <tr>
                          <th>Data i godzina</th>
                          <th>Temperatura</th>
                          <th>Wilgotność</th>
                          <th>Ciśnienie</th>
                          <th>Pogoda</th>
                          <th>Opis</th>
                      </tr>
                  </thead>
                  <tbody>
                        <?php for ($i = 0; $i < $data2->cnt; $i++){ ?>
                          <tr>
                              <td><?php echo $data2->list[$i]->dt_txt?></td>
                              <td><?php echo $data2->list[$i]->main->temp?>&#176</td>
                              <td><?php echo $data2->list[$i]->main->humidity?>%</td>
                              <td><?php echo $data2->list[$i]->main->pressure?> atm</td>
                              <td><?php echo $data2->list[$i]->weather[0]->main?></td>
                              <td><?php echo $data2->list[$i]->weather[0]->description?></td>
                          </tr>
						<?php 
							} 
						?>
                  </tbody>
              </table>
          </div>
		  <?php } ?>
		  </body>
		  </div>
	</section>
<?php
    if(file_exists('templates/footer.php')) include('templates/footer.php');
?>