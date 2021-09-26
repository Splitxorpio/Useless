<?php
// LOGIN
session_start();
include 'db.php';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $resultone = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ? LIMIT 1");
    $resultone->bind_param("ss", $username, $password);
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $resultone->execute();
    $result = $resultone->get_result();
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];
    $iduser = $_SESSION['id'];
}
// RANDOM FACTS API
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://numbersapi.p.rapidapi.com/random/trivia?json=true&fragment=true&max=20&min=10",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: numbersapi.p.rapidapi.com",
        "x-rapidapi-key: 1c74124f6amshe4f133aae307c96p148d3djsn206071992808"
    ],
]);

$response = json_decode(curl_exec($curl), true);
$err = curl_error($curl);

curl_close($curl);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="userdash.css" id="setStyle">
</head>

<body>
    <div class="imgcontainer centertext">
        <img style="border-radius: 125px; height: 100px; width: 100px;" src="https://i.redd.it/iykmfftq77h31.jpg" alt="logo">
    </div>
    <br>
    <p class="centertext">Welcome
        <?php
        if (isset($_POST['register'])) {
            if ($row['username'] == $username && $row['password'] == $password) {
                echo ($username);
            } else { {
                    header('location: login.php');
                }
            }
        }
        if (isset($_POST['return'])) {
            $username = $_SESSION['username'];
            echo ($_SESSION['username']);
        }
        ?>!

    </p>
    </div>
    <br>
    <div class="container">
        <div class="centertext" style="padding: 15px;">
            <a style="border: 2px solid black;" href="../home/index.php" class="signup">Logout</a>
            <!-- <a style="border: 2px solid black;" href="settings.php" class="signup">Settings</a> -->
            <a style="border: 2px solid black;" href="post.php" class="signup">Post!</a>
        </div>
        <br>
        <div class="div">
            <strong>Random Useless Fact:</strong>
            <hr>
            <?php
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo "<strong>" . $response["number"] . ":</strong> " . $response["text"];
            }
            ?>
        </div>
        <br>
        <div class="div">
            <strong>Random Website</strong>
            <hr>
            <?php

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://randomness.p.rapidapi.com/website",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "x-rapidapi-host: randomness.p.rapidapi.com",
                    "x-rapidapi-key: 1c74124f6amshe4f133aae307c96p148d3djsn206071992808"
                ],
            ]);

            $response = json_decode(curl_exec($curl), true);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
            }
            ?>
            <a href="<?php echo $response["website"] ?>"><?php echo $response["website"]; ?></a>
        </div>
        <br>
        <div class="div container">
            <strong>Random Image:</strong>
            <br>
            <img style="border-radius: 15px;" src="https://picsum.photos/200">
        </div>
        <img class="stay" src="../images/homepage.png">
        <br>
        <div class="showdms">
            <strong>Your DMs:</strong>
            <br>
            <?php
                $result = mysqli_query($conn, "SELECT DISTINCT to_user FROM dm WHERE from_user = '$username'");
                while($row = mysqli_fetch_assoc($result)){
                    echo "<a href='dm.php?id=".$row['to_user']."'>".$row['to_user']."</a><br>";
                }
            ?>
        </div>
</body>

</html>