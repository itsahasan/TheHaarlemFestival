<?php
include(__DIR__ . "/../../header.php");

?>


<head>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
</head>

<section class="py-5 px-5" style="min-height: 60vh">
    <div class="container">
        <div class="card">
        <div class="card-header p-3">
            <h4 class="card-title mb-0">Adding restaurant</h4>
        </div>
        <div class="card-body">
            <form action="/admin/yummy/saveRestaurant" method="post" enctype="multipart/form-data" id="edit-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name: </label>
                    <input type="text" class="form-control" required name="name">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input type="text" class="form-control" required name="location" id="restaurants">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <!-- <input type="text" class="form-control" required name="description" id="description"> -->
                     <div id="restaurant-description"></div>
                    <input type="hidden" name="description" id="description">

                </div>
                <div class="mb-3">
                    <label for="cuisine" class="form-label">Cuisine:</label>
                    <input type="text" class="form-control" required name="cuisine" id="cuisine">
                </div>
                <div class="mb-3">
                    <label for="seats" class="form-label">Seats:</label>
                    <input type="number" min="0" class="form-control" required name="seats" id="seats" >
                </div>
                <div class="mb-3">
                    <label for="stars" class="form-label">Stars:</label>
                    <select name="stars" class="form-control ">
                        <option value="NULL" selected disabled hidden>Select amount of stars</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>            
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="phonenumber" class="form-label">Phonenumber:</label>
                    <input type="text" class="form-control" name="phonenumber" id="phonenumber">
                </div>
                <div class="mb-3">
                    <label for="image1" class="form-label">Image 1: </label>
                    <input type="file" class="" required name="image1" id="image1">
                </div>
                <div class="mb-3">
                    <label for="image1" class="form-label">Image 2: </label>
                    <input type="file" class="" required name="image2" id="image2">
                </div>
                <div class="mb-3">
                    <label for="image1" class="form-label">Image 3: </label>
                    <input type="file" class="" required name="image3" id="image3">
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a name="" id="" class="btn btn-primary" href="/admin/yummy/managerestaurants" role="button">Cancel</a>
    
            </form>
        </div>
    
    </div>
    </div>
</section>

<script>
        const $venueDescription = $('#restaurant-description');
        $venueDescription.summernote({
            placeholder: $venueDescription.attr('data-description'),
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
<?php include(__DIR__ . "/../../footer.php"); ?>