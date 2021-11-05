<?php

namespace controller;

use common\ClosureModel;
use view\View;

use model\dao\api\Genre as AGenre;
use model\dao\api\Movie as AMovie;
use model\dao\Movie as DMovie;
use model\dao\Token;

class Api
{
    public static function index()
    {
        return Api::list();
    }

    public static function list(String $token = null, String $searchParams = "")
    {
        if (!Token::validate($token))
            return "Error Processing Request";

        else {
            $sp = ClosureModel::fromJson(json_decode($searchParams));
            //Search parameter validation
            {
                $sp->searchPage = (int) ($sp->searchPage <= 0) ? 1 : $sp->searchPage;
                $sp->searchGenresIncluded = (!is_array($sp->searchGenresIncluded)) ? [] : $sp->searchGenresIncluded;
                $sp->searchGenresExcluded = (!is_array($sp->searchGenresExcluded)) ? [] : $sp->searchGenresExcluded;
                $sp->searchName = (string) $sp->searchName;
                $sp->searchYear = (string) $sp->searchYear;


                //var_dump($sp);
                //return;
            }

            $searchResults = new ClosureModel();
            //Search result fetching
            {
                $response = null;
                if (empty($sp->toArray()))
                    $response = AMovie::getPage($sp->searchPage);
                else if (isset($sp->name))
                    $response = AMovie::searchByName($sp->searchPage, $sp->searchName);
                else
                    $response = AMovie::searchByDateAndGenre($sp->searchPage, $sp->searchYear, $sp->searchGenresIncluded, $sp->searchGenresExcluded);

                if ($response != null) {
                    $sp->loadedMovies = DMovie::checkLoaded($response->movies);
                    $sp->searchMaxPage = $response->pages;
                    $sp->movies = $response->movies;
                }

                $sp->searchGenres = AGenre::getGenres();

                //This has to be last so i don't jave to check separately each search field
                $sp->searchYear = (isset($sp->searchYear)) ? (string) $sp->searchYear : "0000";
            }

            return View::render("main\\movies\\apimovies", array_merge($sp->toArray(), $searchResults->toArray()));
        }
    }
}
