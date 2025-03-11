<?php
require __DIR__ . '/../repositories/artistrepository.php';

class ArtistService
{
    private $artistRepository;

    public function __construct()
    {
        $this->artistRepository = new ArtistRepository();
    }

    public function getAll()
    {
        return $this->artistRepository->getAll();
    }

    public function getAllDanceArtists()
    {
        return $this->artistRepository->getAllDanceArtists();
    }

    public function getAllJazzArtists()
    {
        return $this->artistRepository->getAllJazzArtists();
    }

    public function getOne($id)
    {
        return $this->artistRepository->getOne($id);
    }

    public function getOneArtistByName($name)
    {
        return $this->artistRepository->getOneArtistByName($name);
    }

    public function addArtist(Artist $artist)
    {
        return $this->artistRepository->addArtist($artist);
    }

    public function updateArtist($artist, $id)
    {
        return $this->artistRepository->updateArtist($artist, $id);
    }

    public function deleteArtist($id)
    {
        return $this->artistRepository->deleteArtist($id);
    }

    public function saveImage($imgData)
    {
        return $this->artistRepository->saveImage($imgData);
    }

    public function updateImage($imgData, $id)
    {
        return $this->artistRepository->updateImage($imgData, $id);
    }

    public function getAnArtist($id)
    {
        return $this->artistRepository->getAnArtist($id);
    }
}
