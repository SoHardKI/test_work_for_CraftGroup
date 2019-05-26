<?php
session_start();
require_once 'db/dp.php';
if(isset($_SESSION['enter']))
{
    if(isset($_SESSION['sorted']))
    {
        $users = $_SESSION['array'];
        unset($_SESSION['array']);
        unset($_SESSION['sorted']);
    } else
    {
        $users = $connect->query("SELECT * FROM `user`");
        $users = $users->fetchAll(PDO::FETCH_ASSOC);
    }
    $_SESSION['array'] = $users;

}else
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}


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
    <h1>List of users</h1>
    <li><a href="index.php">Главная</a></li>
    <div class="profile">
        <?php
        $email=$_SESSION['currentUser'];
        $user = $connect->query("SELECT * FROM `user` WHERE email='$email'");
        $user = $user->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="label"><?php echo "Your secret key = " .  $user['token'] ." "?></div>
        <hr>
        <form action="actions/Check.php" method="post">
            <input type="submit" name="Sort_by_name" value="Sort_by_name">
        </form>
        <form action="actions/Check.php" method="post">
            <input type="submit" name="Sort_by_email" value="Sort_by_email">
        </form>

    </div>
    <?php foreach ($users as $user) { ?>
    <div class="profile">
        <div class="gallery2">
            <div class="ramka"><img src="img/<?php echo $user['photo']?>" alt="Photo"></div>
        </div>
        <div class="info">
            <div class="label"><?php echo "ID: " .  $user['id'] ." "?></div>
            <div class="label"><?php echo "Name: ". $user['name'] ." "?></div>
            <div class="label"><?php echo "Email: ". $user['email'] ." "?></div>
        </div>



    </div>
        <hr>
    <?php }    ?>

</div>

</body>
</html>