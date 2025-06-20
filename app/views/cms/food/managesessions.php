<?php include __DIR__ . '/../../header.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous">

<div class="container my-5">

    <!-- Заголовок -->
    <div class="jumbotron text-center py-5 bg-light">
        <h1 class="display-4 text-secondary">Manage Sessions</h1>
    </div>

    <!-- Кнопка добавить -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="/yummy/addSession" class="btn btn-success">Add Session</a>
        </div>
    </div>

    <!-- Таблица в центре -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Restaurant ID</th>
                        <th>Start Time</th>
                        <th>Length (hrs)</th>
                        <th>Price</th>
                        <th>Reduced Price</th>
                        <th>Available Seats</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var Session $session */ ?>
                    <?php foreach ($sessions as $session): ?>
                        <tr>
                            <td><?= htmlspecialchars($session->getId()) ?></td>
                            <td><?= htmlspecialchars($session->getRestaurantid()) ?></td>
                            <td><?= htmlspecialchars($session->getStarttime()) ?></td>
                            <td><?= htmlspecialchars($session->getSession_length()) ?></td>
                            <td><?= htmlspecialchars($session->getPrice()) ?></td>
                            <td><?= htmlspecialchars($session->getReducedprice()) ?></td>
                            <td><?= htmlspecialchars($session->getAvailable_seats()) ?></td>
                            <td class="pr-0">
                                <form method="GET" action="/yummy/editSession">
                                    <input type="hidden" name="sessionid" value="<?= htmlspecialchars($session->getId()) ?>">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </form>
                            </td>
                            <td class="pl-0">
                                <form method="POST" action="/yummy/deleteSession"
                                      onsubmit="return confirm('Are you sure you want to delete this session?');">
                                    <input type="hidden" name="delete_session_id" value="<?= htmlspecialchars($session->getId()) ?>">
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
