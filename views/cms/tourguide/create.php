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
    <div style="min-height: 60vh">
        <div>
            <a href="/admin/tourguide/list" class="btn btn-success mb-2" id="show-adding-form">View all</a>
        </div>
    
    
        <!-- Creating the Insert Functionality -->
        <div id="form-add-container" >
            <form method="POST" enctype="multipart/form-data" action="/admin/tourguide/store"  >
                <div class="form-group row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert Tour Guide Name" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <!-- <textarea class="form-control" id="description" name="description" placeholder="Insert Tour Guide Details" required></textarea> -->
                         <div id="guide-description" ></div>
                        <input type="hidden" name="description" id="description">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                </div>
                <input type="submit" name="add" value="Insert Tour Guide" class="form-control btn btn-success mb-1">
            </form>
        </div>
     
    </div>
    </div>
</section>    


<script>
    document.getElementById('show-adding-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });


    const $venueDescription = $('#guide-description');
        $venueDescription.summernote({
            tabsize: 2,
            height: 100,
            callbacks: {
                // Update hidden input whenever Summernote content changes
                onChange: function (contents) {
                    $('#description').val(contents);
                }
            }
        });

        // Set initial content in Summernote and hidden input
        var initialContent = $venueDescription.attr('data-description');
        $venueDescription.summernote('code', initialContent);
        $('#description').val(initialContent);
</script>
<?php include __DIR__ . '/../../footer.php'; ?>