<?php
// Checks if method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets controller.
    require("controllers/controllers.php");

    // Creates gameController and invokes the edit function.
    $gameController = new GamesController("root", "");
    $gameController->edit($_POST["id"], $_POST["game"], $_POST["price"], $_POST["numberOfPlayers"], $_POST["type"], $_POST["age"], $_POST["length"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>spel bewerken | Beheerder | spellen enzo</title>
</head>
<body>
    <a href="dashboard.php"><button>Terug</button></a>
    <form action="spel-bewerken.php?gameId=<?php echo $_GET["gameId"] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_GET["gameId"] ?>">
        <label for="game">Spel</label>
        <input type="text" id="game" name="game" required>
        <br>
        <label for="price">Prijs €</label>
        <input type="text" id="price" name="price" required>
        <br>
        <label for="numberOfPlayers">Aantal spelers</label>
        <input type="number" id="numberOfPlayers" name="numberOfPlayers" required>
        <br>
        <label for="type">Type</label>
        <input type="text" id="type" name="type" required>
        <br>
        <label for="age">Leeftijd</label>
        <input type="number" id="age" name="age" required>
        <br>
        <label for="length">Speelduur</label>
        <input type="number" id="length" name="length" required>
        <br>
        <input type="submit" value="verzenden">
    </form>
    <a href="spel-verwijderen.php?gameId=<?php echo $_GET["gameId"] ?>"><button>Spel verwijderen</button></a>
</body>
</html>