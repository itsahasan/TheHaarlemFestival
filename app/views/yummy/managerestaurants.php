<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="/yummy/addRestaurant" role="button">Add restaurant</a>
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
                                <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/yummy/editrestaurant?restaurantid=<?php echo $restaurant->getId(); ?>'">
                                <input name="deletebtn" id="deletebtn" class="btn btn-danger" type="button" value="Delete" onclick="location='/yummy/deleterestaurant?restaurantid=<?php echo $restaurant->getId(); ?>'">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include(__DIR__ . "/../../footer.php"); ?>