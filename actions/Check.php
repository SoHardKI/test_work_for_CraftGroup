<?php
require_once '../user.php';
session_start();
require_once '../Defens.php';



  if(isset($_POST['Login']))
    {
        if(!$_POST['g-recaptcha-response'])
        {
            $_SESSION['answer'] = "Заполните капчу";

            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            $answer = Defens::Check_login($_POST['Email'],$_POST['Password']);
            switch ($answer)
            {
                case "Нет такого email":
                    $_SESSION['answer'] = "Неверный email";

                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    break;
                case "Неверный пароль":
                    $_SESSION['answer'] = "Неверный пароль";

                    header("Location: {$_SERVER['HTTP_REFERER']}");

                    break;
                case "успех":
                    $_SESSION['currentUser']=$_POST['Email'];
                    $_SESSION['enter'] = true;
                    header("Location: ../main.php");
            }
        }
              //Отправка на сервер гугл (не является возожным)
//            $url =  'https://www.google.com/recaptcha/api/siteverify';
//            $key = '6LdgYp8UAAAAACLnjiLYKvW65jTQZjNjVV_aQEe2';
//            $query = $url . '?secret=' . $key . '&response'.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
//            var_dump($query);
//            $data = file_get_contents($query);
//
//            $_SESSION['answer'] = $data;
//
//            header("Location: {$_SERVER['HTTP_REFERER']}");

    }

    if(isset($_POST['Register']))
    {
        if(!$_POST['g-recaptcha-response'])
        {
            $_SESSION['answer'] = "Заполните капчу";

            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            if($_POST['Password'] != $_POST['conf_Password'])
            {
                $_SESSION['answer'] = "Пароли не совпадают";

                header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                $answer = Defens::Check_email($_POST['Email']);
                if($answer == false) //нет такого email в базе данных
                {
                    // вставим одну строку
                    $name = $_POST['Name'];
                    $email = $_POST['Email'];
                    $_SESSION['currentUser']=$email;
                    $photo = "";
                    $key = $_POST['Password'];
                    $token = md5(date("DMjG:i:sTY"));
                    $new_user = new user($_POST['Name'],$_POST['Email'],"",$key = $_POST['Password']);
                    $new_user->token=$token;
                    $_SESSION['new_user'] = $new_user;
                    $_SESSION['enter'] = true;
                    header("Location: select_photo.php");

                } else {
                    $_SESSION['answer'] = "Такой email уже зарегистрирован";

                    header("Location: {$_SERVER['HTTP_REFERER']}");
                }
            }
        }




    }
    if(isset($_POST['photo']))
    {
        if(isset($_SESSION['new_user']))
        {
            $stmt = $connect->prepare("INSERT INTO `user` (`name`, email,photo,`key`,token) VALUES (:name, :email ,:photo ,:key,:token)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':key', $key);
            $stmt->bindParam(':token',$token);

            $name = $_SESSION['new_user']->name;
            $email = $_SESSION['new_user']->email;
            $photo = $_POST['photo'];
            $key = $_SESSION['new_user']->key;
            $token = $_SESSION['new_user']->token;

            $stmt->execute();
            unset($_SESSION['new_user']);
            header("Location: ../main.php");
        }

    }
          if(isset($_POST['Sort_by_name']))
            {
                if(isset($_SESSION['array']))
                {
                    $buf_array = user::sortByName($_SESSION['array']);
                    $_SESSION['array'] = $buf_array;
                    $_SESSION['sorted'] = true;
                }
                header("Location: ../main.php");
            }

            if(isset($_POST['Sort_by_email']))
            {
                if(isset($_SESSION['array']))
                {
                    $buf_array = user::sortByEmail($_SESSION['array']);
                    $_SESSION['array'] = $buf_array;
                    $_SESSION['sorted'] = true;
                }
                header("Location: ../main.php");
            }


?>
