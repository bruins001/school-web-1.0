<?php
class LoginController {

    function __construct() {
        // require("../objects/user.php");
        if (session_status() == 1) {
            session_start();
        }
    }

    function auth(string $username, string $password) {
        if ($username == "admin" && $password == "admin") {
            // $_SESSION["user"] = new User($username, $password);
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("Location: dashboard.php");
        } else {
            die("Uw ingevulde gebruikersnaam en wachtwoord is incorrect!");
        }
    }
}

class GamesController {
    private $database;

    function __construct($dbUsername, $dbPassword) {
        require("models/models.php");

        if (session_status() == 1) {
            session_start();
        }

        $this->database = new Database($dbUsername, $dbPassword);
    }

    function save($game, $price, $numberOfPlayers, $type, $age, $length, $photo) {
        $uploadDir = getcwd() . "\..\assets\img\\" . $photo["name"];
        $fileTmpName  = $photo['tmp_name'];
        move_uploaded_file($fileTmpName, $uploadDir);

        $this->database->insert("files", ["filePath", "deleted"], ["'" . $uploadDir . "'", 0]);
        $fileId = $this->database->select("files", ["id"], ["filePath" => "'" . $uploadDir . "'"]);

        if ($fileId != null) {
            $fileId = $fileId->fetch_assoc()["id"];

            $this->database->insert("games", ["gameName", "gameLength", "ageRating", "type", "numberOfPlayers", "fileId", "price", "deleted"], ["'" . $game . "'", $length, $age, "'" . $type . "'", $numberOfPlayers, $fileId, "'" . $price . "'", 0]);
        }
    }
}

?>
