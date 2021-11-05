<?php

namespace Controllers;

use Config\Router;
use Views\View;
use Exception;

class ViewController
{
    public static function Navbar()
    {
        $apimovies = new View("apimovies");
        $apimovies->currPage = ($page <= 0) ? 1 : $page;
        $apimovies->genreW = (!is_array($genreW)) ? [] : $genreW;
        $apimovies->genreWO = (!is_array($genreWO)) ? [] : $genreWO;
        $apimovies->name = $name;
        $apimovies->year = $year;

        try {
          
        } catch (Exception $e) {
            Router::Default('Error processing request');
        }
    }
}
