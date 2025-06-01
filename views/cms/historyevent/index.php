<?php
 include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<section class="py-5 px-5" style="min-height: 60vh">
    <div>
        <div class="section-title text-center grow-1">
            <h2>History Event CMS</h2>
        </div>
        <div>
            <div>
                <a class="btn btn-success mb-2"  href="/admin/historyevent/create">Add History Event</a>
            </div>
        
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Seats Available</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Image</th>
                        <th scope="col">Tourguide ID</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($model as $historyevent) {
                    ?>
                        <tr>
                            <td style="width: 8%;"><?= $historyevent->getId() ?></td>
                            <td style="width: 8%;"><?= $historyevent->getTicketsAvailable() ?></td>
                            <td style="width: 8%;"><?= $historyevent->getPrice() ?></td>
                            <td style="width: 8%;"><?= $historyevent->getDateTime() ?></td>
                            <td style="width: 8%;"><?= $historyevent->getLocation() ?></td>
                            <td>
                                <img  style="width:120px;height: 60px; object-fit;box-shadow: 0px 3px 10px rgba(0,0,0,0.2)" src="/uploads/<?php echo htmlspecialchars($historyevent->getImage()); ?>"  class="card-img-top" alt="Loading image...">
                            </td>
        
                            
                            <td style="width: 8%;"><?= $historyevent->getTourguideID() ?></td>
                            <!-- <td style="width: 8%">
                            
                            </td> -->
                            <td style="width: 8%">

                            <div class="d-flex justify-content-start">
                                <a class="btn btn-warning mr-2" href="/admin/historyevent/edit?updateID=<?php echo $historyevent->getId(); ?>">Edit</a>
                
                                <button class="btn btn-danger" data-href="/admin/historyevent/delete?deleteID=<?php echo $historyevent->getId(); ?>" data-action="delete" data-user-id="<?php echo $historyevent->getId(); ?>">Delete</button>
                            </div>
        
        
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
    document.getElementById('show-adding-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });

    $(function (){
        $('#datepicker5').datetimepicker({
            use24hours: true
        });
    }); 
</script>
<?php include __DIR__ . '/../../footer.php'; ?>