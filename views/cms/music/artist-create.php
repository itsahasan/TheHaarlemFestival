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
        <h2>Create Artists</h2>
    </div>
    <div class="container">
        
        <div class="album px-5">
            <div>
                <a href="/admin/artist/list" class="btn btn-success mb-2">View all</a>
            </div>
            <div id="form-add-container" >
                <form action="/admin/artist/store" method="POST" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Insert Artist Name" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Description:</label>
                        <div class="col-sm-9">
                            <div id="artists-description" ></div>
                            <input type="hidden" name="changedDescription" id="changedDescription">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                        <div class="col-sm-10">

                            <select class="form-control" name="type" id="type" required>

                                <option >
                                    Select type
                                </option>
                                <option     <?= $type == 'dance' ? 'selected' : '' ?> value="dance">
                                    Dance
                                </option>
                                <option <?= $type == 'jazz' ? 'selected' : '' ?> value="jazz">
                                Jazz
                                </option>
                            </select>


                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="headerImg" name="headerImg" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="thumbnailImg" class="col-sm-2 col-form-label">ThumbnailImg:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="thumbnailImg" name="thumbnailImg" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="logo" class="col-sm-2 col-form-label">Logo:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="logo" name="logo" required>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label for="spotify" class="col-sm-2 col-form-label">Spotify (link):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="spotify" name="spotify" placeholder="Insert Spotify embedded song link" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                    </div>

                    <input type="submit" name="add" value="Insert Artist" class="form-control btn btn-success mb-1">
                </form>
            </div>
        </div>
    </div>
</section>

<script>

    const $venueDescription = $('#artists-description');
    $venueDescription.summernote({
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
