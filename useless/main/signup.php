<?php
include "db.php";
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $sql = 'select username from users where username=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if (!$found) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
        $sql->bind_param("ss", $username, $password);
        $sql->execute();
        header("location: login.php");
    } else {
        echo "This username already exists.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../home/style.css">
</head>

<body>
    <div class="container">
        <h1>Sign Up</h1>
        <strong>Enter a username of your choice (as long as there is no existing username) and a password (Get ready to no longer be bored).</strong>
        <br>
        <form action="signup.php" method="POST">
            <input type="text" class="signuptwo" name="username">
            <input type="password" class="signuptwo" name="password">
            <input type="submit" class="signuptwo" name="register" value="Begone Boredom">
        </form>
        <br>
        <a href="login.php">Already part of the cult? Login here</a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <img class="h" src="../images/boredom (1).png" style="position: absolute; bottom: 10%; margin-bottom: 5px;">
    </div>
</body>

</html>