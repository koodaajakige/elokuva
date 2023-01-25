<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="kige_style.css">
<h1>Löydetyt leffat </h1>
<img src='video.jpg' alt='' style="width: 450px; height: auto"/>
</head>
<body>

<?php
$dsn = "pgsql:host=localhost;dbname=knykanen";
$user = "db_knykanen";
$pass = getenv("DB_PASSWORD");
$options = [
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false, 
];

//hae data lomakkeelta
$haku = $_POST['elonimi'];
$haku = "%" . $haku . "%";
echo "<br>";

try {
	$yhteys = new PDO($dsn, $user, $pass, $options);
	if (!$yhteys) { die(); }
    $kys = "select * from elokuva where nimi like '$haku%' order by vid asc";
    $lause = $yhteys->prepare($kys);
    $lause->execute();

    while ($tulos = $lause->fetchObject() ) {
        echo "<div class='nimihaku'>"; 
        echo "<br>";
        echo "<div>$tulos->nimi</div>";
        echo "<div>$tulos->ohjaaja</div>";
        echo "<div>$tulos->genre</div>";
        echo "<div>$tulos->vuosi</div>";
        echo "<div>$tulos->miespaaosa</div>";
        echo "<div>$tulos->naispaaosa</div>";	
	}
 	
}catch (PDOException $e){
	echo $e->getMessage();
	die();
}

?>

<br>
<input type="submit" value="Paluu" <a href="#" onclick="history.back();"></a>

</body></html>