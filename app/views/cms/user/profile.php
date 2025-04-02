<?php
include(__DIR__ . "/../../header.php");
//echo $_SESSION['userId'];
?>
<div class="card">
    <div class="card-header">
        Edit Profile
    </div>
    <div class="card-body">
        <form action="/user/update" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="mb-3">
                <label for="id" class="form-label">Id: <?php echo $user->getId(); ?></label>
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required value="<?php echo $user->getUsername(); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="●●●●●●">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required value="<?php echo $user->getEmail(); ?>">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role: <?php echo $user->getRoleName(); ?></label>
                <input type="hidden" class="form-control" name="role" id="role" value="<?php echo $user->getRole(); ?>">
            </div>

            <button type="submit" class="btn btn-success">Edit</button>
            <a name="" id="" class="btn btn-primary" href="/page/festival" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>