<?php

namespace controller;

use view\View;

class Home
{
    public static function index()
    {
        return View::render("app\\main");
    }

    public static function terms()
    {
        return View::render("main\\terms");
    }

    public static function default(String $token = null)
    {
        return Api::list($token);
    }
}
