<?php
include(__DIR__ . "/../../header.php");

?>

<section class="py-5 px-5" style="min-height: 60vh">
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-primary" href="/admin/yummy/addRestaurant" role="button">Add restaurant</a>
        </div>
        <div class=" card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Description</th>
                            <th scope="col">Cuisine</th>
                            <th scope="col">Seats</th>
                            <th scope="col">Stars</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phonenumber</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($restaurants as $restaurant) { ?>
                            <tr class="">
                                <td scope="row"><?php echo $restaurant->getName(); ?></td>
                                <td><?php echo $restaurant->getLocation(); ?></td>
                                <td><?php echo $restaurant->getDescription(); ?></td>
                                <td><?php echo $restaurant->getCuisine(); ?></td>
                                <td><?php echo $restaurant->getSeats(); ?></td>
                                <td><?php echo $restaurant->getStars(); ?></td>
                                <td><?php echo $restaurant->getEmail(); ?></td>
                                <td><?php echo $restaurant->getPhonenumber(); ?></td>
                                <td>
                                    <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/admin/yummy/editrestaurant?restaurantid=<?php echo $restaurant->getId(); ?>'">
                                    <button class="btn btn-danger" data-href="/admin/yummy/deleterestaurant?restaurantid=<?php echo $restaurant->getId(); ?>" data-action="delete" data-user-id="<?php echo $restaurant->getId(); ?>">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php include(__DIR__ . "/../../footer.php"); ?>