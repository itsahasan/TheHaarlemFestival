<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
<?php include __DIR__ . '/../../header.php'; ?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<h1 class="text-center mb-3">Manage Artists</h1>

<div class="center my-3">
    <form method="POST">
        <input type="submit" name="dance" value="Dance Artists" class="btn btn-primary mx-3 filterbtn">
    </form>
    <form method="POST">
        <input type="submit" name="jazz" value="Jazz Artists" class="btn btn-primary mx-3 filterbtn">
    </form>
</div>

<div class="album px-5">
    <div>
        <button class="btn btn-success mb-2" id="show-add-form">Add artist</button>
    </div>

    <!-- Add Artist Form -->
    <div id="form-add-container" style="display: none;">
        <form action="/artist/artistcms" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Insert Artist Name" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" placeholder="Insert Artist Details" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="type" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">HeaderImg:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="headerImg" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">ThumbnailImg:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="thumbnailImg" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Logo:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="logo" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Spotify (link):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="spotify" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" required>
                </div>
            </div>

            <input type="submit" name="add" value="Insert Artist" class="form-control btn btn-success mb-1">
        </form>
    </div>

    <!-- Artist List Table -->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>HeaderIMG</th>
                <th>ThumbnailIMG</th>
                <th>Logo</th>
                <th>Image</th>
                <th>Spotify</th>
                <th colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $artist): ?>
                <tr>
                    <td><?= $artist->getId() ?></td>
                    <td><?= $artist->getName() ?></td>
                    <td style="width:50%;"><?= $artist->getDescription() ?></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($artist->getHeaderImg()) ?>" width="150px"/></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($artist->getThumbnailImg()) ?>" height="100px"/></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($artist->getLogo()) ?>" width="100px"/></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($artist->getImage()) ?>" height="100px"/></td>
                    <td style="width:25%;">
                        <iframe style="border-radius:12px" src="<?= $artist->getSpotify() ?>" width="100%" height="300px" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <form action="/artist/artistcms?updateID=<?= $artist->getId() ?>" method="POST">
                            <input type="submit" name="edit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td>
                        <!-- Delete Button -->
                        <form action="/artist/artistcms?deleteID=<?= $artist->getId() ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Edit Artist Form -->
    <!-- Edit Artist Form -->
<?php if (isset($_POST["edit"]) && isset($updateArtist) && $updateArtist !== null): ?>
    <h3>Edit Artist #<?= $updateArtist->getId() ?></h3>
    <div>
        <form method="POST" enctype="multipart/form-data" action="/artist/artistcms?updateID=<?= $updateArtist->getId() ?>">
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="changedName" value="<?= $updateArtist->getName() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="changedDescription"><?= $updateArtist->getDescription() ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Type:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="changedType" value="<?= $updateArtist->getType() ?>" required>
                </div>
            </div>

            <!-- File inputs updated -->
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">HeaderImg:</label>
                <div class="col-sm-10">
                    <img src="data:image/jpeg;base64,<?= base64_encode($updateArtist->getHeaderImg()) ?>?v=<?= time(); ?>" height="100px"/>
                    <input type="file" class="form-control" name="changedHeaderImg">
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">ThumbnailImg:</label>
                <div class="col-sm-10">
                    <img src="data:image/jpeg;base64,<?= base64_encode($updateArtist->getThumbnailImg()) ?>?v=<?= time(); ?>" height="100px"/>
                    <input type="file" class="form-control" name="changedThumbnailImg">
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Logo:</label>
                <div class="col-sm-10">
                    <img src="data:image/jpeg;base64,<?= base64_encode($updateArtist->getLogo()) ?>?v=<?= time(); ?>" height="100px"/>
                    <input type="file" class="form-control" name="changedLogo">
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Spotify:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="changedSpotify" value="<?= $updateArtist->getSpotify() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <img src="data:image/jpeg;base64,<?= base64_encode($updateArtist->getImage()) ?>?v=<?= time(); ?>" height="100px"/>
                    <input type="file" class="form-control" name="changedImage">
                </div>
            </div>

            <input type="submit" name="update" value="Update Artist" class="form-control btn btn-success mb-1">
        </form>
    </div>
<?php endif; ?>


<script>
    document.getElementById('show-add-form').addEventListener('click', function () {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>

<?php include __DIR__ . '/../../footer.php'; ?>
<?php else: ?>
<div class="alert alert-danger mt-4 text-center">
    You do not have permission to access this CMS section.
</div>
<?php endif; ?>
