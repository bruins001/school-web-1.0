<?php
require "models/models.php";

// Creates database instance and does a login.
$database = new Database();

session_start();

// Checks if user is logged in and responds accordingly.
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard | Beheerder | spellen enzo</title>
</head>
<body>
    <header>
        <h1>Beheerder</h1>
        <p><b>Spellen</b></p>
        <p>Beoordelingen</p>
    </header>
    <div id="filter">
        <a href="spel-toevoegen.php"><button>Spel toevoegen</button></a>
        <a href="loguit.php"><button>Uitloggen</button></a>
    </div>
    <div id="game-list">
        <?php
            // Gets some properties from game table.
            $games = $database->select("games", ["id", "gameName", "price", "fileId"], []);

            // Creates html code per board game.
            for ($row = $games->fetch_assoc(); $row != null; $row = $games->fetch_assoc()) {    
                $fileName = $database->select("files", ["filePath"], ["id" => $row["fileId"]])->fetch_assoc()["filePath"];

                echo '<a href="spel-bewerken.php?gameId=' . $row["id"] . '"><div class="game"><img class="game-img" src="../assets/img/' . $fileName . '" alt="' . $row["gameName"] . '"><h3>' . $row["gameName"] . '</h3><h3>€ ' . $row["price"] . '</h3></div></a>';
            }
        ?>
    </div>
</body>
</html>