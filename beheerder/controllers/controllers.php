<?php
class LoginController {
    private $database;

    function __construct($dbUsername, $dbPassword) {
        require("models/models.php");

        // Checks if session is already started and starts it if necessary.
        if (session_status() == 1) {
            session_start();
        }

        // Creates a database class based in the Model.
        $this->database = new Database($dbUsername, $dbPassword);
    }

    function auth(string $username, string $password) {
        // Gets username and password from the database.
        $dbUsernameAndPassword = $this->database->select("admins", ["username", "password"], ["id" => 1])->fetch_assoc();
        $dbAdminUsername = $dbUsernameAndPassword["username"];
        $dbAdminPassword = $dbUsernameAndPassword["password"];

        // Checks if username and password is valid and responds accordingly.
        if ($username == $dbAdminUsername && $password == $dbAdminPassword) {
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

        // Checks if session is already started and starts it if necessary.
        if (session_status() == 1) {
            session_start();
        }

        // Creates a database class based in the Model.
        $this->database = new Database($dbUsername, $dbPassword);
    }

    function save($game, $price, $numberOfPlayers, $type, $age, $length, $photo) {
        // Gets all the necessary file property's.
        $filename = $photo["name"];
        $relativePath = "\..\assets\img\\" . $filename;
        $uploadPath = getcwd() . $relativePath;
        $fileTmpName  = $photo['tmp_name'];

        // Saves the file
        move_uploaded_file($fileTmpName, $uploadPath);

        $this->database->insert("files", ["filePath", "deleted"], ["'" . $filename . "'", 0]); // Adds the file location to the database.
        $fileId = $this->database->select("files", ["id"], ["filePath" => "'" . $filename . "'"]); // Gets the fileId from the row just added.

        // Checks if the fileId exists.
        if ($fileId != null) {
            // Gets the fileId from the database object returned.
            $fileId = $fileId->fetch_assoc()["id"];

            // Adds the board game to the database.
            $this->database->insert("games", ["gameName", "gameLength", "ageRating", "type", "numberOfPlayers", "fileId", "price", "deleted"], ["'" . $game . "'", $length, $age, "'" . $type . "'", $numberOfPlayers, $fileId, "'" . $price . "'", 0]);
        }
    }

    function edit($id, $game, $price, $numberOfPlayers, $type, $age, $length) {
        // Returns response database update.
        return $this->database->update("games", $id, ["gameName" => "gameName = '" . $game . "'", "gameLength" => "gameLength =" . $length, "ageRating" => "ageRating =" . $age, "type" => "type = '" . $type . "'", "numberOfPlayers" => "numberOfPlayers =" . $numberOfPlayers, "price" => "price = '" . $price . "'"]);
    }

    function delete($id) {
        // Gets response database update.
        $dbResult = $this->database->delete("games", $id);

        // Looks if operation was successful.
        if ($dbResult) {
            header("Location: dashboard.php");
        } else {
            die("Het verwijderen van dit spel is niet gelukt.");
        }
    }
}
?>
