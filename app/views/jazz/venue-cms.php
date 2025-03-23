<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<h1 class="text-center mb-3">Manage Venues</h1>

<div class="center my-3">
    <form method="POST">
        <input type="submit" name="dance" value="Dance Venues" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
    <form method="POST">
        <input type="submit" name="jazz" value="Jazz Venues" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
</div>

<div class="album px-5">
    <div>
        <button class="btn btn-success mb-2" id="show-add-form">Add venue</button>
    </div>

    <!-- hidden form to add a new venue -->
    <div id="form-add-container" style="display: none;">
        <form action="/venue/venuecms" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-1">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Insert Venue Name" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" placeholder="Insert Venue Details" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="type" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="type" name="type" placeholder="Insert Venue Type" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="image1" class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image1" name="image1" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="headerImg" name="headerImg" placeholder="Insert image id..." required>
                </div>
            </div>

            <input type="submit" name="add" value="Insert Venue" class="form-control btn btn-success mb-1">
        </form>
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
                    <td><?= $venue->getDescription() ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($venue->getImage()) . '" height="100px"/>'; ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($venue->getHeaderImg()) . '" height="100px"/>'; ?></td>
                    <!-- change links -->
                    <td>
                        <form action="/venue/venuecms?updateID=<?= $venue->getId() ?>" method="POST">
                            <input type="hidden" name="edit" value="<?= $venue->getId() ?>">
                            <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td>
                        <form action="/venue/venuecms?deleteID=<?= $venue->getId() ?>" method="POST">
                            <input type="hidden" name="delete" value="<?= $venue->getId() ?>">
                            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- UPDATE part -->
    <?php
    if (isset($_POST["edit"])) {
    ?>
        <h3>Edit venue #<?= $updateVenue->getId() ?></h3>
        <div>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row mb-1">
                    <label for="changedName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedName" name="changedName" value="<?= $updateVenue->getName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedDescription" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="changedDescription" id="changedDescription"><?= $updateVenue->getDescription() ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedType" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedType" name="changedType" value="<?= $updateVenue->getType() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedImage" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateVenue->getImage()) . '"  height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedImage" name="changedImage" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedHeaderImage" class="col-sm-2 col-form-label">HeaderImg:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateVenue->getHeaderImg()) . '"  height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedHeaderImage" name="changedHeaderImage" required>
                    </div>

                </div>
                <input type="submit" name="update" value="Update Venue" class="form-control btn btn-success mb-1">
            </form>
        </div>
    <?php
    }
    ?>
</div>
<!-- script to display add form if add button was clicked -->
<script>
    document.getElementById('show-add-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>

<?php
include __DIR__ . '/../../footer.php';
?>