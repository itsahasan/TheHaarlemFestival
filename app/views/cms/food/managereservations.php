<?php
include(__DIR__ . "/../../header.php");
?>
<div class="card">
    <div class="card-header">

        <button class="btn btn-primary" id="showAddForm">Add reservation</button>
    </div>
    <div class="card-body">

        <div id="addReservationForm" style="display:none; margin-bottom: 1rem;">
            <form method="POST">
                <input type="hidden" name="add" value="1">
                <div class="mb-2">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="mb-2">
                    <label>Restaurant ID:</label>
                    <input type="number" name="restaurantid" required>
                </div>

                <div class="mb-2">
                    <label>Session (e.g. 4-20:00):</label>
                    <input type="text" name="session" required>
                </div>
                <div class="mb-2">
                    <label>Guests (Adult):</label>
                    <input type="number" name="formguestsadult" value="1">
                </div>
                <div class="mb-2">
                    <label>Guests (Kids):</label>
                    <input type="number" name="formguestskids" value="0">
                </div>
                <div class="mb-2">
                    <label>Date (YYYY-MM-DD):</label>
                    <input type="text" name="date" placeholder="2025-07-27">
                </div>
                <div class="mb-2">
                    <label>Request:</label>
                    <input type="text" name="request" placeholder="Allergy...">
                </div>
                <input type="submit" value="Add Reservation" class="btn btn-success">
            </form>
        </div>

        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                <tr>
                    <th>Reservation name</th>
                    <th>Restaurant</th>
                    <th>Session ID</th>
                    <th>Seats</th>
                    <th>Date</th>
                    <th>Request</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $r): ?>
                    <tr>
                        <td><?= $r->getName() ?></td>
                        <td><?= $r->getRestaurantName() ?></td>
                        <td><?= $r->getSessionID() ?></td>
                        <td><?= $r->getSeats() ?></td>
                        <td><?= $r->getDate() ?></td>
                        <td><?= $r->getRequest() ?></td>
                        <td><?= $r->getPrice() ?></td>
                        <td><?= $r->getStatus() ? "Active" : "Inactive" ?></td>
                        <td>
                            <!-- Деактивируем через GET -> /yummy/manageReservations?reservationid=... -->
                            <button class="btn btn-danger"
                                    onclick="location='/yummy/manageReservations?reservationid=<?= $r->getId() ?>'">
                                Deactivate
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('showAddForm').addEventListener('click', function() {
        document.getElementById('addReservationForm').style.display = 'block';
    });
</script>

<?php include(__DIR__ . "/../../footer.php"); ?>
