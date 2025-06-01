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
        <div class="container">
            <div class="section-title text-center grow-1">
                <h2>Update Venues</h2>
            </div>
            <div class="album px-5">
                <div>
                    <a href="/admin/venue/list" class="btn btn-success mb-2" id="show-add-form">View all</a>
                </div>



                <h3>Edit venue #<?= $updateVenue->getId() ?></h3>
                <div>
                    <form method="POST" enctype="multipart/form-data"
                        action="/admin/venue/update?updateID=<?php echo $updateVenue->getId(); ?>">
                        <div class="form-group row mb-3">
                            <label for="changedName" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="changedName" name="changedName"
                                    value="<?= $updateVenue->getName() ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedDescription" class="col-sm-2 col-form-label">Description:</label>
                            <div class="col-sm-10">
                                <div id="venue-description" data-description="<?= $updateVenue->getDescription() ?>"></div>
                                <input type="hidden" name="changedDescription" id="changedDescription">

                            </div>
                        </div>


                        <input type="hidden" class="form-control" id="changedType" name="changedType"
                            value="<?= $updateVenue->getType() ?>" required>

                        <div class="form-group row mb-3">
                            <label for="image1" class="col-sm-2 col-form-label">Image:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image1" name="image1">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="headerImg" name="headerImg">
                            </div>

                        </div>
                        <input type="submit" name="update" value="Update Venue" class="form-control btn btn-success mb-1">
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- script to display add form if add button was clicked -->
    <script>
        document.getElementById('show-add-form').addEventListener('click', function () {
            document.getElementById('form-add-container').style.display = 'block';
        });

        const $venueDescription = $('#venue-description');
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