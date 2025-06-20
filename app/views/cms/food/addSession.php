<?php include __DIR__ . '/../../header.php'; ?>

<div class="container my-5">
    <div class="jumbotron text-center bg-light py-4 mb-4">
        <h2 class="display-5 text-secondary">Add New Session</h2>
    </div>

    <form method="POST" action="/yummy/saveSession">
        <div class="form-group row">
            <label for="restaurantid" class="col-sm-2 col-form-label">Restaurant</label>
            <div class="col-sm-10">
                <select name="restaurantid" id="restaurantid" class="form-control" required>
                    <option value="">— Select Restaurant —</option>
                    <?php foreach ($restaurants as $r): ?>
                        <option value="<?= htmlspecialchars($r['id']) ?>">
                            <?= htmlspecialchars($r['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="starttime" class="col-sm-2 col-form-label">Start Time</label>
            <div class="col-sm-10">
                <input type="time" class="form-control" id="starttime" name="starttime" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="length" class="col-sm-2 col-form-label">Length (hrs)</label>
            <div class="col-sm-10">
                <input type="number" step="0.1" class="form-control" id="length" name="length" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="reducedprice" class="col-sm-2 col-form-label">Reduced Price</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" id="reducedprice" name="reducedprice" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="seats" class="col-sm-2 col-form-label">Available Seats</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="seats" name="seats" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Create Session</button>
                <a href="/yummy/manageSessions" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../footer.php'; ?>
