<?php
class Restaurant {
    private int $id;
    private string $name;
    private string $location;
    private string $description;
    private string $cuisine;
    private int $stars;
    private string $email;
    private string $phonenumber;
    private int $seats;
    private float $price;
    private int $image1;
    private int $image2;
    private int $image3;

    private ?string $image1_data = null;
    private ?string $image2_data = null;
    private ?string $image3_data = null;

    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getLocation(): string { return $this->location; }
    public function setLocation(string $location): self { $this->location = $location; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getCuisine(): string { return $this->cuisine; }
    public function setCuisine(string $cuisine): self { $this->cuisine = $cuisine; return $this; }
    public function getStars(): int { return $this->stars; }
    public function setStars(int $stars): self { $this->stars = $stars; return $this; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getPhonenumber(): string { return $this->phonenumber; }
    public function setPhonenumber(string $phonenumber): self { $this->phonenumber = $phonenumber; return $this; }
    public function getSeats(): int { return $this->seats; }
    public function setSeats(int $seats): self { $this->seats = $seats; return $this; }
    public function getPrice(): float { return $this->price; }
    public function setPrice(float $price): self { $this->price = $price; return $this; }
    public function getImage1(): int { return $this->image1; }
    public function setImage1(int $image1): self { $this->image1 = $image1; return $this; }
    public function getImage2(): int { return $this->image2; }
    public function setImage2(int $image2): self { $this->image2 = $image2; return $this; }
    public function getImage3(): int { return $this->image3; }
    public function setImage3(int $image3): self { $this->image3 = $image3; return $this; }

    public function getImage1Data(): ?string { return $this->image1_data; }
    public function getImage2Data(): ?string { return $this->image2_data; }
    public function getImage3Data(): ?string { return $this->image3_data; }
}