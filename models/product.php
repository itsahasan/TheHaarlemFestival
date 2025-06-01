<?php
class Product
{
    private int $event_id;
    private string $event_name;
    private float $event_price;
    private string $event_datetime;
    private string $event_location;
    private int $tickets_available;
    private string $event_type;

    /**
     * Get the value of event_id
     */
    public function getEvent_id()
    {
        return $this->event_id;
    }

    /**
     * Set the value of event_id
     *
     * @return  self
     */
    public function setEvent_id($event_id)
    {
        $this->event_id = $event_id;

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
     * Get the value of event_datetime
     */
    public function getEvent_datetime()
    {
        return $this->event_datetime;
    }

    /**
     * Set the value of event_datetime
     *
     * @return  self
     */
    public function setEvent_datetime($event_datetime)
    {
        $this->event_datetime = $event_datetime;

        return $this;
    }

    /**
     * Get the value of event_location
     */
    public function getEvent_location()
    {
        return $this->event_location;
    }

    /**
     * Set the value of event_location
     *
     * @return  self
     */
    public function setEvent_location($event_location)
    {
        $this->event_location = $event_location;

        return $this;
    }

    /**
     * Get the value of tickets_available
     */
    public function getTickets_available()
    {
        return $this->tickets_available;
    }

    /**
     * Set the value of tickets_available
     *
     * @return  self
     */
    public function setTickets_available($tickets_available)
    {
        $this->tickets_available = $tickets_available;

        return $this;
    }

    /**
     * Get the value of event_type
     */
    public function getEvent_type()
    {
        return $this->event_type;
    }

    /**
     * Set the value of event_type
     *
     * @return  self
     */
    public function setEvent_type($event_type)
    {
        $this->event_type = $event_type;

        return $this;
    }
}
