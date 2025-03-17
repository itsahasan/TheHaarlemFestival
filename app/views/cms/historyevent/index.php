<?php
include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<div class="bg-light p-5 rounded-lg" style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: gray;">History Event CMS</h1>
</div>


<div class="px-4">
    <div>
        <button class="btn btn-success mb-2" id="show-adding-form">Add History Event</button>
    </div>


    <!-- Creating the Insert Functionality -->
    <div id="form-add-container" style="display: none;">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-1">
                <label for="ticketsavailable" class="col-sm-2 col-form-label">Seats Available:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ticketsavailable" name="ticketsavailable" placeholder="Insert History Event Seats" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="price" name="price" placeholder="Insert History Event Price" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="datetime" class="col-sm-2 col-form-label">Datetime:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control datepicker" id="datetime" name="datetime" data-date-format="dd/mm/yyyy" placeholder="Insert History Event Datetime" required></input>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="location" class="col-sm-2 col-form-label">Location:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="location" name="location" placeholder="Insert History Event Location" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="image" class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="tourguideid" class="col-sm-2 col-form-label">TourguideID:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="tourguideid" name="tourguideid" placeholder="Insert History Event Tourguide ID" required></textarea>
                </div>
            </div>
            <input type="submit" name="add" value="Insert History Event" class="form-control btn btn-success mb-1">
        </form>
    </div>

    <!-- Creating Table for displaying and being able to edit or delete Tour guides. -->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Seats Available</th>
                <th scope="col">Price</th>
                <th scope="col">Date Time</th>
                <th scope="col">Location</th>
                <th scope="col">Image</th>
                <th scope="col">Tourguide ID</th>
                <th scope="col" colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $historyevent) {
            ?>
                <tr>
                    <td><?= $historyevent->getId() ?></td>
                    <td style="width: 2%;"><?= $historyevent->getTicketsAvailable() ?></td>
                    <td style="width: 2%;"><?= $historyevent->getPrice() ?></td>
                    <td style="width: 2%;"><?= $historyevent->getDateTime() ?></td>
                    <td style="width: 2%;"><?= $historyevent->getLocation() ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($historyevent->getImage()) . '"  height="100px"/>'; ?></td>
                    <td style="width: 2%;"><?= $historyevent->getTourguideID() ?></td>
                    <td style="width: 2%">
                        <form action="/historyevent/cms?updateID=<?= $historyevent->getId() ?>" method="POST">
                            <input type="hidden" name="edit" value="<?= $historyevent->getId() ?>">
                            <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td style="width: 2%">
                        <form action="/historyevent/cms?deleteID=<?= $historyevent->getId() ?>" method="POST">
                            <input type="hidden" name="delete" onclick="" value="<?= $historyevent->getId() ?>">
                            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Updating Tour guide -->
    <?php
    if (isset($_POST["edit"])) {
    ?>
        <h3>Edit Tour Guide with ID: <?= $updateHistoryEvent->getId() ?></h3>
        <div>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row mb-1">
                    <label for="changedTickets_available" class="col-sm-2 col-form-label">Seats Available:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="changedTickets_available" id="changedTickets_available"><?= $updateHistoryEvent->getTicketsAvailable() ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedPrice" class="col-sm-2 col-form-label">Price:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedPrice" name="changedPrice" value="<?= $updateHistoryEvent->getPrice() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedPrice" class="col-sm-2 col-form-label">Date Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="changedDateTime" name="changedDateTime" data-date-format="dd/mm/yyyy" value="<?= $updateHistoryEvent->getDateTime() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedLocation" class="col-sm-2 col-form-label">Location:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedLocation" name="changedLocation" value="<?= $updateHistoryEvent->getLocation() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changeImage" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateHistoryEvent->getImage()) . '" height="100px"/>'; ?>
                        <input type="file" class="form-control" id="changeImage" name="changeImage" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedTourguideID" class="col-sm-2 col-form-label">Tour Guide ID:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedTourguideID" name="changedTourguideID" value="<?= $updateHistoryEvent->getTourguideID() ?>" required>
                    </div>
                </div>
                <input type="submit" name="update" value="Update History Event" class="form-control btn btn-success mb-1">
            </form>
        </div>
    <?php
    }
    ?>
</div>

<script>
    document.getElementById('show-adding-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });

    $(function (){
        $('#datepicker5').datetimepicker({
            use24hours: true
        });
    }); 
</script>
<?php include __DIR__ . '/../../footer.php'; ?>