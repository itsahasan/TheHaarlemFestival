<?php
class OrdersItem
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
     * Get the value of order_id
     */
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

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
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;

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
}
