<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
<?php
include __DIR__ . '/../../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<section class="py-5 px-5">
    <div class="d-flex justify-content-between w-100 px-5">
        <div class="section-title text-center grow-1">
            <h2>Manage Events</h2>
        </div>
        <div class="center d-flex justify-content-start my-3">
            <form method="POST">
                <input type="submit" name="dance" value="Dance Events" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST">
                <input type="submit" name="jazz" value="Jazz Events" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
        </div>
    </div>

    <div class="album px-5">
        <div>
            <a href="<?php echo $createUrl ?>" class="btn btn-success mb-2">Add event</a>
        </div>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Ticket Price</th>
                    <th scope="col">Tickets Available</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($model as $event) {
                    $date_string = $event->getDatetime();
                    $date = new DateTime($date_string);
                    $formated = $date->format("l, j F Y h:i A");
                ?>
                    <tr>
                        <td><?= $event->getId() ?></td>
                        <td style="width:30%;"><?= $event->getName() ?></td>
                        <td style="width:20%;"><?= $event->getVenue() ?></td>
                        <td>&euro; <?= $event->getTicket_price() ?></td>
                        <td><?= $event->getTickets_available() ?> st.</td>
                        <td><?php echo $formated; ?></td>
                        <td>                                
                            <img  height="100px" src="/uploads/<?php echo htmlspecialchars($event->getImage()); ?>"  class="card-img-top" alt="Loading image...">

                        </td>
                        <td style="width:2%;">
                        
                            <a class="btn btn-warning" href="/admin/event/edit?updateID=<?php echo $event->getId(); ?>">Edit</a>


                        </td>
                        <td style="width:2%;">
                            <button class="btn btn-danger" data-href="/admin/event/delete?deleteID=<?php echo $event->getId(); ?>" data-action="delete" data-user-id="<?php echo $event->getId(); ?>">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>


<script>
    document.getElementById('show-add-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>

<?php
include __DIR__ . '/../../footer.php';
?>
<?php else: ?>
<div class="alert alert-danger mt-4 text-center">
    You do not have permission to access this CMS section.
</div>
<?php endif; ?>
