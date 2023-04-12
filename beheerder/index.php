<?php
session_start();

// Checks if user is logged in and responds accordingly.
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login | Beheerder | spellen enzo</title>
</head>
<body>
    <div>
        <h1>Login</h1>
        <form action="auth.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" value="inloggen">
        </form>
    </div>
</body>
</html>
