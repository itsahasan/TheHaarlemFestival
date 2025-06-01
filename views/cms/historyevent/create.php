<?php
 include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<section class="py-5 px-5">
    <div class="container">
        <div class="section-title text-center grow-1">
        <h2>History Event CMS</h2>
    </div>
    <div style="min-height: 60vh">    
        <div>
            <div>
                <a href="/admin/historyevent/cms" class="btn btn-success mb-2" id="show-adding-form">View History Event</a>
            </div>
        
        
            <div id="form-add-container" >
                <form method="POST" enctype="multipart/form-data" action="/admin/historyevent/store">
                    <div class="form-group row mb-3">
                        <label for="ticketsavailable" class="col-sm-2 col-form-label">Seats Available:</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" value="1" class="form-control" id="ticketsavailable" name="tickets_available" placeholder="Insert History Event Seats" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">Price:</label>
                        <div class="col-sm-10">
             
                            <input  class="form-control" type="number" min="0" id="price" name="price" placeholder="Insert History Event Price" >
        
        
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="datetime" class="col-sm-2 col-form-label">Datetime:</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control datepicker" id="datetime" name="datetime" data-date-format="dd/mm/yyyy" placeholder="Insert History Event Datetime" required></input>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="location" class="col-sm-2 col-form-label">Location:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="location" name="location" placeholder="Insert History Event Location" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="tourguideid" class="col-sm-2 col-form-label">TourguideID:</label>
                        <div class="col-sm-10">
          
        
                            <select required class="form-control" name="tourguideID" id="tourguideid">
        
                                <option value="">
                                    Select tour guide
                                </option>
        
                                <?php
                                foreach ($tourGuides as $tourguide) {
                                ?>
        
                                  <option value="<?= $tourguide->getId() ?>">
                                      <?= $tourguide->getName() ?>
                                  </option>
        
                                <?php
                                            }        ?>
        
                            </select>
                        </div>
                    </div>
                    <input type="submit" name="add" value="Insert History Event" class="form-control btn btn-success mb-1">
                </form>
            </div>
        
        </div>
    </div>
</section>    



<?php include __DIR__ . '/../../footer.php'; ?>