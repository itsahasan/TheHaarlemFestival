<?php
// models/Order.php

class Order
{
    private int $id = 0;
    private string $firstName = '';
    private string $lastName = '';
    private string $birthdate = '';
    private string $emailAddress = '';
    private string $streetAddress = '';
    private string $country = '';
    private string $zipCode = '';
    private string $phoneNumber = '';
    private int $user_id = 0;
    private float $totalprice = 0.0;
    private ?string $paymentId = null;
    private ?string $created_at = null;

    // ДОБАВЛЕНО: Свойство для статуса платежа
    private ?string $payment_status = 'pending';


    // --- getters / setters для всех полей ---

    // ... все твои существующие геттеры и сеттеры (getId, getFirstName и т.д.) остаются без изменений ...

    // ДОБАВЛЕН НОВЫЙ МЕТОД:
    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    // Остальные геттеры и сеттеры
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): void { $this->firstName = $firstName; }

    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): void { $this->lastName = $lastName; }

    public function getBirthDate(): string { return $this->birthdate; }
    public function setBirthDate(string $birthdate): void { $this->birthdate = $birthdate; }

    public function getEmailAddress(): string { return $this->emailAddress; }
    public function setEmailAddress(string $emailAddress): void { $this->emailAddress = $emailAddress; }

    public function getStreetAddress(): string { return $this->streetAddress; }
    public function setStreetAddress(string $streetAddress): void { $this->streetAddress = $streetAddress; }

    public function getCountry(): string { return $this->country; }
    public function setCountry(string $country): void { $this->country = $country; }

    public function getZipCode(): string { return $this->zipCode; }
    public function setZipCode(string $zipCode): void { $this->zipCode = $zipCode; }

    public function getPhoneNumber(): string { return $this->phoneNumber; }
    public function setPhoneNumber(string $phoneNumber): void { $this->phoneNumber = $phoneNumber; }

    public function getUserId(): int { return $this->user_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }

    public function getTotalPrice(): float { return $this->totalprice; }
    public function setTotalPrice(float $totalprice): self { $this->totalprice = $totalprice; return $this; }

    public function getPaymentId(): ?string { return $this->paymentId; }
    public function setPaymentId(?string $paymentId): void { $this->paymentId = $paymentId; }

    public function getCreatedAt(): ?string { return $this->created_at; }
    public function setCreatedAt(string $ts): void { $this->created_at = $ts; }
}