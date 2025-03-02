<?php
class PageCard
{
    private int $id;
    private string $title;
    private ?string $opening_time;
    private ?string $closing_time;
    private ?string $location;
    private ?float $rating;
    private ?float $adult_price;
    private ?float $kids_price;
    private string $image;
    private ?string $link;
    private ?string $description;
    private int $pageId;

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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of opening_time
     */
    public function getOpening_time()
    {
        return $this->opening_time;
    }

    /**
     * Set the value of opening_time
     *
     * @return  self
     */
    public function setOpening_time($opening_time)
    {
        $this->opening_time = $opening_time;

        return $this;
    }

    /**
     * Get the value of closing_time
     */
    public function getClosing_time()
    {
        return $this->closing_time;
    }

    /**
     * Set the value of closing_time
     *
     * @return  self
     */
    public function setClosing_time($closing_time)
    {
        $this->closing_time = $closing_time;

        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of adult_price
     */
    public function getAdult_price()
    {
        return $this->adult_price;
    }

    /**
     * Set the value of adult_price
     *
     * @return  self
     */
    public function setAdult_price($adult_price)
    {
        $this->adult_price = $adult_price;

        return $this;
    }

    /**
     * Get the value of kids_price
     */
    public function getKids_price()
    {
        return $this->kids_price;
    }

    /**
     * Set the value of kids_price
     *
     * @return  self
     */
    public function setKids_price($kids_price)
    {
        $this->kids_price = $kids_price;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of pageId
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Set the value of pageId
     *
     * @return  self
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }
}
