<?php

namespace DAO;

use DAO\Connection;
use Models\Cinema as Cinema;
use PDOException;

class CinemaDBDAO
{
  private $connection = null;

  public static function getCinemasFromMovie(int $idMov)
  {
    $query = "call getCinemasFromMovie(:idMov);";
    $param = [];
    $param['idMov'] = $idMov;

    try {
      $conection = Connection::GetInstance();
      $response = $conection->Execute($query, $param);
    } catch (PDOException $th) {
      throw $th;
    }

    return $roleArray = array_map(function (array $obj) {
      return CinemaDBDAO::Read($obj['idCinema']);
    }, $response);
  }

  public function ReadAll()
  {

    $sql = "call getAllActiveCinemas();";

    try {
      $this->connection = Connection::getInstance();
      $resultSet = $this->connection->Execute($sql);
      if (!empty($resultSet))
        return $this->Mapear($resultSet);
      else
        return false;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  protected function Mapear($value)
  {
    $cinemaList = array();
    foreach ($value as $v) {
      array_push($cinemaList, Cinema::fromArray($v));
    }
    if (count($cinemaList) > 0)
      return $cinemaList;
    else
      return false;
  }

  public function Add($cinema)
  {
    $sql = "call addCinema (:cinemaName, :address, :openingTime, :closingTime, :ticket_value, :capacity, :cinemadelete)";
    $parameters['cinemaName'] = $cinema->getnameCinema();
    $parameters['address'] = $cinema->getaddress();
    $parameters['openingTime'] = $cinema->getopeningTime();
    $parameters['closingTime'] = $cinema->getclosingTime();
    $parameters['ticket_value'] = $cinema->getticketValue();
    $parameters['capacity'] = $cinema->getcapacity();
    $parameters['cinemadelete'] = 0;

    try {
      $this->connection = Connection::getInstance();
      $this->connection->ExecuteNonQuery($sql, $parameters);
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function Remove($idCinema)
  {
    $sql = "call deleteCinema(:idCinema)";
    $parameters['idCinema'] = $idCinema;

    try {
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    } catch (PDOException $e) {

      echo $e;
    }
  }

  public function Update(Cinema $cinemaToUpdate)
  {
    $sql = "call updateCinema (:cinemaName, :address, :openingTime, :closingTime, :ticket_value, :capacity, :idCinema)";

    $parameters = [];
    $parameters['idCinema'] = $cinemaToUpdate->getidCinema();
    $parameters['cinemaName'] = $cinemaToUpdate->getnameCinema();
    $parameters['address'] = $cinemaToUpdate->getaddress();
    $parameters['openingTime'] = $cinemaToUpdate->getopeningTime();
    $parameters['closingTime'] = $cinemaToUpdate->getclosingTime();
    $parameters['ticket_value'] = $cinemaToUpdate->getticketValue();
    $parameters['capacity'] = $cinemaToUpdate->getcapacity();

    try {
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    } catch (PDOException $e) {

      echo $e;
    }
  }

  public function Read($idCinema)
  {
    $sql = "call getCinema(:idCinema);";
    $parameters['idCinema'] = $idCinema;
    try {
      $this->connection = Connection::getInstance();
      $resultSet = $this->connection->execute($sql, $parameters);

      if (!empty($resultSet)) {
        $result = $this->mapear($resultSet);
        $result[0]->setdeleteCinema();
        $result[0]->setdeleteCinema($result[0] = 0);

        return $result[0];
      } else
        return false;
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
