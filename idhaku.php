<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="kige_style.css">
<h1>Id-tunnistettu leffa </h1>
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

$idhaku = $_GET['id'];

try {
	$yh = new PDO($dsn, $user, $pass, $options);
	if (!$yh) { die(); }

   if ($idhaku) {
   $stmt = $yh->prepare("SELECT nimi, ohjaaja, genre, vuosi, miespaaosa, naispaaosa
   FROM elokuva WHERE vid = ?");

   $stmt->execute([$idhaku]);
   $rivi = $stmt->fetch();

   if ($rivi) {
      echo "<div class='idleffat'>"; 
      echo "   <div>Nimi: $rivi[nimi]</div>";
      echo "   <div>Ohjaaja: $rivi[ohjaaja]</div>";
      echo "   <div>Genre: $rivi[genre]</div>";
      echo "   <div>Vuosi: $rivi[vuosi]</div>";
      echo "   <div>Miespääosa: $rivi[miespaaosa]</div>";
      echo "   <div>Naispääosa: $rivi[naispaaosa]</div>";
      
   } else {
   echo "<div class='idleffat'>"; 
   echo "   <div>Tunnistetta vastaavaa elokuvaa ei löytynyt!</div>";
   }
   } else {
   echo "<div class='idleffat'>"; 
   echo "   <div>Haettavan elokuvan tunnistetta ei määritelty!</div>";
   } 

}catch (PDOException $e){
	echo $e->getMessage();
	die();
}
 
?>

<br>
<input type="submit" value="Paluu" <a href="#" onclick="history.back();"></a>

</body></html>


