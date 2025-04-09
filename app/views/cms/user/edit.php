<?php
include(__DIR__ . "/../../header.php");

// Access control: Only logged-in users can access this page
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<script>alert('Please log in to access your profile.'); window.location.href = '/login';</script>";
    exit();
}
?>

<div class="card mt-4">
    <div class="card-header">
        <h4>Edit My Profile</h4>
    </div>
    <div class="card-body">
        <form action="/user/updateMyProfile" method="post" id="edit-form">
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
            <a href="/user/myprofile" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include(__DIR__ . "/../../footer.php"); ?>
