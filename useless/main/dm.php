<?php
session_start();
$to_user = $_GET['id'];
$from_user = $_SESSION['username'];
include "db.php";
if (isset($_POST['messaged'])) {
    $message = $_POST['message'];
    $resultone = mysqli_query($conn, "INSERT INTO `dm` (`to_user`, `from_user`, `message`) VALUES ('$to_user', '$from_user', '$message')");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="post.css">
</head>

<body>
    <?php echo "Logged in as " . $from_user; ?>
    <div class="container">
        <?php
        echo $to_user . "'s DMs<br>";
        ?>
        <a href="post.php">Return to posts</a>
        <br>
        <hr>
        <div class="contain">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM dm WHERE to_user = '$to_user' and from_user = '$from_user' UNION SELECT * FROM dm WHERE to_user = '$from_user' and from_user = '$to_user' ORDER BY id ASC");
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['from_user'] . ": " . $row['message'] . "<br>";
            }
            ?>
        </div>
        <br>
        <form method="POST">
            <input class="signup" type="text" placeholder="message" name="message">
            <input class="signup" type="submit" name="messaged">
        </form>
    </div>

</body>

</html>