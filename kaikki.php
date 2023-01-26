<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="kige_style.css">
<h1>Kaikki leffat </h1>
<img src='video.jpg' alt='' style="width: 500px; height: auto"/>
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

echo "<br>";
echo "<br>";
echo "<br>";

try {
	$yhteys = new PDO($dsn, $user, $pass, $options);
	if (!$yhteys) { die(); }
    $kys = "select * from elokuva order by vid asc";
    $lause = $yhteys->prepare($kys);
    $lause->execute();

        //tulostus while-lauseessa
        echo "<table style='width:80%'>\n";
        echo '<tr style="text-align:left"><th>Nimi</th><th>Ohjaaja</>';
        echo "<th>Genre</th><th>Vuosi</th>";
        echo "<th>Miespääosa</th><th>Naispääosa</th></tr>\n";
        while ($tulos = $lause->fetchObject() ) {
            echo "<tr><td>";
            echo $tulos->nimi;
            echo "</td><td>";
            echo $tulos->ohjaaja;
            echo "</td><td>";
            echo $tulos->genre;
            echo "</td><td>";
            echo $tulos->vuosi;
            echo "</td><td>";
            echo $tulos->miespaaosa;
            echo "</td><td>";
            echo $tulos->naispaaosa;
            echo "</tr>";
    }
    echo "</table>";
    
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
    
?>

<br>
<input type="submit" value="Paluu" <a href="#" onclick="history.back();"></a>

</body></html>