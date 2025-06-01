<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php
    include __DIR__ . '/../../header.php';
    ?>

    <head>
        <link rel="stylesheet" href="/css/music_cms_style.css">

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
    </head>



    <section class="py-5">
        <div class="section-title text-center grow-1">
            <h2>Edit Artists</h2>
        </div>
        <div class="container">
            <div class="album px-5">
                <div>
                    <a href="/admin/artist/list" class="btn btn-success mb-2">View all</a>
                </div>
                <h3>Update <?php echo $updateArtist->getType() ?> artist #<?= $updateArtist->getId() ?></h3>
                <div>
                    <form method="POST" enctype="multipart/form-data"
                        action="/admin/artist/update?updateID=<?php echo $updateArtist->getId(); ?>">
                        <div class="form-group row mb-3">
                            <label for="changedName" class="col-sm-3 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="changedName" name="changedName"
                                    value="<?= $updateArtist->getName() ?>" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="changedDescription" class="col-sm-3 col-form-label">Description:</label>
                            <div class="col-sm-9">
                                <div id="artists-description" data-description='<?= $updateArtist->getDescription() ?>'>
                                </div>
                                <input type="hidden" name="changedDescription" id="changedDescription">
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="changedType" name="changedType"
                            value="<?= $updateArtist->getType() ?>" required>
                        <div class="form-group row mb-3">
                            <label for="changedHeaderImg" class="col-sm-3 col-form-label">HeaderImg:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="changedHeaderImg" name="headerImg">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedThumbnailImg" class="col-sm-3 col-form-label">ThumbnailImg:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="changedThumbnailImg" name="thumbnailImg">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedLogo" class="col-sm-3 col-form-label">Logo:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="changedLogo" name="logo">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedSpotify" class="col-sm-3 col-form-label">Spotify:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="changedSpotify" name="changedSpotify"
                                    value="<?= $updateArtist->getSpotify() ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedImage" class="col-sm-3 col-form-label">Image:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="changedImage" name="image">
                            </div>
                        </div>
                        <input type="submit" name="update" value="Update Artist" class="form-control btn btn-success mb-1">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>



        const $venueDescription = $('#artists-description');
        $venueDescription.summernote({
            placeholder: $venueDescription.attr('data-description'),
            tabsize: 2,
            height: 100,
            callbacks: {
                // Update hidden input whenever Summernote content changes
                onChange: function (contents) {
                    $('#changedDescription').val(contents);
                }
            }
        });

        // Set initial content in Summernote and hidden input
        var initialContent = $venueDescription.attr('data-description');
        $venueDescription.summernote('code', initialContent);
        $('#changedDescription').val(initialContent);

    </script>

    <?php
    include __DIR__ . '/../../footer.php';
?>
<?php else: ?>
    <div class="alert alert-danger mt-4 text-center">
        You do not have permission to access this CMS section.
    </div>
<?php endif; ?>