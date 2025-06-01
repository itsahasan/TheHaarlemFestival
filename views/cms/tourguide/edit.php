<?php
include __DIR__ . '/../../header.php';

?>

<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
</head>


<section class="py-5 px-5">
    <div class="container">
        <div class="section-title text-center grow-1">
        <h2>Tour Guide CMS</h2>
    </div>
    <div class="px-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Edit Tour Guide with ID: <?= $updateTourguide->getId() ?></h4>
        <div>
            <a href="/admin/tourguide/list" class="btn btn-success mb-2" id="show-adding-form">View all</a>
        </div>
        </div>
        <div>
            <form method="POST" enctype="multipart/form-data" action="/admin/tourguide/update?updateID=<?php echo $updateTourguide->getId(); ?>">
                <div class="form-group row mb-3">
                    <label for="changedName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedName" name="changedName" value="<?= $updateTourguide->getName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedDescription" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <!-- <textarea class="form-control" name="changedDescription" id="changedDescription"></textarea> -->
                         <div id="guide-description" data-description='<?= $updateTourguide->getDescription() ?>'></div>
                        <input type="hidden" name="changedDescription" id="changedDescription">

                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changeImage" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">

                        <img  style="width:160px; height: 90px; object-fit:cover;margin-bottom:10px" src="/uploads/<?php echo htmlspecialchars($updateTourguide->getImage()); ?>"  class="card-img-top" alt="Loading image...">



                        <input type="file" class="form-control" id="changeImage" name="changeImage" >
                    </div>
                </div>
                <input type="submit" name="update" value="Update Tour Guide" class="form-control btn btn-success mb-1">
            </form>
        </div>
    </div>
    </div>
</section>

<script>

      const $venueDescription = $('#guide-description');
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

<?php include __DIR__ . '/../../footer.php'; ?>