<?php
include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<div class="bg-light p-5 rounded-lg" style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: gray;">Orders CMS</h1>
</div>

<div class="px-4">
    <!--Creating table for displaying and being able to edit the Placed Orders.-->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Email Address</th>
                <th scope="col">Street Address</th>
                <th scope="col">Country</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Phone Number</th>
                <th scope="col">User Id</th>
                <th scope="col">Total Price</th>
                <th scope="col">Payment Status</th>
                <th scope="col" colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $placeorder) {

                $payment = $this->mollie->payments->get($placeorder->getPaymentId());
                $status = $payment->status;
            ?>

                <tr>
                    <td><?= $placeorder->getId() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getFirstName() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getLastName() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getBirthDate() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getEmailAddress() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getStreetAddress() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getCountry() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getZipCode() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getPhoneNumber() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getUserId() ?></td>
                    <td style="width: 10%;"><?= $placeorder->getTotalPrice() ?> €</td>
                    <td style="width: 10%;"><?= $status ?></td>
                    <td style="width: 10%">
                        <form action="/orders/cms?updateID=<?= $placeorder->getId() ?>" method="POST">
                            <input type="hidden" name="edit" value="<?= $placeorder->getId() ?>">
                            <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td style="width: 10%">
                        <form method="POST">
                            <input type="hidden" name="invoicedownload">
                            <input type="submit" name="submit" value="Invoice Download" class="btn btn-info">
                        </form>
                    </td>
                    <td style="width: 10%">
                        <form action="/orders/createinvoicecsv" method="POST">
                            <input type="hidden" name="exporttocsv" value="<?= $placeorder->getId() ?>">
                            <input type="submit" name="submit" value="Export to .csv" class="btn btn-info">
                        </form>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

    <!--Updating the Placed Orders.-->
    <?php
    if (isset($_POST["edit"])) {
    ?>
        <h3>Edit Placed Order with ID: <?= $updateOrder->getId() ?></h3>
        <div>
            <form method="POST">
                <div class="form-group row mb-1">
                    <label for="changedfirstName" class="col-sm-2 col-form-label">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedfirstName" name="changedfirstName" value="<?= $updateOrder->getFirstName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedlastName" class="col-sm-2 col-form-label">Last Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedlastName" name="changedlastName" value="<?= $updateOrder->getLastName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedbirthdate" class="col-sm-2 col-form-label">Date of Birth:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" data-date-format="dd/mm/yyyy" id="changedbirthdate" name="changedbirthdate" value="<?= $updateOrder->getBirthDate() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedemailAddress" class="col-sm-2 col-form-label">Email Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedemailAddress" name="changedemailAddress" value="<?= $updateOrder->getEmailAddress() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedstreetAddress" class="col-sm-2 col-form-label">Street Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedstreetAddress" name="changedstreetAddress" value="<?= $updateOrder->getStreetAddress() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedcountry" class="col-sm-2 col-form-label">Country:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedcountry" name="changedcountry" value="<?= $updateOrder->getCountry() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedzipCode" class="col-sm-2 col-form-label">Zip Code:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedzipCode" name="changedzipCode" value="<?= $updateOrder->getZipCode() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedphoneNumber" class="col-sm-2 col-form-label">Phone Number:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedphoneNumber" name="changedphoneNumber" value="<?= $updateOrder->getPhoneNumber() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changeduserId" class="col-sm-2 col-form-label">User Id:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changeduserId" name="changeduserId" value="<?= $updateOrder->getUserId() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedtotalPrice" class="col-sm-2 col-form-label">Total Price:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedtotalPrice" name="changedtotalPrice" value="<?= $updateOrder->getTotalPrice() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="changedpayment" class="col-sm-2 col-form-label">Payment status:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="changedpayment" name="changedpayment" value="<?= $this->mollie->payments->get($updateOrder->getPaymentId()) ?>" required>
                    </div>
                </div>
                <input type="submit" name="update" value="Update Order" class="form-control btn btn-success mb-1">
            </form>
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_POST["exporttocsv"])) {
    ?>



    <?php
    }
    ?>
</div>

<?php include __DIR__ . '/../../footer.php'; ?>