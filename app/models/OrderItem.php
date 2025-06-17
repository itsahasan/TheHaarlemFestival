<?php
// models/orders_item.php

// Prevent redeclaration if this file is included more than once
if (class_exists('OrderItem', false)) {
    return;
}

class OrderItem
{
    private int $id;
    private int $order_id;
    private int $product_id;
    private int $qty;
    private float $price;
    private int $user_id;
    private string $event_name;
    private float $event_price;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getOrder_id(): int
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     */
    public function setOrder_id(int $order_id): self
    {
        $this->order_id = $order_id;
        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProduct_id(): int
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProduct_id(int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * Get the value of qty
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * Set the value of qty
     */
    public function setQty(int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUser_id(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of event_name
     */
    public function getEvent_name(): string
    {
        return $this->event_name;
    }

    /**
     * Set the value of event_name
     */
    public function setEvent_name(string $event_name): self
    {
        $this->event_name = $event_name;
        return $this;
    }

    /**
     * Get the value of event_price
     */
    public function getEvent_price(): float
    {
        return $this->event_price;
    }

    /**
     * Set the value of event_price
     */
    public function setEvent_price(float $event_price): self
    {
        $this->event_price = $event_price;
        return $this;
    }
}
