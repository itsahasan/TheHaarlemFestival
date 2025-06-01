<?php
include(__DIR__ . "/../../header.php");

?>
<section class="py-5" style="min-height: 60vh">
    <div class="container">
        <div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="/admin/yummy/addSession" role="button">Add session</a>
    </div>
    <div class=" card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Price (€)</th>
                        <th scope="col">Reduced price (€)</th>
                        <th scope="col">Start time</th>
                        <th scope="col">Session length (in hours)</th>
                        <th scope="col">Available seats</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sessions as $session) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $session->getRestaurantname(); ?></td>
                            <td><?php echo $session->getPrice(); ?></td>
                            <td><?php echo $session->getReducedprice(); ?></td>
                            <td><?php echo $session->getStarttime(); ?></td>
                            <td><?php echo $session->getSession_length(); ?></td>
                            <td><?php echo $session->getAvailable_seats(); ?></td>
                            <td>
                                <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/admin/yummy/editsession?sessionid=<?php echo $session->getId(); ?>'">


                                <button class="btn btn-danger" data-href="/admin/yummy/deleteSession?sessionid=<?php echo $session->getId(); ?>" data-action="delete" data-user-id="<?php echo $session->getId(); ?>">Delete</button>


                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</section>


<?php include(__DIR__ . "/../../footer.php"); ?>