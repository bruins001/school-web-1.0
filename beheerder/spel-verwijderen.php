<?php
// Gets controller.
require("controllers/controllers.php");

// Creates controller and invokes delete function.
$gameController = new GamesController();
$gameController->delete($_GET["gameId"]);
?>