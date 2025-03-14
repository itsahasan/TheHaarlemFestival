<?php
include(__DIR__ . "/../../header.php");
?>
<div class="card">
    <div class="card-header">
        Create User
    </div>
    <div class="card-body">
        <form action="/user/create" method="post" enctype="multipart/form-data" id="create-form">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" id="role" class="form-control">
                    <?php foreach ($roles as $role) {
                        echo "<option value='$role[id]'>$role[name]</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
            <a name="" id="" class="btn btn-primary" href="/user/index" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>