<?php
include __DIR__ . '/../../header.php';

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<section class="py-5">
    <div class="container">
        <div>
        <h3 class="card-title mb-4">Edit Placed Order with ID: <?= $updateOrder->getId() ?></h3>
        <div>
            <form method="POST"  action="/admin/orders/update">
    
            <input type="text" name="updateID"  value="<?= $updateOrder->getId() ?>">
                <div class="form-group row mb-3">
                    <label for="changedfirstName" class="col-sm-3 col-form-label">First Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedfirstName" name="changedfirstName" value="<?= $updateOrder->getFirstName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedlastName" class="col-sm-3 col-form-label">Last Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedlastName" name="changedlastName" value="<?= $updateOrder->getLastName() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedbirthdate" class="col-sm-3 col-form-label">Date of Birth:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" data-date-format="dd/mm/yyyy" id="changedbirthdate" name="changedbirthdate" value="<?= $updateOrder->getBirthDate() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedemailAddress" class="col-sm-3 col-form-label">Email Address:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedemailAddress" name="changedemailAddress" value="<?= $updateOrder->getEmailAddress() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedstreetAddress" class="col-sm-3 col-form-label">Street Address:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedstreetAddress" name="changedstreetAddress" value="<?= $updateOrder->getStreetAddress() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedcountry" class="col-sm-3 col-form-label">Country:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedcountry" name="changedcountry" value="<?= $updateOrder->getCountry() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedzipCode" class="col-sm-3 col-form-label">Zip Code:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedzipCode" name="changedzipCode" value="<?= $updateOrder->getZipCode() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedphoneNumber" class="col-sm-3 col-form-label">Phone Number:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedphoneNumber" name="changedphoneNumber" value="<?= $updateOrder->getPhoneNumber() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changeduserId" class="col-sm-3 col-form-label">User Id:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changeduserId" name="changeduserId" value="<?= $updateOrder->getUserId() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="changedtotalPrice" class="col-sm-3 col-form-label">Total Price:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedtotalPrice" name="changedtotalPrice" value="<?= $updateOrder->getTotalPrice() ?>" required>
                    </div>
                </div>
                <?php
    
        
                    try {
                        $payment = $this->mollie->payments->get($updateOrder->getPaymentId());
                    } catch (\Exception $e) {
                    }
                        
    
                ?>
                <div class="form-group row mb-3">
                    <label for="changedpayment" class="col-sm-3 col-form-label">Payment status:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="changedpayment" name="changedpayment" value="<?= $updateOrder->getPaymentId() ?>" required>
                    </div>
                </div>
         
               <div class="d-flex justify-content-end">
                     <input type="submit" name="update" value="Update Order" class="btn btn-lg btn-success mb-1">
                    <a href="/admin/orders/list" class="btn btn-lg btn-secondary ml-3">Cancel</a>
               </div>
            </form>
        </div>
    
    
      
    </div>
    </div>
</section>


<?php include __DIR__ . '/../../footer.php'; ?>