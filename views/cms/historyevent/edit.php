<?php
include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
</head>

<section class="py-5 px-5">
    <div class="container">
        <div class="section-title text-center">
            <h2>History Event Update</h2>
        </div>
        <div style="min-height: 60vh">
            <div>
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="card-title mb-4">Edit Tour Guide with ID: <?= $updateHistoryEvent->getId() ?></h3>

                    <div>
                        <a href="/admin/historyevent/cms" class="btn btn-success mb-2" id="show-adding-form">View
                            History Event</a>
                    </div>
                </div>
                <div>
                    <form method="POST" enctype="multipart/form-data"
                        action="/admin/historyevent/update?updateID=<?php echo $updateHistoryEvent->getId(); ?>">
                        <div class="form-group row mb-3">
                            <label for="changedTickets_available" class="col-sm-2 col-form-label">Seats
                                Available:</label>
                            <div class="col-sm-10">


                                <input min="0" type="number" name="changedTickets_available" class="form-control"
                                    value="<?= $updateHistoryEvent->getTicketsAvailable() ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedPrice" class="col-sm-2 col-form-label">Price:</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" id="changedPrice" name="changedPrice"
                                    value="<?= $updateHistoryEvent->getPrice() ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedPrice" class="col-sm-2 col-form-label">Date Time:</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="changedDateTime"
                                    name="changedDateTime" data-date-format="dd/mm/yyyy"
                                    value="<?= $updateHistoryEvent->getDateTime() ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changedLocation" class="col-sm-2 col-form-label">Location:</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="changedLocation" name="changedLocation"  required> <?= $updateHistoryEvent->getLocation() ?> </textarea>

                                

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="changeImage" class="col-sm-2 col-form-label">Image:</label>
                            <div class="col-sm-10">


                                <img style="width:200px;height: 200px; object-fit: cover; box-shadow: 0px 3px 10px rgba(0,0,0,0.2); margin-bottom: 20px"
                                    src="/uploads/<?php echo htmlspecialchars($updateHistoryEvent->getImage()); ?>"
                                    class="card-img-top" alt="Loading image...">


                                <input type="file" class="form-control" id="changeImage" name="changeImage">
                            </div>
                        </div>



                        <div class="form-group row mb-3">
                            <label for="tourguideid" class="col-sm-2 col-form-label">TourguideID:</label>
                            <div class="col-sm-10">


                                <select required class="form-control" name="changedTourguideID" id="tourguideid">

                                    <option value="">
                                        Select tour guide
                                    </option>

                                    <?php
                                    foreach ($tourGuides as $tourguide) {
                                        ?>

                                        <option value="<?= $tourguide->getId() ?>"
                                            <?= $tourguide->getId() == $updateHistoryEvent->getTourguideID() ? 'selected' : '' ?>>
                                            <?= $tourguide->getName() ?>
                                        </option>

                                        <?php
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <input type="submit" name="update" value="Update History Event"
                            class="form-control btn btn-success mb-1">
                    </form>
                </div>

            </div>
        </div>
</section>




<script>
    document.getElementById('show-adding-form').addEventListener('click', function () {
        document.getElementById('form-add-container').style.display = 'block';
    });

    $(function () {
        $('#datepicker5').datetimepicker({
            use24hours: true
        });
    });



   

</script>
<?php include __DIR__ . '/../../footer.php'; ?>