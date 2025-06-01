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
            <h2>Manage Venues</h2>
        </div>

        <div class="center d-flex justify-content-start my-3">
            <form method="POST">
                <input type="submit" name="dance" value="Dance Venues" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="jazz" value="Jazz Venues" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
        </div>
    </div>

    <div class="album px-5">
    <div>
        <a  href="<?php echo $createUrl ?>" class="btn btn-success mb-2" id="show-add-form">Add venue</a>
    </div>


    <!-- display data -->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Header Img</th>
                <th scope="col" colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $venue) {
            ?>
                <tr>
                    <td><?= $venue->getId() ?></td>
                    <td><?= $venue->getName() ?></td>
                    <td><?= trim(strip_tags(html_entity_decode($venue->getDescription())))   ?></td>

                    <td>

                                        
                    <img  style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($venue->getImage()); ?>"  class="card-img-top" alt="Loading image...">

                    </td>
                    <td>

         
                    <img  style="width: 90px; height: 80px; object-fit:cover;box-shadow: 0px 3px 15px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($venue->getHeaderImg()); ?>"  class="card-img-top" alt="Loading image...">

                    </td>



                    <td style="width:2%;">
                    
                        <a class="btn btn-warning" href="/admin/venue/edit?updateID=<?php echo $venue->getId(); ?>">Edit</a>


                    </td>
                    <td style="width:2%;">
                        <button class="btn btn-danger" data-href="/admin/venue/delete?deleteID=<?php echo $venue->getId(); ?>" data-action="delete" data-user-id="<?php echo $venue->getId(); ?>">Delete</button>
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
