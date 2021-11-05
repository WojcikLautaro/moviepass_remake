<?php

namespace controller;

use model\models\User as MUser;
use model\dao\User as DUser;
use model\dao\Token;

use view\View;

class Account
{
    public static function index(String $token = null)
    {
        return View::render("navbar\\navbar", (Token::validate($token)) ? ["user" =>  Token::getUser($token)] : []);
    }

    public static function logout(String $token = null)
    {
        Token::revoke($token);
    }

    public static function login(String $userdata)
    {
        $decodedUserdata = json_decode($userdata);
        return Token::get($decodedUserdata->email, $decodedUserdata->password);
    }

    public static function edit(String $token, String $userdata)
    {
        if (Token::validate($token)) {
            return DUser::update(MUser::fromJson(json_decode($userdata)));
        }
    }

    public static function register($userdata)
    {
        return DUser::add(MUser::fromJson(json_decode($userdata)));
    }
}
