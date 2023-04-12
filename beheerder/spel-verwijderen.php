<?php
// Gets controller.
require("controllers/controllers.php");

// Creates controller and invokes delete function.
$gameController = new GamesController("root", "");
$gameController->delete($_GET["gameId"]);
?>