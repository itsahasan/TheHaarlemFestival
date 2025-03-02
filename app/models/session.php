<?php
class Session
{
	private int $id;
	private int $restaurantid;
	private string $restaurantname;
	private float $price;
	private float $reducedprice;
	private string $starttime;
	private float $session_length;
	private int $available_seats;

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $value)
	{
		$this->id = $value;
	}

	public function getRestaurantid(): int
	{
		return $this->restaurantid;
	}

	public function setRestaurantid(int $value)
	{
		$this->restaurantid = $value;
	}

	public function getRestaurantname(): string
	{
		return $this->restaurantname;
	}

	public function setRestaurantname(string $value)
	{
		$this->restaurantname = $value;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setPrice(float $value)
	{
		$this->price = $value;
	}

	public function getReducedprice(): float
	{
		return $this->reducedprice;
	}

	public function setReducedprice(float $value)
	{
		$this->reducedprice = $value;
	}

	public function getStarttime(): string
	{
		return $this->starttime;
	}

	public function setStarttime(string $value)
	{
		$this->starttime = $value;
	}

	public function getSession_length(): float
	{
		return $this->session_length;
	}

	public function setSession_length(float $value)
	{
		$this->session_length = $value;
	}

	public function getAvailable_seats(): int
	{
		return $this->available_seats;
	}

	public function setAvailable_seats(int $value)
	{
		$this->available_seats = $value;
	}
}
