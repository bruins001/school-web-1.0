<?php
    require "controllers/controllers.php";

    session_start();

    if (isset($_SESSION["username"])) {
        header("Location: dashboard.php");
    }

    if (!isset($_POST["username"]) && !isset($_POST["password"])) {
        die("U heeft geen gebruikersnaam en wachtwoord ingevuld.");
    }

    $loginController = new LoginController();
    $loginController->auth($_POST["username"], $_POST["password"]);
?>