<?php

namespace Controllers;

use DAO\RolesDAO as RolesDAO;
use DAO\UserDAO as UserDAO;
use DAO\Session;
use Models\Exceptions\AddUserException;
use Models\Exceptions\UpdateUserException;
use Models\User as User;
use Controllers\ViewsController;
use Exception;

class UsersController
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

    public static function Add(String $username, String $password, String $email, int $dni, String $birthday, String $role)
    {
        try {
            $time = strtotime($birthday);
            $newformat = date('Y-m-d', $time);

            UserDAO::addUser(new User($username, $password, $role, $dni, $email, $newformat));
        } catch (AddUserException $aue) {
            ViewsController::setAlerts($aue->getExceptionArray());
        } catch (Exception $th) {
            ViewsController::setAlerts(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        UsersController::List();
    }

    public static function Index()
    {
        UsersController::List();
    }

    public static function List(String $name = "", String $email = "", String $dni = "", String $role = "")
    {
        try {
            $role = ($role = RolesDAO::getRoleByName($role)) ? $role->getId() : '';
            $users = UserDAO::getUsers($name, $email, $dni, $role);
            $roles = RolesDAO::getRoles();
        } catch (Exception $th) {
            ViewsController::setAlerts(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        ViewsController::UsersList($roles, $users, $name, $email, $dni, $role, Session::GetCurrentUser());
    }

    public static function Edit(String $email, int $dni, String $birthday, String $role, int $id)
    {

        var_dump($email,  $dni,  $birthday,  $role,  $id);
        try {
            if (Session::ValidateSession() && $id != Session::GetUserId()) {
                $user = UserDAO::getUserById($id);

                if ($user instanceof User) {
                    $time = strtotime($birthday);
                    $newformat = date('Y-m-d', $time);

                    $user->setEmail($email);
                    $user->setDni($dni);
                    $user->setBirthday($newformat);
                    $user->setRole($role);

                    UserDAO::updateUser($user);
                }
            }
        } catch (UpdateUserException $uue) {
            ViewsController::setAlerts($uue->getExceptionArray());
        } catch (Exception $th) {
            ViewsController::setAlerts(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        UsersController::List();
    }

    public static function Delete(int $id)
    {
        try {
            if (Session::ValidateSession() && $id != Session::GetUserId())
                UserDAO::deleteUser($id);
        } catch (Exception $th) {
            ViewsController::setAlerts(array('Error processing request'));
            HomeController::Index();
            exit;
        }

        UsersController::List();
    }
}
