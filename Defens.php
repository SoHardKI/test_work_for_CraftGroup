<?php
require_once 'db/dp.php';

class Defens
{
    public $buf_array;

        public static function Check_login($login,$password)
        {
            $answer =  $GLOBALS["connect"]->query("SELECT * FROM `user` WHERE email='$login'");
            $answer = $answer->fetch(PDO::FETCH_ASSOC);
            if($answer == false )
                return "Нет такого email";
            else
            {
                if($password != $answer['key'])
                {
                    return "Неверный пароль";
                }
                else {
                    return "успех";
                }
            }
        }
        public static function Check_email($email)
        {
            $answer =  $GLOBALS["connect"]->query("SELECT * FROM `user` WHERE email='$email'");
            $answer = $answer->fetch(PDO::FETCH_ASSOC);
            if($answer == true)
            {
                return true;
            } else {
                return false;
            }
        }

}
?>