<?php
// app/models/OrderItem.php

class OrderItem
{
    private int $id;
    private int $order_id;
    private int $product_id;
    private int $qty;
    private float $price;

    // ДОБАВЛЕНО: Свойство для хранения имени ивента, которое мы получаем из VIEW
    private string $event_name;

    // --- Геттеры и сеттеры в стандартном camelCase стиле ---

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $orderId): self
    {
        $this->order_id = $orderId;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    // ДОБАВЛЕНЫ: Геттер и сеттер для имени ивента
    public function getEventName(): string
    {
        return $this->event_name;
    }

    public function setEventName(string $eventName): self
    {
        $this->event_name = $eventName;
        return $this;
    }
}