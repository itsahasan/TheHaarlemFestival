<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<h1 class="text-center mb-3">Manage Artists</h1>

<div class="center my-3">
    <form method="POST">
        <input type="submit" name="dance" value="Dance Artists" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
    <form method="POST">
        <input type="submit" name="jazz" value="Jazz Artists" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
</div>

<div class="album px-5">
    <div>
        <button class="btn btn-success mb-2" id="show-add-form">Add artist</button>
    </div>

    <!-- hidden form to add a new artist -->
    <div id="form-add-container" style="display: none;">
        <form action="/artist/artistcms" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-1">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Insert Artist Name" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" placeholder="Insert Artist Details" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="type" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="type" name="type" placeholder="Insert Artist Type" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="headerImg" name="headerImg" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="thumbnailImg" class="col-sm-2 col-form-label">ThumbnailImg:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="thumbnailImg" name="thumbnailImg" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="logo" class="col-sm-2 col-form-label">Logo:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="logo" name="logo" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="spotify" class="col-sm-2 col-form-label">Spotify (link):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="spotify" name="spotify" placeholder="Insert Spotify embedded song link" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="image" class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
            </div>

            <input type="submit" name="add" value="Insert Artist" class="form-control btn btn-success mb-1">
        </form>
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
                    <td style="width:50%;"><?= $artist->getDescription() ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getHeaderImg()) . '" width="150px"/>'; ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getThumbnailImg()) . '"  height="100px"/>'; ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getLogo()) . '"  width="100px"/>'; ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($artist->getImage()) . '"  height="100px"/>'; ?></td>
                    <td style="width:25%;"><iframe style="border-radius:12px" src="<?= $artist->getSpotify() ?>" width="100%" height="300px" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe></td>
                    <td style="width:2%;">
                        <form action="/artist/artistcms?updateID=<?= $artist->getId() ?>" method="POST">
                            <input type="hidden" name="edit" value="<?= $artist->getId() ?>">
                            <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td style="width:2%;">
                        <form action="/artist/artistcms?deleteID=<?= $artist->getId() ?>" method="POST">
                            <input type="hidden" name="delete" value="<?= $artist->getId() ?>">
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
        <h3>Edit artist #<?= $updateArtist->getId() ?></h3>
        <div>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row mb-1">
                    <label for="changedName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedName" name="changedName" value="<?= $updateArtist->getName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedDescription" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="changedDescription" id="changedDescription"><?= $updateArtist->getDescription() ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedType" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedType" name="changedType" value="<?= $updateArtist->getType() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedHeaderImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateArtist->getHeaderImg()) . '" height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedHeaderImg" name="changedHeaderImg" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedThumbnailImg" class="col-sm-2 col-form-label">ThumbnailImg:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateArtist->getThumbnailImg()) . '" height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedThumbnailImg" name="changedThumbnailImg" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedLogo" class="col-sm-2 col-form-label">Logo:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateArtist->getLogo()) . '" height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedLogo" name="changedLogo" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedSpotify" class="col-sm-2 col-form-label">Spotify:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedSpotify" name="changedSpotify" value="<?= $updateArtist->getSpotify() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedImage" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateArtist->getImage()) . '" height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changedImage" name="changedImage" required>
                    </div>
                </div>
                <input type="submit" name="update" value="Update Artist" class="form-control btn btn-success mb-1">
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