<?php
include(__DIR__ . "/../../header.php");

?>
<section class="py-5 px-5">
    <div class="card">
    
    <div class=" card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Reservation name</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Session ID</th>
                        <th scope="col">Seats</th>
                        <th scope="col">Date and time</th>
                        <th scope="col">Special request(s)</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reservations as $reservation) {
                        ?>    
                        <tr class="">
                            <td scope="row"><?php echo $reservation->getName(); ?></td>
                            <td><?php echo $reservation->getRestaurantName(); ?></td>
                            <td><?php echo $reservation->getSessionID(); ?></td>
                            <td><?php echo $reservation->getSeats(); ?></td>
                            <td><?php echo $reservation->getDate(); ?></td>
                            <td><?php echo $reservation->getRequest(); ?></td>
                            <td><?php echo $reservation->getPrice(); ?></td>
                            <td><?php 
                            if ( $reservation->getStatus() )
                                echo "Active";
                            else
                                echo "Inactive" ;
                            ?></td>
                            <td>
                                <input name="deactivatebtn" id="deactivatebtn" class="btn btn-danger" type="button" value="Deactivate" onclick="location='/yummy/deactivatereservation?reservationid=<?php echo $reservation->getId(); ?>'">
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</section>


<?php include(__DIR__ . "/../../footer.php"); ?>