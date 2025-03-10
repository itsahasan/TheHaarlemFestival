<?php
require __DIR__ . '/../repositories/albumrepository.php';

class AlbumService
{
    private $albumRepository;

    public function __construct()
    {
        $this->albumRepository = new AlbumRepository();
    }

    public function getAllAlbumsByArtist($artistID)
    {
        return $this->albumRepository->getAllAlbumsByArtist($artistID);
    }
}
