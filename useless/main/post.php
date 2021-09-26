<?php
include "db.php";
session_start();
$user = $_SESSION['username'];
if (isset($_POST['postmessub'])) {
    $post = $_POST['postmes'];
    $date = date("Y-m-d h:i:sa");
    $result = mysqli_query($conn, "INSERT INTO `posting`(`user`, `post`, `date`) VALUES ('$user','$post','$date')");
}
if (isset($_POST['send'])) {
    $user = $_SESSION['username'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $result = mysqli_query($conn, "INSERT INTO `comments`(`user`, `post_id`, `comment`) VALUES ('$user','$post_id','$comment')");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="post.css">

</head>

<body class="container">
    <br>
    <div class="contain" style="border-radius: 25px;">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM posting");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="postdiv">
                <?php
                $id = $row['id'];
                echo "<a href='user.php?id=" . $row['user'] . "'>" . $row['user'] . "</a> (" . $row['date'] . ")<br><hr><br>";
                echo $row['post'] . "<br>";
                ?>
                <hr>
                <br>
                <strong>Comments:</strong>
                <div class="comment-holder">
                    <?php
                    $resulttwo = mysqli_query($conn, "SELECT * FROM comments where post_id = '$id'");
                    if ($resulttwo->num_rows > 0) {
                        while ($rowtwo = mysqli_fetch_assoc($resulttwo)) {
                            echo $rowtwo['user'] . ": " . $rowtwo['comment'] . "<br>";
                        }
                    } else {
                        echo "Nothing is here.. yet.";
                    }
                    ?>
                </div>
                <br>
                <form action="post.php" method="POST">
                    <input style="border-radius: 25px; padding: 5px;" type="text" name="comment" placeholder="comment">
                    <input type="hidden" value="<?php echo $id ?>" name="post_id">
                    <input style="border-radius: 25px; padding: 5px;" type="submit" value="Send" name="send">
                </form>
            </div>
        <?php
            echo "<br>";
        }
        ?>
    </div>
    <br>
    <?php echo "Logged in as " . $user; ?>
    <br>
    <br>
    <form action="post.php" method="POST">
        <input class="signup" type="text" name="postmes" placeholder="Type out your post here!">
        <input class="signup" type="submit" name="postmessub">
    </form>
    <br>
    <form action="userdash.php" method="POST">
        <input class="signup" type="submit" value="Return" name="return">
    </form>
</body>

</html>