<?php

namespace Controllers;

use Model\Models\ClosureModel;

use Model\DAO\Genre;
use Model\DAO\MoviesXFunctions;

use Exception;
use Views\View;

class BillboardController
{
    public function Index()
    {
        return BillboardController::List();
    }

    public static function List(String $searchParams = "")
    {
        $sp = ClosureModel::fromJson(json_decode($searchParams));
        //Search parameter validation
        {
            $sp->searchPage = (int) ($sp->searchPage <= 0) ? 1 : $sp->searchPage;
            $sp->genresIncluded = (!is_array($sp->genresIncluded)) ? [] : $sp->genresIncluded;
            $sp->genresExcluded = (!is_array($sp->genresExcluded)) ? [] : $sp->genresExcluded;
            $sp->movieName = (string) $sp->movieName;
            $sp->movieYear = (string) $sp->movieYear;
        }

        $searchResults = new ClosureModel();
        //Search result fetching
        {
            $billboard->maxPage = MoviesXFunctionsDAO::getMaxPages($billboard->currPage, $name, $year, $billboard->genreW, $billboard->genreWO);
            $billboard->movies = MoviesXFunctionsDAO::getMoviesFromFunctions($billboard->currPage, $name, $year, $billboard->genreW, $billboard->genreWO);
            $billboard->sellingtickets = Session::IsUserThisRole(CLIENT_ROLE_NAME) || Session::IsUserThisRole(ADMIN_ROLE_NAME);
         
            $movHasFreeSeats = [];
            foreach ($billboard->movies as $value)
                $movHasFreeSeats[$value->getId()] = MoviesXFunctionsDAO::checkAviableSeatsForMovie($value->getId());
    
            $billboard->movHasFreeSeats = $movHasFreeSeats;
            
            $response = null;
            if (empty($sp->toArray()))
                $response = AMovie::getPage($sp->searchPage);
            else if (isset($sp->name))
                $response = AMovie::searchByName($sp->searchPage, $sp->movieName);
            else
                $response = AMovie::searchByDateAndGenre($sp->searchPage, $sp->movieYear, $sp->genresIncluded, $sp->genresExcluded);

            if ($response != null) {
                $sp->loadedMovies = DMovie::checkLoaded($response->movies);
                $sp->maxPage = $response->pages;
                $sp->movies = $response->movies;
            }

            $sp->genres = Genre::getGenres();
        }

        return View::render("main\\movies\\billboard", array_merge($sp->toArray(), $searchResults->toArray()));
    }
}
