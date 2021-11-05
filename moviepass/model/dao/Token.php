<?php

namespace model\dao;

use model\dao\Connection;
use model\models\User;

use Exception;

class Token
{
    private static function generate()
    {
        return bin2hex(random_bytes(35));
    }

    public static function validate($token)
    {
        try {
            $response = Connection::getInstance()->execute("call validate_token(:token);", array('token' => $token));
            return (isset($response) && sizeof($response) > 0) ? true : false;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function getUser($token)
    {
        if ($token) {
            $response = Connection::getInstance()->execute("call getUser_token(:token);", array('token' => $token));
            if ((isset($response) && sizeof($response) > 0))
                return User::fromPDO($response[0]);

            return null;
        }
    }

    public static function revoke($token)
    {
        try {
            Connection::getInstance()->execute("call revoke_token(:token);", array('token' => $token));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function get($email, $password)
    {
        try {
            $token = Token::generate();
            $querry = "call set_token(:token, :email, :password);";
            $params = array('token' => $token, 'email' => $email, 'password' => $password);
            $response = Connection::getInstance()->execute($querry, $params);
            if ((isset($response) && sizeof($response) > 0)) {
                return $token;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
