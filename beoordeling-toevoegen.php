<?php
require "beheerder/controllers/controllers.php";

$reviewController = new ReviewController();
$reviewController->save($_GET["gameId"], $_POST["name"], $_POST["text"], $_POST["grade"]);
?>