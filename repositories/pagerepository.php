<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/page.php';

class PageRepository extends Repository
{
    function getOnePage($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT page.id, images.image as headerImg, page.title, page.description 
            FROM page 
            JOIN images ON page.headerImg=images.id 
            WHERE page.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
            $page = $stmt->fetch();

            return $page;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updatePage($page, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE page SET headerImg = ?, title = ?, description = ? WHERE id = ?");
            $stmt->execute([$page->getHeaderImg(),  $page->getTitle(), $page->getDescription(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
