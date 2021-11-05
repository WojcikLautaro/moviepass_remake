<?php

namespace Controllers;

use DAO\ApiMovieDAO;
use DAO\GenreDAO;
use DAO\MovieDAO;
use DAO\MovieXGenreDAO;
use DAO\Session;
use DAO\TicketDAO;

use Controllers\ViewsController;
use Config\Router;
use Views\View;
use Exception;

class MoviesController
{
    public function __construct()
    {
        if (!Session::ValidateSession() || !Session::IsUserThisRole(ADMIN_ROLE_NAME))
            Router::Default();
    }

    public static function Index()
    {
        Router::Default();
    }

    public static function GetMovieStatisics(int $idMov, String $strtPeriod = "", String $endPeriod = "")
    {
        try {
            $stats = TicketDAO::getStatisticsFromMovie($idMov, $strtPeriod, $endPeriod);
            ViewsController::MovieStatistics($stats, $strtPeriod, $endPeriod, $idMov);
        } catch (Exception $e) {
            Router::Default('Error processing request');
        }
    }

    public static function List(String $name = "", $genreW = [], $genreWO = [], $year = '0000', int $page = 1)
    {
        $internalmovies = new View("internalmovies");
        $internalmovies->currPage = ($page <= 0) ? 1 : $page;
        $internalmovies->genreW = (!is_array($genreW)) ? [] : $genreW;
        $internalmovies->genreWO = (!is_array($genreWO)) ? [] : $genreWO;
        $internalmovies->name = $name;
        $internalmovies->year = $year;

        try {
            $maxPage = 0;
            $internalmovies->movies = MovieXGenreDAO::getMovies($page, $name, (int) $year, $genreW, $genreWO, $maxPage);
            $internalmovies->maxPage = $maxPage;
            $internalmovies->genres = GenreDAO::getGenres();
            $internalmovies->currUser = Session::GetCurrentUser();

            echo $internalmovies->render();
        } catch (Exception $e) {
            Router::Default('Error processing request');
        }
    }

    public static function Delete($ids)
    {
        $ids = (is_array($ids)) ? $ids : [];

        try {
            foreach ($ids as $value) {
                MovieDAO::deleteById($value);
            }

            MoviesController::List();
        } catch (Exception $th) {
            Router::Default('Error processing request');
        }
    }

    public static function Add($ids)
    {
        if (!is_array($ids))
            $ids = [];

        try {
            foreach ($ids as $value) {
                $movieToAdd = ApiMovieDAO::getApiMovieById((int) $value);
                if ($movieToAdd != null)
                    MovieDAO::addMovie($movieToAdd);
            }

            ApiController::List();
        } catch (Exception $th) {
            Router::Default('Error processing request');
        }
    }
}
