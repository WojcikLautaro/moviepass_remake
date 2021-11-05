<?php

namespace Controllers;

use DAO\FacebookDAO;
use \Models\User;
use Models\Exceptions\AddUserException;
use DAO\Session;
use DAO\UserDAO;
use Controllers\ViewsController;
use Exception;

class FacebookSessionController
{
    public static function Register(String $username, String $password, int $dni, String $birthday, String $email)
    {
        try {
            if (!Session::ValidateSession()) {
                $time = strtotime($birthday);
                $newformat = date('Y-m-d', $time);

                $newUser = new User($username, $password, CLIENT_ROLE_NAME, $dni, $email, $newformat);
                $result = UserDAO::addUser($newUser);

                if ($result instanceof User) {
                    Session::SetSession(UserDAO::getUserByEmail($email));
                }
            }
        } catch (AddUserException $adu) {
            ViewsController::Show($adu->getExceptionArray());
        } catch (Exception $l) {
            ViewsController::Show(array('Error processing request'));
        }

        HomeController::Index();
    }

    public function Index()
    {
        if (Session::ValidateSession()) {
            HomeController::Index();
            exit;
        }

        try {
            header('Location: ' . FacebookDAO::GetInstance()->GetLoginUrl(
                'http://' . HOST_NAME . '/personal/moviepass/FacebookSession/Login/'
            ));
        } catch (Exception $l) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }
    }

    public function Login()
    {
        if (Session::ValidateSession()) {
            HomeController::Index();
            exit;
        }

        try {
            $fbUser = FacebookDAO::GetInstance()->GetUserData();

            if (UserDAO::isUserDeletedByEmail($fbUser['email'])) {
                ViewsController::Show(array('This account is banned'));

                HomeController::Index();
                return;
            }

            $usr = UserDAO::getUserByEmail($fbUser['email']);
        } catch (Exception $l) {
            ViewsController::Show(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        if ($usr instanceof User) {
            Session::SetSession($usr);
            HomeController::Index();
        } else {
            $fbname = $fbUser['first_name'] . ' ' .  $fbUser['last_name'];
            $fbemail = $fbUser['email'];

            ViewsController::FacebookLoginAddUser($fbname, $fbemail);
        }
    }
}
