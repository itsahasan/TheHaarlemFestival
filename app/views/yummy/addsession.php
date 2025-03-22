<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        Adding Session
    </div>
    <div class="card-body">
        <form action="/yummy/saveSession" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="form-field mb-3">
                <label for="restaurantid" class="form-label">Restaurant: </label>
                <select name="restaurantid">
                    <?php
                    foreach ($restaurants as $restaurant) { 
                    ?>
                    <option value="<?= $restaurant->getId() ?>"><?= $restaurant->getName() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price (€):</label>
                <input type="text" class="form-control" required name="price" id="price">
            </div>
            <div class="mb-3">
                <label for="reducedprice" class="form-label">Reduced price:</label>
                <input type="text" class="form-control" required name="reducedprice" id="reducedprice">
            </div>
            <div class="mb-3">
                <label for="starttime" class="form-label">Start time:</label>
                <input type="time" class="form-control" required name="starttime" id="firstsession">
            </div>
            <div class="mb-3">
                <label for="length" class="form-label">Session length (in hours):</label>
                <input type="text" class="form-control" required name="length" id="length">
            </div>
            <div class="mb-3">
                <label for="seats" class="form-label">Seats:</label>
                <input type="text" class="form-control" required name="seats" id="seats">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <a name="" id="" class="btn btn-primary" href="/yummy/manageSessions" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>