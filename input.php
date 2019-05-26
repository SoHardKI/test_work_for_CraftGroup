<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technical</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<?php
if(isset($_GET['id']))
{

    switch ($_GET['id'])
    {
        case "log":
            require_once 'forms/Login.php';
            break;
        case "reg":
            require_once 'forms/Register.php';
            break;
    }

}
else {
    header("Location: index.php");
}

?>

</body>
</html>


