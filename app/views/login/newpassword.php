<!doctype html>
<html lang="en">
<head>
    <title>Haarlem Festival - Set New Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <br />
            <div class="card">
                <div class="card-header">
                    Set a New Password
                </div>
                <div class="card-body">
                    <?php

                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <form id="resetForm" method="post" action="/login/updatePassword">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
                        <a href="/login" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

    document.getElementById('resetForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        if (password !== confirmPassword) {
            alert("Passwords do not match. Please try again.");
            event.preventDefault();
        }
    });
</script>

</body>
</html>