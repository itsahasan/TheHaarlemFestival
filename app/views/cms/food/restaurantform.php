<div class="form-group row mb-1">
    <label for="name" class="col-sm-2 col-form-label">Name:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getName() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="location" class="col-sm-2 col-form-label">Location:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="location" name="location" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getLocation() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="cuisine" class="col-sm-2 col-form-label">Cuisine:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="cuisine" name="cuisine" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getCuisine() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="seats" class="col-sm-2 col-form-label">Seats:</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="seats" name="seats" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getSeats() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="stars" class="col-sm-2 col-form-label">Stars:</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="stars" name="stars" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getStars() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="email" class="col-sm-2 col-form-label">Email:</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getEmail() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="phonenumber" class="col-sm-2 col-form-label">Phone Number:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getPhonenumber() : '' ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="price" class="col-sm-2 col-form-label">Price:</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="price" name="price" value="<?= isset($restaurantToEdit) ? $restaurantToEdit->getPrice() : 0 ?>" required>
    </div>
</div>
<div class="form-group row mb-1">
    <label for="description" class="col-sm-2 col-form-label">Description:</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" required><?= isset($restaurantToEdit) ? $restaurantToEdit->getDescription() : '' ?></textarea>
    </div>
</div>
<?php for ($i = 1; $i <= 3; $i++): ?>
    <div class="form-group row mb-1">
        <label for="image<?= $i ?>" class="col-sm-2 col-form-label">Image <?= $i ?>:</label>
        <div class="col-sm-10">
            <?php if (isset($restaurantToEdit)): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($restaurantToEdit->{'getImage' . $i}()) ?>" height="100" class="mb-2">
            <?php endif; ?>
            <input type="file" class="form-control" id="image<?= $i ?>" name="image<?= $i ?>">
        </div>
    </div>
<?php endfor; ?>
