<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        Editing Session data for restaurant: <?= $session->getRestaurantname() ?>
    </div>
    <div class="card-body">
        <form action="/yummy/saveSession" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="mb-3">
                <label for="id" class="form-label">Id: <?php echo $session->getId(); ?></label>
                <input type="hidden" name="id" value="<?php echo $session->getId(); ?>">
            </div>
            <div class="mb-3">
                <label for="restaurantid" class="form-label">Restaurant Id: <?php echo $session->getRestaurantid(); ?></label>
                <input type="hidden" name="restaurantid" value="<?php echo $session->getRestaurantid(); ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price (€):</label>
                <input type="text" class="form-control" name="price" id="price" value="<?php echo $session->getPrice(); ?>">
            </div>
            <div class="mb-3">
                <label for="reducedprice" class="form-label">Reduced price:</label>
                <input type="text" class="form-control" name="reducedprice" id="reducedprice" value="<?php echo $session->getReducedprice(); ?>">
            </div>
            <div class="mb-3">
                <label for="starttime" class="form-label">Start time:</label>
                <input type="time" class="form-control" name="starttime" id="starttime" value="<?php echo $session->getStarttime(); ?>">
            </div>
            <div class="mb-3">
                <label for="length" class="form-label">Session length (in hours):</label>
                <input type="text" class="form-control" name="length" id="length" value="<?php echo $session->getSession_length(); ?>">
            </div>
            <div class="mb-3">
                <label for="seats" class="form-label">Available seats:</label>
                <input type="text" class="form-control" name="seats" id="seats" value="<?php echo $session->getAvailable_seats(); ?>">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a name="" id="" class="btn btn-primary" href="/yummy/manageSessions" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>