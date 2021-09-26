<!-- ARCHIVED< TO BE USED FOR FUTURE USE POSSIBLY -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The World's Most Useless App</title>
    <link rel="stylesheet" href="style.css" id="setStyle">
</head>

<body id="setStyle">
    <h1>Settings</h1>
    <form action="" method="post">
        <p>Dark Mode</p>
        <input type="radio" name="darkmode" value="dm1">Yes</input>
        <input type="radio" name="darkmode" value="dm2">No</input>
        <input type="submit" name="submit" value="Submit Changes"/>
    </form>
    
    <?php
    if (isset($_POST['submit']))
    {
        
        if(isset($_POST['radio']))
        {
            echo '<p>'.$_POST['radio'].'</p>';
            if ($_POST['radio'] == 'Yes')
            {
                echo '<script>document.getElementbyId(\'setStyle\').setAttribute(\'href\', userdark);</script>';
            }
        }
    }
    
    ?>
    <script>
        function toDarkMode(style)
        {
            document.getElementbyId('setStyle').setAttribute('href', style);
        }
    </script>
    <!-- <div class="centertext">
        <a style="border: 2px solid black;" href="userdash.php" class="signup">Return</a>
    </div> -->
    <form action="userdash.php" method="POST">
        <input type="submit" name="return">
    </form>
</body>

</html>