<?php



?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technical</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main">
    <h1>Welcome</h1>

    <div class="select">
        <form action="input.php" method="get">
            <input type="hidden" name="id" value="log">
            <input type="submit" value="Login">

        </form>
        <h3>or</h3>
        <form action="input.php" method="get">
            <input type="hidden" name="id" value="reg">
            <input type="submit" value="Register">
        </form>


    </div>

</div>

</body>
</html>
