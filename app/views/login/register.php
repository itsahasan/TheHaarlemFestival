<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
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
                    Register
                </div>
                <div class="card-body">
                    <?php
                    // Блок для отображения сообщений
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <form action="/login/register" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                        <a class="btn btn-primary" href="/login" role="button">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>