<?php
require "beheerder/models/models.php";

$database = new Database("root", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>games | spellen enzo</title>
</head>
<body>
    <header>
        <h1>Spellen enzo.</h1>
    </header>
    <main>
        <div id="game-list">
            <?php 
            $dbResult = $database->select("games", ["gameName", "price", "numberOfPlayers", "type", "ageRating", "gameLength", "fileId"], ["id" => $_GET["gameId"]]);

            for ($row = $dbResult->fetch_assoc(); $row != null; $row = $dbResult->fetch_assoc()) {
                $fileName = $database->select("files", ["filePath"], ["id" => $row["fileId"]])->fetch_assoc()["filePath"];
                echo '<div id="photo"><img src="assets/img/' . $fileName . '" alt="' . $row["gameName"] . '"></div><a href="index.php"><img src="assets/img/back.png" alt="back" style="max-width: 2rem; max-height: 2rem; justify-self: start"><a><div id="gameDetails"><h3>Spelnaam: '.$row["gameName"].'</h3><h3>Prijs: '.$row["price"].'</h3><br><h3> Aanbevolen leeftijd: '.$row["ageRating"].'</h3><h3>Aanbevolen spelers: '.$row["numberOfPlayers"].'</h3><br><h3>Soort spel: '.$row["type"].'</h3><h3>Lengte in minuten: '.$row["gameLength"].'</h3></div>';
            }
            ?>
        </div>
    </main>
</body>
</html>
