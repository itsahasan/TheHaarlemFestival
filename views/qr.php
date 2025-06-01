<?php
include __DIR__ . '/header.php';
?>
<?php
// Check if user agent is a mobile device
$isMobile = strpos($_SERVER['HTTP_USER_AGENT'], "Mobile") !== false;
if ($isMobile) {
    // Display button to scan QR code
    echo "<button onclick='openCamera()'>Scan QR Code</button>";
} else {
    // Display message that QR code scanning is not supported
    echo "QR code scanning is not supported on this device.";
}
?>
<video id="camera-view" width="400" height="300"></video>
<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>

<script>
    function openCamera() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                })
                .then(function(stream) {
                    var video = document.getElementById('camera-view');
                    video.setAttribute('autoplay', '');
                    video.setAttribute('muted', '');
                    video.setAttribute('playsinline', '');
                    video.srcObject = stream;
                    // Listen for video play event to start scanning
                    video.addEventListener('play', function() {
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        var scanningInterval = setInterval(function() {
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                                inversionAttempts: "dontInvert",
                            });
                            if (code) {
                                clearInterval(scanningInterval);
                                var qrCodeData = code.data;
                                window.location.href = '/qr/scan?qrCodeData=' + qrCodeData;
                            }
                        }, 100);
                    });
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Camera access error: ' + error.message);
                });
        } else {
            alert('Camera access is not supported on this device.');
        }
    }
    openCamera();
</script>

<?php
include __DIR__ . '/footer.php';
?>