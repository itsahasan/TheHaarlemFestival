<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
        <form action="/user/update" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="mb-3">
                <label for="id" class="form-label">Id: <?php echo $user->getId(); ?></label>
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo $user->getUsername(); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $user->getEmail(); ?>">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" id="role" class="form-control">
                    <?php foreach ($roles as $role) {
                        if ($role['id'] == $user->getRole()) {
                            echo "<option selected value='$role[id]'>$role[name]</option>";
                        } else {
                            echo "<option value='$role[id]'>$role[name]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a name="" id="" class="btn btn-primary" href="/user" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>