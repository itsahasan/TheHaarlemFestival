<?php include __DIR__ . '/../../header.php'; ?>

<div class="container my-5">
    <div class="jumbotron text-center bg-light py-4 mb-4">
        <h2 class="display-4 text-secondary">Manage Reservations</h2>
    </div>

    <div class="row mb-3">
        <div class="col text-center">
            <a href="/yummy/addReservationAdmin" class="btn btn-success">Add Reservation</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Restaurant</th>
                        <th>Session</th>
                        <th>Seats</th>
                        <th>Date</th>
                        <th>Request</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var Reservation $res */ ?>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$res->getId()) ?></td>
                            <td><?= htmlspecialchars($res->getName()) ?></td>
                            <td><?= htmlspecialchars((string)$res->getRestaurantID()) ?></td>
                            <td><?= htmlspecialchars((string)$res->getSessionID()) ?></td>
                            <td><?= htmlspecialchars((string)$res->getSeats()) ?></td>
                            <td><?= htmlspecialchars($res->getDate()) ?></td>
                            <td><?= htmlspecialchars($res->getRequest()) ?></td>
                            <td><?= htmlspecialchars((string)$res->getPrice()) ?></td>
                            <td><?= $res->getStatus() ? 'Active' : 'Cancelled' ?></td>
                            <td class="pr-0">
                                <form method="GET" action="/yummy/editReservationAdmin">
                                    <input type="hidden" name="reservationid" value="<?= htmlspecialchars((string)$res->getId()) ?>">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                            </td>
                            <td class="pl-0">
                                <form method="POST" action="/yummy/deleteReservationAdmin"
                                      onsubmit="return confirm('Delete reservation #<?= htmlspecialchars((string)$res->getId()) ?>?');">
                                    <input type="hidden" name="delete_reservation_id" value="<?= htmlspecialchars((string)$res->getId()) ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../footer.php'; ?>
