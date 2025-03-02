 <!-- <style>
     .green {
         background-color: green;
     }

     .red {
         background-color: red;
     }
 </style>-->

 <?php
    if ($ticket == null) {
        echo "Invalid QR";
    } else {
        if ($this->ticketService->checkIfTicketWasScanned($uuid)) {
            echo "<body class='green'>Ticket was scanned successfully. </body>";
            $this->ticketService->updateTicketStatus("$uuid");
        } else {
            echo "<body class='red'>Ticket was scanned before!!! </body>";
        }
    }
    ?> 

 <style>
     .green {
         background-color: green;
     }

     .red {
         background-color: red;
     }
 </style>

 <body>
     <h1>Scan QR Code</h1>
     <div id="status"></div>
     <video id="video" width="300" height="200"></video>
 </body>
 <script>
     var video = document.querySelector("#video");
     var status = document.querySelector("#status");

     if (navigator.mediaDevices.getUserMedia) {
         navigator.mediaDevices.getUserMedia({
                 video: true
             })
             .then(function(stream) {
                 video.srcObject = stream;
             })
             .catch(function(error) {
                 console.log("Error: " + error.message);
             });
     }

     setInterval(function() {
         var canvas = document.createElement("canvas");
         canvas.width = video.videoWidth;
         canvas.height = video.videoHeight;
         var context = canvas.getContext("2d");
         context.drawImage(video, 0, 0, canvas.width, canvas.height);

         var imageData = canvas.toDataURL("image/png");
         var xhr = new XMLHttpRequest();
         xhr.open("POST", "validate.php", true);
         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
         xhr.onreadystatechange = function() {
             if (xhr.readyState === 4 && xhr.status === 200) {
                 var response = JSON.parse(xhr.responseText);
                 if (response.success) {
                     status.innerHTML = "<div class='green'>Ticket was scanned successfully.</div>";
                     // Update ticket status in database
                     var uuid = response.uuid;
                     var xhr2 = new XMLHttpRequest();
                     xhr2.open("POST", "update_status.php", true);
                     xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                     xhr2.onreadystatechange = function() {
                         if (xhr2.readyState === 4 && xhr2.status === 200) {
                             console.log(xhr2.responseText);
                         }
                     };
                     xhr2.send("uuid=" + uuid);
                 } else {
                     status.innerHTML = "<div class='red'>Invalid QR code.</div>";
                 }
             }
         };
         xhr.send("imageData=" + encodeURIComponent(imageData));
     }, 1000);
 </script>