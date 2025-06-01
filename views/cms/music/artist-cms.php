<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<section class="py-5">
    <div class="d-flex justify-content-between w-100 px-5">
        <div class="section-title text-center grow-1">
            <h2>Manage Artists</h2>
        </div>
        <div class="center d-flex justify-content-start my-3">
            <form method="POST">
                <input type="submit" name="dance" value="Dance Artists" class="btn btn-primary mr-3  filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="jazz" value="Jazz Artists" class="btn btn-primary  filterbtn"></a>
            </form>
        </div>
    </div>

        <div class="album px-5">
            <div>
                <a href="<?php echo $createUrl ?>" class="btn btn-success mb-2"  >Add artist</a>
            </div>
            <!-- display data -->
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">HeaderIMG</th>
                        <th scope="col">ThumbnailIMG</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Image</th>
                        <th scope="col">Spotify</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($model as $artist) {
                    ?>
                        <tr>
                            <td><?= $artist->getId() ?></td>
                            <td style="width:2%;"><?= $artist->getName() ?></td>
                            <td style="width:50%;"><?= trim(strip_tags(html_entity_decode($artist->getDescription()))) ?></td>
                            <td>

                                                
                            <img  style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($artist->getHeaderImg()); ?>"  class="card-img-top" alt="Loading image...">

                            </td>
                            <td>

                                                
                            <img  style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($artist->getThumbnailImg()); ?>"  class="card-img-top" alt="Loading image...">

                            </td>
                            <td>

                                                
                            <img  style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($artist->getLogo()); ?>"  class="card-img-top" alt="Loading image...">

                            </td>
                            <td>

                                                
                            <img style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)"  height="100px" src="/uploads/<?php echo htmlspecialchars($artist->getImage()); ?>"  class="card-img-top" alt="Loading image...">

                            </td>

                    
                            <td style="width:25%;">
                                <a target="_blank" href="<?php $artist->getSpotify() ?>">

                                <?php echo $artist->getSpotify() ?>

                                </a>
                            </td>
                            <td style="width:2%;">
                            
                                <a class="btn btn-warning" href="/admin/artist/edit?updateID=<?php echo $artist->getId(); ?>">Edit</a>


                            </td>
                            <td style="width:2%;">
                                <button class="btn btn-danger" data-href="/admin/artist/delete?deleteID=<?php echo $artist->getId(); ?>" data-action="delete" data-user-id="<?php echo $artist->getId(); ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>


<?php
include __DIR__ . '/../../footer.php';
?>
<?php else: ?>
<div class="alert alert-danger mt-4 text-center">
    You do not have permission to access this CMS section.
</div>
<?php endif; ?>
