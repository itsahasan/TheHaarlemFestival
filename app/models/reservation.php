<?php
class Reservation implements JsonSerializable {
    private int $id;
    private string $name;
    private int $restaurantID;
    private string $restaurantName;
	private int $sessionID;
	private int $seats;
	private string $date;
	private ?string $request;
	private float $price;
	private bool $status;

	public function jsonSerialize() : mixed
    {
        return get_object_vars($this);
    }

	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value)
	{
		$this->id = $value;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getRestaurantID(): int
	{
		return $this->restaurantID;
	}

	public function setRestaurantID(int $value)
	{
		$this->restaurantID = $value;
	}

	public function getRestaurantName(): string
	{
		return $this->restaurantName;
	}

	public function setRestaurantName(string $value)
	{
		$this->restaurantName = $value;
	}

	public function getSessionID(): int
	{
		return $this->sessionID;
	}

	public function setSessionID(int $value)
	{
		$this->sessionID = $value;
	}

	public function getSeats(): int
	{
		return $this->seats;
	}

	public function setSeats(int $value)
	{
		$this->seats = $value;
	}

	public function getDate(): string
	{
		return $this->date;
	}

	public function setDate(string $value)
	{
		$this->date = $value;
	}

	public function getRequest(): string
	{
		return $this->request;
	}

	public function setRequest(string $value)
	{
		$this->request = $value;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setPrice(float $value)
	{
		$this->price = $value;
	}

	public function getStatus(): bool
	{
		return $this->status;
	}

	public function setStatus(bool $value)
	{
		$this->status = $value;
	}
}
