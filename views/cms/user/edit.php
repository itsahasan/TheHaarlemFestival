<?php
include(__DIR__ . "/../../header.php");

// Access control: Only logged-in users can access this page

if (!isset($_SESSION['loggedin'])) {
    echo "<script>sessionStorage.setItem('error', 'Please log in to access your profile.'); window.location.href = '/login';</script>";
    exit();
}
?>

<section class="py-5" style="min-height: 60vh">
    <div class="container">
        <div class="card mt-4">
    <div class="card-header">
        <h4>Edit My Profile</h4>
    </div>
    <div class="card-body">
        <form action="/admin/user/update" method="post" id="edit-form">
            <input type="hidden" name="id" value="<?= $user->getId(); ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $user->getUsername(); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $user->getEmail(); ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="/admin/user/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
    </div>
</section>


<?php include(__DIR__ . "/../../footer.php"); ?>
