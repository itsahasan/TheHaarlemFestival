<?php
// app/models/ShoppingCartItem.php

class ShoppingCartItem implements JsonSerializable
{
    private int $id;
    private int $user_id;
    private int $product_id;
    private int $qty;
    private string $event_name;
    private float $event_price;
    private float $subtotal;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $productId): self
    {
        $this->product_id = $productId;
        return $this;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    public function getEventName(): string
    {
        return $this->event_name;
    }

    public function setEventName(string $eventName): self
    {
        $this->event_name = $eventName;
        return $this;
    }

    public function getEventPrice(): float
    {
        return $this->event_price;
    }

    public function setEventPrice(float $eventPrice): self
    {
        $this->event_price = $eventPrice;
        return $this;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function setSubtotal(float $subtotal): self
    {
        $this->subtotal = $subtotal;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}