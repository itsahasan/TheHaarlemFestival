<?php
include __DIR__ . '/../header.php';
?>

<html>

<section class="container pt-5 pb-5" style="min-height:60vh">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Currently valid keys: </h4>
            <a class="btn btn-primary" href="/api/keys/createKey">Generate token</a>
        </div>
        <div class="card-body">
            
            <div class="table-responsive-sm">
                <table class="table">
                    <tbody>
                        <?php
                        foreach ($keys as $key) { ?>
                            <tr>
                                <td scope="row"><?= $key->getApi_key() ?></td>
                                <td><a href="/api/payment?key=<?= $key->getApi_key() ?>">Show payment JSON</a></td>
                                <td>

                                    <input  data-user-id="<?php echo $key->getId(); ?>" data-action="delete"  data-href="/api/keys/deactivatekey?keyid=<?php echo $key->getId(); ?>"  name="deactivatebtn" id="deactivatebtn" class="btn btn-danger" type="button" value="Deactivate" >
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php
include __DIR__ . '/../footer.php';
