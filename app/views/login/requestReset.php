<!doctype html>
<html lang="en">
<head>
    <title>Haarlem Festival - Reset Password</title>
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
                    Reset Password
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <p>Enter your username. We will send a password reset link to the email associated with your account.</p>
                    <form method="post" action="/login/createCode">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Send Reset Link</button>
                        <a href="/login" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>