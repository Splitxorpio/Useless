<?php
$userof = $_GET['id'];
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
    <div class="container">
        <div class="div" style="text-align: center;">
            <img style="border-radius: 125px; height: 100px; width: 100px; border: 2px solid gray;" src="https://i.redd.it/iykmfftq77h31.jpg" alt="logo">
            <br>
            <h2><?php echo $userof ?></h2>
            <br>
            <a href="dm.php?id=<?php echo $userof ?>">Dm Me!</a>
        </div>
    </div>
</body>

</html>