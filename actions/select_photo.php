<?php
session_start();

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technical</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="main">
    <h1>Select avatar</h1>

    <div class="profile2">
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/man1.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="man1.jpg">
            <input type="submit" value="Select">
        </form>
        </div>
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/man2.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="man2.jpg">
            <input type="submit" value="Select">
        </form>
        </div>
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/man3.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="man3.jpg">
            <input type="submit" value="Select">
        </form>
        </div>
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/woman1.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="woman1.jpg">
            <input type="submit" value="Select">
        </form>
        </div>
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/woman2.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="woman2.jpg">
            <input type="submit" value="Select">
        </form>
        </div>
        <div class="card">
        <form action="Check.php" method="post">
            <div class="gallery2">
                <div class="ramka"><img src="../img/woman3.jpg" alt="Photo"></div>
            </div>
            <input type="hidden" name="photo" value="woman3.jpg">
            <input type="submit" value="Select">
        </form>
        </div>

    </div>








</body>
</html>
