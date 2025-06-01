<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<section class="py-5">
    <div class="container">
        <div class="section-title text-center grow-1">
            <h2>Create Events</h2>
        </div>
        <div class="album px-5">
        <div>
            <a href="/admin/event/list" class="btn btn-success mb-2">View all</a>
        </div>
        <div id="form-add-container" >
            <form method="POST" id="addEvent" action="/admin/event/store" enctype="multipart/form-data" >
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
                    <label for="artistName" class="col-sm-2 col-form-label">Artist:</label>
                    <div class="col-sm-10">
                        <select name="artistName" id="artistName" class="form-control" form="addEvent" required>

                            <option value="">
                                Select artist
                            </option>

                            <?php
                            foreach ($artists as $artist) {
                            ?>
                                <option value="<?= $artist->getId() ?>"><?= $artist->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="venueName" class="col-sm-2 col-form-label">Venue:</label>
                    <div class="col-sm-10">
                        <select name="venueName" id="venueName" class="form-control" form="addEvent" required>

                            <option value="">
                                Select venue
                            </option>
                            <?php
                            foreach ($venues as $venue) {
                            ?>
                                <option value="<?= $venue->getId() ?>"><?= $venue->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Insert Ticket Price" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="stock" class="col-sm-2 col-form-label">Tickets Available:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Insert amount of tickets available" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" placeholder="Insert datetime" required>
                    </div>
                </div>


                <div class="form-group row mb-3">
                    <label for="thumbnailImg" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                </div>

                <input type="submit" name="add" value="Insert Event" class="form-control btn btn-success mb-1">
            </form>
        </div>
    </div>
    </div>
</section>





<?php
include __DIR__ . '/../../footer.php';
?>
<?php else: ?>
<div class="alert alert-danger mt-4 text-center">
    You do not have permission to access this CMS section.
</div>
<?php endif; ?>
