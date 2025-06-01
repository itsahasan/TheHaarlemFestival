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
        <h2>Create Venues</h2>
    </div>
    
    <div class="album px-5">
        <div id="form-add-container">
            <form action="/admin/venue/store" method="POST" enctype="multipart/form-data">
                <div class="form-group row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert Venue Name" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-9">
                          <div id="venue-description" ></div>
                         <input type="hidden" name="description" id="changedDescription">
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
                    <label for="image1" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image1" name="image1" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="headerImg" class="col-sm-2 col-form-label">HeaderImg:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="headerImg" name="headerImg" placeholder="Insert image id..." required>
                    </div>
                </div>
    
                <input type="submit" name="add" value="Insert Venue" class="form-control btn btn-success mb-1">
            </form>
        </div>
    
    
    
    </div>
</section>

<script>

    const $venueDescription = $('#venue-description');
    $venueDescription.summernote({
        tabsize: 2,
        height: 100,
        callbacks: {
            onChange: function (contents) {
                $('#changedDescription').val(contents);
            }
        }
    });

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
