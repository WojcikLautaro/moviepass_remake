<?php

namespace Controllers;

use DAO\FunctionsDAO;
use DAO\MovieXGenreDAO;
use DAO\RoomDBDAO;
use DAO\Session;
use Models\Exceptions\ArrayException;
use Controllers\ViewsController;
use DAO\TicketDAO;
use Exception;

class FunctionsController
{
    public function __construct()
    {
        if (!Session::ValidateSession()) {
            HomeController::Index();
            exit();
        }
        if (!Session::IsUserThisRole(ADMIN_ROLE_NAME)) {
            HomeController::Index();
            exit();
        }
    }

    public static function Index()
    {
        HomeController::Index();
    }

    public static function List(int $roomId)
    {
        $cin = RoomDBDAO::getCinemaByRoomId($roomId);
        $opt = $cin->getopeningTime();
        $cst = $cin->getclosingTime();

        try {
            $functions = FunctionsDAO::getAllFromRoom($roomId);

            $statistics = [];
            foreach ($functions as $value) {
                $statistics[$value->getidFunction()] = TicketDAO::getStatisticsFromFunction($value->getidFunction());
            }

        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        ViewsController::FunctionList($opt, $cst, $roomId, $functions, $statistics);
    }

    public static function Delete(int $id, int $roomid)
    {
        try {
            FunctionsDAO::delete($id);
        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        FunctionsController::List($roomid);
    }

    public static function SelectMovieAdd(String $time, String $date, int $roomId, int $page = 1)
    {
        if ($page <= 0)
            $page = 1;

        try {
            $movies = MovieXGenreDAO::getMovies($page);
        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        ViewsController::MovieSelectAddFunction($time, $date, $roomId, $page, $movies);
    }

    public static function SelectMovieUpdate(String $time, String $date, int $roomId, int $functionId, int $page = 1)
    {
        if ($page <= 0)
            $page = 1;

        try {
            $movies = MovieXGenreDAO::getMovies($page);
        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        ViewsController::MovieSelectUpdateFunction($time, $date, $roomId, $functionId, $page, $movies);
    }

    public static function Update(String $time, String $date, int $roomId, int $functionId, int $movieId)
    {
        try {
            FunctionsDAO::update($time, $date, $roomId, $functionId, $movieId);
        } catch (ArrayException $EX) {
            ViewsController::Show($EX->getExceptionArray());
        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        FunctionsController::List($roomId);
    }

    public static function Add(String $time, String $date, int $roomId, int $movieId)
    {
        try {
            FunctionsDAO::add($time, $date, $roomId, $movieId);
        } catch (ArrayException $EX) {
            ViewsController::Show($EX->getExceptionArray());
        } catch (Exception $th) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        FunctionsController::List($roomId);
    }
}
