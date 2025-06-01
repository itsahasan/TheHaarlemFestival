<?php
include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">





<section class="py-5 px-5">
    <div class="section-title text-center grow-1">
        <h2>Tour Guide CMS</h2>
    </div>
    <div>
        <div>
            <a href="/admin/tourguide/create"  class="btn btn-success mb-2" id="show-adding-form">Add Tour Guide</a>
        </div>
    
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($model as $tourguide) {
                ?>
                    <tr>
                        <td><?= $tourguide->getId() ?></td>
                        <td style="width: 2%;"><?= $tourguide->getName() ?></td>
                        <td style="width: 50%;"><?= trim(strip_tags(html_entity_decode($tourguide->getDescription())))   ?></td>
                        <td>
    
    
                        <img  style="width:90px; height: 80px; object-fit:cover" src="/uploads/<?php echo htmlspecialchars($tourguide->getImage()); ?>"  class="card-img-top" alt="Loading image...">
                        
                       </td>
                        <td style="width: 2%">
                         
    
                            <a class="btn btn-warning" href="/admin/tourguide/edit?updateID=<?php echo $tourguide->getId(); ?>">Edit</a>
    
                        </td>
                        <td style="width: 2%">
                  
                            <button class="btn btn-danger" data-href="/admin/tourguide/delete?deleteID=<?php echo $tourguide->getId(); ?>" data-action="delete" data-user-id="<?php echo $tourguide->getId(); ?>">Delete</button>
    
    
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
</script>
<?php include __DIR__ . '/../../footer.php'; ?>