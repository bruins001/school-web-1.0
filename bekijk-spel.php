<?php
require "beheerder/models/models.php";

// Creates database instance and does a login.
$database = new Database();
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
            // Gets most properties from the database table games.
            $dbResult = $database->select("games", ["gameName", "price", "numberOfPlayers", "type", "ageRating", "gameLength", "fileId"], ["id" => $_GET["gameId"]]);

            // Gets row from the database object.
            $row = $dbResult->fetch_assoc();

            // Creates the html code.
            $fileName = $database->select("files", ["filePath"], ["id" => $row["fileId"]])->fetch_assoc()["filePath"];
            echo '<div id="photo"><img src="assets/img/' . $fileName . '" alt="' . $row["gameName"] . '"></div><a href="index.php"><img src="assets/img/back.png" alt="back" style="max-width: 2rem; max-height: 2rem; justify-self: start"><a><div id="gameDetails"><h3>Spelnaam: '.$row["gameName"].'</h3><h3>Prijs: '.$row["price"].'</h3><br><h3> Aanbevolen leeftijd: '.$row["ageRating"].'</h3><h3>Aanbevolen spelers: '.$row["numberOfPlayers"].'</h3><br><h3>Soort spel: '.$row["type"].'</h3><h3>Lengte in minuten: '.$row["gameLength"].'</h3></div>';
            ?>
            <h1>Beoordelingen</h1>
            <form action="beoordeling-toevoegen.php?gameId=<?php echo $_GET["gameId"]; ?>" method="POST" enctype="multipart/form-data">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name">
                <br>
                <label for="text">Tekst:</label>
                <textarea name="text" id="text" cols="30" rows="10"></textarea>
                <br>
                <label for="grade">Cijfer:</label>
                <input type="number" id="grade" name="grade" maxlength="10">
                <br>
                <input type="submit" value="verzenden">
            </form>
            <?php
            // Gets reviews.
            $dbResult = $database->select("reviews", ["name", "text", "grade"], []);

            for ($row = $dbResult->fetch_assoc(); $row != null; $row = $dbResult->fetch_assoc()) {
                echo "<p style=\"max-width: 100%; word-break: break-all;\"><b>Naam:</b> " . $row["name"] . ".<br> <b>Tekst:</b> " . $row["text"] . ".<br> <b>Cijfer:</b> " . $row["grade"] . "</p><br>";
            }

            ?>
        </div>
    </main>
</body>
</html>
