<?php
class User {
    private $username;
    private $password;

    function __construct(string $username, string $password) {
        echo "USER CLASS WORDT AANGEMAAKT";
        $this->username = $username;
        $this->password = $password;
    }

    function getUsername() {
        return $this->username;
    }
}
?>
