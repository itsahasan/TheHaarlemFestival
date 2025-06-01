<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-md-5">
                <div class="card shadow-md">
                    <div class="card-header text-center">
                        <h4>Login Here</h4>
                    </div>
                    <div class="card-body">
                        <form action="/login/validate" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" aria-describedby="username" placeholder="enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="enter your password" required>
                            </div>
                            <div class="mb-3">
                                <a href="/login/createCode">Forgot password?</a>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-primary mx-2">Login</button>
                                <a name="" id="" class="btn btn-secondary" href="/login/display" role="button" class="mx-2">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


    
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>

    <script src="/js/toast.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>