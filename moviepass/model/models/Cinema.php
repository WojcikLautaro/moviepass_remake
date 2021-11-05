<?php

namespace Models;

class Cinema
{
	private $nameCinema;
	private $address;
	private $openingTime;
	private $closingTime;
	private $ticketValue;
	private $capacity;
	private $idCinema;
	private $deleteCinema;

	public static function fromArray($v)
	{
		$cinema = new Cinema();
		$cinema->setnameCinema($v['cinemaName']);
		$cinema->setAddress($v['address']);
		$cinema->setOpeningTime($v['openingTime']);
		$cinema->setClosingTime($v['closingTime']);
		$cinema->setTicketValue($v['ticket_value']);
		$cinema->setCapacity($v['capacity']);
		$cinema->setidCinema($v['idCinema']);

		return $cinema;
	}

	public function setNameCinema($nameCinema)
	{
		$this->nameCinema = $nameCinema;
	}

	public function getNameCinema()
	{
		return $this->nameCinema;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getAddress()
	{
		return $this->address;
	}
	public function setOpeningTime($openingTime)
	{
		$this->openingTime = $openingTime;
	}

	public function getOpeningTime()
	{
		return $this->openingTime;
	}

	public function setClosingTime($closingTime)
	{
		$this->closingTime = $closingTime;
	}

	public function getClosingTime()
	{
		return $this->closingTime;
	}

	public function setTicketValue($ticketValue)
	{
		$this->ticketValue = $ticketValue;
	}

	public function getTicketValue()
	{
		return $this->ticketValue;
	}

	public function setCapacity($capacity)
	{
		$this->capacity = $capacity;
	}

	public function getCapacity()
	{
		return $this->capacity;
	}

	public function setIdCinema($idCinema)
	{
		$this->idCinema = $idCinema;
	}

	public function getIdCinema()
	{
		return $this->idCinema;
	}

	public function setDeleteCinema($deleteCinema)
	{
		$this->deleteCinema = $deleteCinema;
	}

	public function getDeleteCinema()
	{
		return $this->deleteCinema;
	}
}
