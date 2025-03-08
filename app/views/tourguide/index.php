<?php
include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<div class="bg-light p-5 rounded-lg" style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="    font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: gray;">Explore History</h1>
</div>

<div class="mt-2 container mx-auto" style="max-width: 1000px;">
    <div class="mt-4">
        <?php
        foreach ($model as $tourguides) {
        ?>
            <div class="card mb-3">
                <div class="row g-0" style="border: 0;">
                    <div class="col-md-4">
                        <img class="card-img h-100" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($tourguides->getImage()); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title" style="color: darkred;"><?= ucfirst($tourguides->getName()) ?></h1>
                            <h5 class="card-description">Description </h5>
                            <p><?= $tourguides->getDescription() ?></p>
                            <a class="btn btn-info" role="button" href="/historyevent">Go to event</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!--<script>getTourGuides()</script>-->
        <!--keep as well the id which is id=getContainer-->
    </div>
</div>

<style>
    #app {
        background-color: white;
    }
</style>

<?php
include __DIR__ . '/../footer.php';
?>