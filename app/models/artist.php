<?php

class Artist
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?string $type = null;
    private ?string $headerImg = null;
    private ?string $thumbnailImg = null;
    private ?string $logo = null;
    private ?string $spotify = null;
    private ?string $image = null;

    // ID
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    // Name
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    // Description
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    // Type
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    // Header Image
    public function getHeaderImg(): ?string
    {
        return $this->headerImg;
    }

    public function setHeaderImg(string $headerImg): self
    {
        $this->headerImg = $headerImg;
        return $this;
    }

    // Thumbnail Image
    public function getThumbnailImg(): ?string
    {
        return $this->thumbnailImg;
    }

    public function setThumbnailImg(string $thumbnailImg): self
    {
        $this->thumbnailImg = $thumbnailImg;
        return $this;
    }

    // Logo
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    // Spotify
    public function getSpotify(): ?string
    {
        return $this->spotify;
    }

    public function setSpotify(string $spotify): self
    {
        $this->spotify = $spotify;
        return $this;
    }

    // Image
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
}
