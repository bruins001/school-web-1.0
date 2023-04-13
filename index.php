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
        <div id="filter-list">
            <h2>Filters</h2>
            <input type="checkbox" id="quickGames">
            <label for="">Snelle spellen</label>
        </div>
        <div id="game-list">
            <?php
                // Gets some properties from game table.
                $games = $database->select("games", ["id", "gameName", "price", "fileId"], []);

                // Creates html code per board game.
                for ($row = $games->fetch_assoc(); $row != null; $row = $games->fetch_assoc()) {    
                    $fileName = $database->select("files", ["filePath"], ["id" => $row["fileId"]])->fetch_assoc()["filePath"];

                    echo '<a href="bekijk-spel.php?gameId=' . $row["id"] . '"><div class="game"><img class="game-img" src="assets/img/' . $fileName . '" alt="' . $row["gameName"] . '"><h3>' . $row["gameName"] . '</h3><h3>€ ' . $row["price"] . '</h3></div></a>';
                }
            ?>
        </div>
    </main>
</body>
</html>