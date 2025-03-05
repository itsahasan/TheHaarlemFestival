<?php
class Music_Event
{
    private int $id;
    private string $type;
    private string $artist;
    private string $venue;
    private int $ticket_price;
    private int $tickets_available;
    private string $datetime;
    private string $image;
    private string $name;

   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    public function getTicket_price()
    {
        return $this->ticket_price;
    }


    public function setTicket_price($ticket_price)
    {
        $this->ticket_price = $ticket_price;

        return $this;
    }

 
    public function getTickets_available()
    {
        return $this->tickets_available;
    }


    public function setTickets_available($tickets_available)
    {
        $this->tickets_available = $tickets_available;

        return $this;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }


    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

 
    public function getImage()
    {
        return $this->image;
    }

 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
