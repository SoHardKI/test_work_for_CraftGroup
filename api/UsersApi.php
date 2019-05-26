<?php
require_once 'Api.php';
require_once '../db/dp.php';
require_once '../user.php';

class UsersApi extends Api {

    public $apiName = 'user';
    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/user/format
     * @return string
     */
    public
    function indexAction()
    {
        $users = $GLOBALS["connect"]->query("SELECT id,`name`,email,photo,`key` FROM `user`");
        $users = $users->fetchAll(PDO::FETCH_ASSOC);
        if ($users) {
            return $this->response($users, 200);
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по name)
     * http://ДОМЕН/users?name=name
     * @return string
     */
    public
    function viewAction()
    {
        //name должен быть первым параметром после /users/x
        $name = $this->requestParams['name'];
            if ($name) {
                $users = $GLOBALS["connect"]->query("SELECT id,`name`,email,photo,`key` FROM `user` WHERE name='$name'");
                $users = $users->fetch(PDO::FETCH_ASSOC);
                if ($users) {
                    return $this->response($users, 200);
                }
            }

            return $this->response('Data not found', 404);

    }

    public static function isJson($string) {
    return ((is_string($string) &&
            (is_object(json_decode($string)) ||
            is_array(json_decode($string))))) ? true : false;
}
}



?>