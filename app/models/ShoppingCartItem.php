<?php
class ShoppingCartItem implements JsonSerializable
{
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    private int $id;
    private int $user_id;
    private int $product_id;
    private int $qty;
    private string $event_name;
    private float $event_price;
    private float $subtotal;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of qty
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set the value of qty
     *
     * @return  self
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get the value of event_name
     */
    public function getEvent_name()
    {
        return $this->event_name;
    }

    /**
     * Set the value of event_name
     *
     * @return  self
     */
    public function setEvent_name($event_name)
    {
        $this->event_name = $event_name;

        return $this;
    }

    /**
     * Get the value of event_price
     */
    public function getEvent_price()
    {
        return $this->event_price;
    }

    /**
     * Set the value of event_price
     *
     * @return  self
     */
    public function setEvent_price($event_price)
    {
        $this->event_price = $event_price;

        return $this;
    }

    /**
     * Get the value of subtotal
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }
}
