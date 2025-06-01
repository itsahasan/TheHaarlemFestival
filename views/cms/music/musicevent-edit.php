<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<h1 class="text-center mb-3">Update Events</h1>


<div class="album px-5">




    <div>
        <a href="/admin/event/list" class="btn btn-success mb-2">View all</a>
    </div>

    <h3>Edit event #<?= $updateEvent->getId() ?></h3>
    <div>
        <form method="POST" enctype="multipart/form-data"  action="/admin/event/update?updateID=<?php echo $updateEvent->getId(); ?>" >
            
            <input type="hidden" class="form-control" id="updatedType" name="updatedType" value="<?= $updateEvent->getType() ?>" required>

            <div class="form-group row mb-1">
                <label for="" class="col-sm-2 col-form-label">Previous artist:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $updateEvent->getName() ?>" disabled>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="updatedArtistName" class="col-sm-2 col-form-label">Select new artist:</label>
                <div class="col-sm-10">
                    <select name="updatedArtistName" id="updatedArtistName" class="form-control" required>
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
            <div class="form-group row mb-1">
                <label for="" class="col-sm-2 col-form-label">Previous venue:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $updateEvent->getVenue() ?>" disabled>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="updatedVenueName" class="col-sm-2 col-form-label">Select new venue:</label>
                <div class="col-sm-10">
                    <select name="updatedVenueName" id="updatedVenueName" class="form-control" required>
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
            <div class="form-group row mb-1">
                <label for="updatedPrice" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="updatedPrice" name="updatedPrice" value="<?= $updateEvent->getTicket_price() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="updatedStock" class="col-sm-2 col-form-label">Tickets Available:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="updatedStock" name="updatedStock" value="<?= $updateEvent->getTickets_available() ?>" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="" class="col-sm-2 col-form-label">Previous datetime:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php
                                                                    $date_string = $updateEvent->getDatetime();
                                                                    $date = new DateTime($date_string);
                                                                    echo $date->format("l, j F Y h:i A");
                                                                    ?>" disabled>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="updatedDatetime" class="col-sm-2 col-form-label">New datetime:</label>
                <div class="col-sm-10">
                    <input type="datetime" value="<?php echo  $updateEvent->getDatetime() ?>" class="form-control" id="updatedDatetime" name="updatedDatetime" required>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for="thumbnailImg" class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" >
                </div>
            </div>

            <input type="submit" name="update" value="Update Event" class="form-control btn btn-success mb-1">
        </form>
    </div>

</div>

<?php
include __DIR__ . '/../../footer.php';
?>
<?php else: ?>
<div class="alert alert-danger mt-4 text-center">
    You do not have permission to access this CMS section.
</div>
<?php endif; ?>
