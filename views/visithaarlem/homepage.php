<?php
    //incl new navbar
    include __DIR__ . '/../header.php';
    ?>

    <head>
        <link rel="stylesheet" href="/css/festivalpage.css">
    </head>


<div class="home-banner-section">
    <div class="content">
        <h1 class="click2edit" data-id="title"> <?= $page->getTitle() ?></h1> 
        <p class="click2edit" data-id="description"> <?= $page->getDescription() ?></p>
    </div>
    <img src="/uploads/<?= htmlspecialchars($page->getHeaderImg()); ?>" width="100%" height="auto" class="yummy-banner-img">
</div>

<section class="pt-5">
    <div class="container mb-3">
        <div class="row mb-3">
            <?php foreach ($pagecards as $card) : ?>
                <div class="card mb-4">
                    <a href="<?= $card->getLink() ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="/uploads/<?= htmlspecialchars($card->getImage()); ?>" class="card-img rounded-left" style="max-width: 100%">
                            </div>
                            <div class="col-md-8 bg-light rounded-right">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $card->getTitle() ?></h5>
                                    <p class="card-text"><?= $card->getDescription() ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



    <!-- TimeTable -->
    <section class="py-5">
        <div class="container">
            <div class="mb-4 d-flex justify-content-center">
                <button class="btn btn-info" id="show-dance-events">Dance</button>
                <button class="btn btn-info mx-3" id="show-jazz-events">Jazz</button>
                <button class="btn btn-info" id="show-history-events">History</button>
            </div>
            <table class="table table-bordered table-hover  dance-jazz-table" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event) :
                        $day = date('l', strtotime($event->getDatetime())); ?>
                        <tr class="<?php echo $event->getType(); ?>">
                            <td><?php echo $day ?></td>
                            <td><?php echo date('g:i A', strtotime($event->getDatetime())); ?></td>
                            <td><?php echo $event->getName(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="table table-bordered table-hover  history-table" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historyEvents as $event) :
                        $day = date('l', strtotime($event->getDateTime())); ?>
                        <tr>
                            <td><?php echo $day ?></td>
                            <td><?php echo date('g:i A', strtotime($event->getDateTime())); ?></td>
                            <td><?php echo $event->getLocation(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Location -->
   <section class="pb-5">
     <div class="container">
        <div class="row-md-6">
            <div class="location">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.660308624696!2d4.632323215799311!3d52.386532879785394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6097df89360c9%3A0x1a70afdd12fd6e39!2sGrote%20Markt%2C%20Haarlem!5e0!3m2!1sen!2snl!4v1615301111915!5m2!1sen!2snl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        </div>
   </section>

   <section class="pb-5">
       <div class="container">
           <div class="row mt-2">
               <div class="col-12">
                   <iframe src="https://widget.taggbox.com/2155902" style="width:100%;height:450px;border:none;"></iframe>
               </div>
           </div>
       </div>
   </section>

    <script>
        const historyTable = document.querySelector(".history-table");
        const danceJazzTable = document.querySelector(".dance-jazz-table");

        const historyButton = document.getElementById("show-history-events");
        const jazzButton = document.getElementById('show-jazz-events');
        const danceButton = document.getElementById('show-dance-events');

        const jazzRows = document.querySelectorAll('.jazz');
        const danceRows = document.querySelectorAll('.dance');

        historyButton.addEventListener("click", () => {
            historyTable.style.display = "table";
            danceJazzTable.style.display = "none";
        });

        jazzButton.addEventListener('click', function() {
            historyTable.style.display = "none";
            danceJazzTable.style.display = "table";

            jazzRows.forEach(function(row) {
                row.style.display = 'table-row';
            });
            danceRows.forEach(function(row) {
                row.style.display = 'none';
            });
        });

        danceButton.addEventListener('click', function() {
            historyTable.style.display = "none";
            danceJazzTable.style.display = "table";

            danceRows.forEach(function(row) {
                row.style.display = 'table-row';
            });
            jazzRows.forEach(function(row) {
                row.style.display = 'none';
            });
        });

        var edit = function() {
            $(".click2edit").each(function() {
                $(this).summernote({
                    focus: true,
                });
            });
        };

        var save = function() {
            var contents = [];
            $(".click2edit").each(function() {
                var content = $(this).summernote("code");
                var id = $(this).attr("data-id"); // Assuming that you have an attribute called "data-id" to identify each editable element
                $(this).summernote("destroy");
                contents.push({
                    id: id,
                    content: content
                });
            });

            // send this data as an array to a php function
            $.ajax({
                url: "/page/save", // Change this to the URL of your PHP script
                method: "POST",
                data: {
                    contents: contents
                },
                success: function(response) {

                }
            });
        };
    </script>
    <?php
    include __DIR__ . '/../footer.php';
    ?>