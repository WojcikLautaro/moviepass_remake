<?php

namespace model\models;

use common\ClosureModel;

class User extends ClosureModel
{
    public static function fromJson($obj)
    {
        $user = new User();

        foreach ($obj as $key => $value) {
            $user->$key = $value;
        }

        return $user;
    }

    public static function fromPDO($obj)
    {
        $user = new User();

        foreach ($obj as $key => $value) {
            $user->$key = $value;
        }

        $user->portrait = IMG_PATH . "Portrait_Placeholder.png";

        return $user;
    }

    private static function isThisStringValid(String $string)
    {
        return (trim($string)) ? true : false;
    }

    public static function isThisPasswordValid(String $password)
    {
        return User::isThisStringValid($password);
    }

    public static function isThisUsernameValid(String $password)
    {
        return User::isThisStringValid($password);
    }

    public static function isThisDateValid(String $date)
    {
        $datArr = explode('-', $date);

        if (!checkdate($datArr[1], $datArr[2], $datArr[0]))
            return false;

        return true;
    }

    public static function isThisUserDataValid(User $user)
    {
        if (!User::isThisPasswordValid($user->password))
            return 'bad password';

        if (!User::isThisUsernameValid($user->name))
            return 'bad user name';

        if (!User::isThisDateValid($user->birthday))
            return 'bad date';

        return false;
    }
}
