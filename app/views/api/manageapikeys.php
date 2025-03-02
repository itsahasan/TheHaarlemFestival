<?php
include __DIR__ . '/../header.php';
?>

<html>

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="/api/keys/createKey">Generate token</a>
    </div>
    <div class="card-body">
        <h4>Currently valid keys: </h4>
        <div class="table-responsive-sm">
            <table class="table">
                <tbody>
                    <?php
                    foreach ($keys as $key) { ?>
                        <tr>
                            <td scope="row"><?= $key->getApi_key() ?></td>
                            <td><a href="/api/payment?key=<?= $key->getApi_key() ?>">Show payment JSON</a></td>
                            <td>
                                <input name="deactivatebtn" id="deactivatebtn" class="btn btn-danger" type="button" value="Deactivate" onclick="location='/api/keys/deactivatekey?keyid=<?php echo $key->getId(); ?>'">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php
include __DIR__ . '/../footer.php';
