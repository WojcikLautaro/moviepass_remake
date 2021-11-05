<?php

namespace DAO;

use PDOException;

class DiscountDAO
{
    public static function GetDiscountAndMinTicketsFromToday()
    {
        $query = "call getDiscountAndMinTicketsFromToday()";

        try {
            $conection = Connection::GetInstance();
            $response = $conection->Execute($query, []);
        } catch (PDOException $th) {
            throw $th;
        }

        if ($response != null && isset($response[0]))
            return $response[0];
    }

    public static function GetDiscountIdForNoDiscount()
    {
        $query = "call getDiscountIdForNoDiscount(:none);";

        try {
            $conection = Connection::GetInstance();
            $response = $conection->Execute($query, array('none' => 'None'));
        } catch (PDOException $th) {
            throw $th;
        }

        if ($response != null && isset($response[0]))
            return $response[0]['id'];
    }

    public static function GetDiscountIdForToday()
    {
        $query = "call getDiscountIdForToday();";

        try {
            $conection = Connection::GetInstance();
            $response = $conection->Execute($query, []);
        } catch (PDOException $th) {
            throw $th;
        }

        if ($response != null && isset($response[0]))
            return $response[0]['id'];
    }

    public static function GetDiscountAndMinTicketsFromId(int $id)
    {
        $query = "call getDiscountAndMinTicketsFromId(:id);";

        try {
            $conection = Connection::GetInstance();
            $response = $conection->Execute($query, array('id' => $id));
        } catch (PDOException $th) {
            throw $th;
        }

        if ($response != null && isset($response[0]))
            return $response[0];
    }
}
