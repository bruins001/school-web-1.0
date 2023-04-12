<?php
session_start();

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
    </div>
</body>
</html>