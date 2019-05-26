<?php


class user
{
 public $name;
 public $email;
 public $photo;
 public $key;
 public $token = '';

 public function __construct($name,$email,$photo,$key)
 {
     $this->name = $name;
     $this->email = $email;
     $this->photo = $photo;
     $this->key = $key;


 }

     public static function sortByName ($arr){
        $index = array();
        foreach($arr as $a)
        {
            $index[] = $a['name'];
        }

        array_multisort($index, $arr);
        return $arr;
    }
    public static function sortByEmail ($arr){
        $index = array();
        foreach($arr as $a)
        {
            $index[] = $a['email'];
        }

        array_multisort($index, $arr);
        return $arr;
    }


}