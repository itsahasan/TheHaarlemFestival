<?php
class Restaurant
{
	private int $id;
	private string $name;
	private string $cuisine;
	private int $seats;
	private string $description;
	private string $location;
	private int $stars;
	private string $image1;
	private string $image2;
	private string $image3;
	private string $phonenumber;
	private string $email;

	public function getId(): int
	{
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

	public function getCuisine(): string
	{
		return $this->cuisine;
	}

	public function setCuisine(string $value)
	{
		$this->cuisine = $value;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $value)
	{
		$this->description = $value;
	}

	public function getLocation(): string
	{
		return $this->location;
	}

	public function setLocation(string $value)
	{
		$this->location = $value;
	}

	public function getStars(): int
	{
		return $this->stars;
	}

	public function setStars(int $value)
	{
		$this->stars = $value;
	}

	public function getImage1(): string
	{
		return $this->image1;
	}

	public function setImage1(string $value)
	{
		$this->image1 = $value;
	}

	public function getImage2(): string
	{
		return $this->image2;
	}

	public function setImage2(string $value)
	{
		$this->image2 = $value;
	}

	public function getImage3(): string
	{
		return $this->image3;
	}

	public function setImage3(string $value)
	{
		$this->image3 = $value;
	}

	public function getPhonenumber(): string
	{
		return $this->phonenumber;
	}

	public function setPhonenumber(string $value)
	{
		$this->phonenumber = $value;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $value)
	{
		$this->email = $value;
	}
	public function getSeats(): string
	{
		return $this->seats;
	}

	public function setSeats(string $value)
	{
		$this->seats = $value;
	}
}
