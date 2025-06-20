<?php include __DIR__ . '/../../header.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous">

<div class="bg-light p-5 rounded-lg" style="height: 300px; text-align:center; display:table; width:100%; background-size: cover; background-position: bottom;">
    <h1 class="display-4" style="font-size: 110px; text-align: center; display: table-cell; vertical-align: middle; color: gray;">
        Manage Restaurants
    </h1>
</div>

<div class="px-4">

    <div>
        <button class="btn btn-success mb-2" id="show-adding-form">Add Restaurant</button>
    </div>

    <div id="form-add-container" style="display: none;">
        <form method="POST" action="/yummy/saveRestaurant" enctype="multipart/form-data">
            <?php include __DIR__ . '/restaurantform.php'; ?>
            <input type="submit" name="add" value="Insert Restaurant" class="form-control btn btn-success mb-1">
        </form>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Location</th><th>Cuisine</th><th>Seats</th><th>Stars</th>
            <th>Email</th><th>Phone</th><th>Price</th>
            <th>Image1</th><th>Image2</th><th>Image3</th>
            <th colspan="2" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($restaurants as $restaurant): ?>
            <tr>
                <td><?= htmlspecialchars($restaurant->getId()) ?></td>
                <td><?= htmlspecialchars($restaurant->getName()) ?></td>
                <td><?= htmlspecialchars($restaurant->getLocation()) ?></td>
                <td><?= htmlspecialchars($restaurant->getCuisine()) ?></td>
                <td><?= htmlspecialchars($restaurant->getSeats()) ?></td>
                <td><?= htmlspecialchars($restaurant->getStars()) ?></td>
                <td><?= htmlspecialchars($restaurant->getEmail()) ?></td>
                <td><?= htmlspecialchars($restaurant->getPhonenumber()) ?></td>
                <td><?= htmlspecialchars($restaurant->getPrice()) ?></td>
                <td>
                    <img src="data:image/jpeg;base64,<?= base64_encode($restaurant->getImage1Data() ?? $restaurant->getImage1()) ?>" height="100">
                </td>
                <td>
                    <img src="data:image/jpeg;base64,<?= base64_encode($restaurant->getImage2Data() ?? $restaurant->getImage2()) ?>" height="100">
                </td>
                <td>
                    <img src="data:image/jpeg;base64,<?= base64_encode($restaurant->getImage3Data() ?? $restaurant->getImage3()) ?>" height="100">
                </td>
                <td>
                    <!-- Show edit form -->
                    <form method="POST" action="/yummy/manageRestaurants">
                        <input type="hidden" name="edit" value="<?= htmlspecialchars($restaurant->getId()) ?>">
                        <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                    </form>
                </td>
                <td>
                    <!-- Delete -->
                    <form method="POST" action="/yummy/deleteRestaurant"
                          onsubmit="return confirm('Are you sure you want to delete this restaurant?');">
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($restaurant->getId()) ?>">
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (isset($_POST['edit']) && $restaurantToEdit): ?>
        <h3>Edit Restaurant ID: <?= htmlspecialchars($restaurantToEdit->getId()) ?></h3>
        <form method="POST" action="/yummy/saveRestaurant" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($restaurantToEdit->getId()) ?>">
            <?php include __DIR__ . '/restaurantform.php'; ?>
            <input type="submit" name="update" value="Update Restaurant" class="form-control btn btn-success mb-1">
        </form>
    <?php endif; ?>

</div>

<script>
    document.getElementById('show-adding-form')
        .addEventListener('click', () => {
            document.getElementById('form-add-container').style.display = 'block';
        });
</script>

<?php include __DIR__ . '/../../footer.php'; ?>
