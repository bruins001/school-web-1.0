<?php
    require "controllers/controllers.php";
    
    session_start();

    // Checks if user exists.
    if (isset($_SESSION["username"])) {
        header("Location: dashboard.php");
    }

    // Checks if there is any input.
    if (!isset($_POST["username"]) && !isset($_POST["password"])) {
        die("U heeft geen gebruikersnaam en wachtwoord ingevuld.");
    }

    // Creates controller and starts authentication.
    $loginController = new LoginController();
    $loginController->auth($_POST["username"], $_POST["password"]);
?>