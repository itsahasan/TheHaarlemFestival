<?php include __DIR__ . '/../../header.php'; ?>

<div class="container my-5">
    <div class="jumbotron text-center bg-light py-4 mb-4">
        <h2 class="display-5 text-secondary">Add Reservation</h2>
    </div>

    <form method="POST" action="/yummy/saveReservationAdmin">
        <!-- на случай, если контроллер ожидает id (будет пустым для новой записи) -->
        <input type="hidden" name="id" value="">

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Guest Name</label>
            <div class="col-sm-10">
                <input name="name" id="name" type="text" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="restaurantid" class="col-sm-2 col-form-label">Restaurant</label>
            <div class="col-sm-10">
                <select name="restaurantid" id="restaurantid" class="form-control" required>
                    <option value="">– Select –</option>
                    <?php foreach ($restaurants as $r): ?>
                        <option value="<?= htmlspecialchars($r['id']) ?>">
                            <?= htmlspecialchars($r['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="sessionid" class="col-sm-2 col-form-label">Session</label>
            <div class="col-sm-10">
                <select name="sessionid" id="sessionid" class="form-control" required>
                    <option value="">– Select –</option>
                    <?php foreach ($sessions as $s): ?>
                        <option value="<?= htmlspecialchars((string)$s->getId()) ?>">
                            <?= htmlspecialchars($s->getStarttime()) ?>
                            (<?= htmlspecialchars((string)$s->getAvailable_seats()) ?> seats)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="seats" class="col-sm-2 col-form-label">Seats</label>
            <div class="col-sm-10">
                <input name="seats" id="seats" type="number" class="form-control" min="1" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date &amp; Time</label>
            <div class="col-sm-10">
                <input name="date" id="date" type="datetime-local" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="request" class="col-sm-2 col-form-label">Request</label>
            <div class="col-sm-10">
                <textarea name="request" id="request" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input name="price" id="price" type="number" step="0.01" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Active</label>
            <div class="col-sm-10">
                <input name="status" id="status" type="checkbox" checked>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Create Reservation</button>
                <a href="/yummy/manageReservations" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../footer.php'; ?>
