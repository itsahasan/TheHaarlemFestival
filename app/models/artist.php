<?php
class Artist
{
    private int $id;
    private string $name;
    private string $description;
    private string $type;
    private string $headerImg;
    private string $thumbnailImg;
    private string $logo;
    private string $spotify;
    private string $image;

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of headerImg
     */
    public function getHeaderImg()
    {
        return $this->headerImg;
    }

    /**
     * Set the value of headerImg
     *
     * @return  self
     */
    public function setHeaderImg($headerImg)
    {
        $this->headerImg = $headerImg;

        return $this;
    }

    /**
     * Get the value of thumbnailImg
     */
    public function getThumbnailImg()
    {
        return $this->thumbnailImg;
    }

    /**
     * Set the value of thumbnailImg
     *
     * @return  self
     */
    public function setThumbnailImg($thumbnailImg)
    {
        $this->thumbnailImg = $thumbnailImg;

        return $this;
    }

    /**
     * Get the value of logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @return  self
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get the value of spotify
     */
    public function getSpotify()
    {
        return $this->spotify;
    }

    /**
     * Set the value of spotify
     *
     * @return  self
     */
    public function setSpotify($spotify)
    {
        $this->spotify = $spotify;

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
}
