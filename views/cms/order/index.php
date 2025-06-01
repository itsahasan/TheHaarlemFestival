<?php
include __DIR__ . '/../../header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<section class="py-5 px-5">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
          <div class="section-title text-center grow-1">
            <h2>Orders CMS</h2>
        </div>
        <!-- <input type="submit" name="submit" value="Export to .csv" class="btn btn-sm btn-info"> -->
         <form action="/pdf/createinvoicecsv" method="GET">
            <input type="hidden" name="exporttocsv" >
            <input type="submit" name="submit" value="Export to .csv" class="btn btn-sm btn-info">
          </form>
        </div>
    <div style="min-height: 60vh; overflow: hidden;">
  <div style="overflow-x: auto; width: 100%;">
    <div style="min-width: 1200px;">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col" style="font-size:14px">ID</th>
            <th scope="col" style="font-size:14px">First Name</th>
            <th scope="col" style="font-size:14px">Last Name</th>
            <th scope="col" style="font-size:14px">Email Address</th>
            <th scope="col" style="font-size:14px">Street Address</th>
            <th scope="col" style="font-size:14px">Country</th>
            <th scope="col" style="font-size:14px">Zip Code</th>
            <th scope="col" style="font-size:14px">Phone Number</th>
            <th scope="col" style="font-size:14px">User Id</th>
            <th scope="col" style="font-size:14px">Total Price</th>
            <th scope="col" style="font-size:14px">Payment Status</th>
            <th scope="col" style="font-size:14px" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($model as $placeorder):
            try {
              $payment = $this->mollie->payments->get($placeorder->getPaymentId());
              $status = $payment->status;
            } catch (\Throwable $th) {
              $status = 'unknown';
            }
          ?>
            <tr>
              <td><?= $placeorder->getId() ?></td>
              <td><?= $placeorder->getFirstName() ?></td>
              <td><?= $placeorder->getLastName() ?></td>
              <td><?= $placeorder->getEmailAddress() ?></td>
              <td><?= $placeorder->getStreetAddress() ?></td>
              <td><?= $placeorder->getCountry() ?></td>
              <td><?= $placeorder->getZipCode() ?></td>
              <td><?= $placeorder->getPhoneNumber() ?></td>
              <td><?= $placeorder->getUserId() ?></td>
              <td><?= $placeorder->getTotalPrice() ?> €</td>
              <td><?= $status ?></td>
              <td>
                <div class="d-flex flex-row align-items-center">
                    <input name="editbtn" id="editbtn" class="btn btn-sm btn-warning" type="button" value="Edit"
                      onclick="location='/admin/orders/edit?updateID=<?= $placeorder->getId() ?>'">
                      <form action="/pdf/downloadinvoice" method="POST" class="mx-2">
                        <input type="hidden" name="invoicedownload" value="<?= $placeorder->getId() ?>">
                        <input type="submit" name="submit" value="Invoice Download" class="btn btn-sm btn-info">
                      </form>
                      <form action="/pdf/downloadticket" method="POST" class="mx-2">
                        <input type="hidden" name="invoicedownload" value="<?= $placeorder->getId() ?>">
                        <input type="submit" name="submit" value="Ticket Download" class="btn btn-sm btn-info">
                      </form>
                      
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
    <!--Updating the Placed Orders.-->
    <?php
    if (isset($_POST["exporttocsv"])) {
        ?>
        <?php
    }
    ?>
      </table>
    </div>
  </div>
</div>
</section>
<?php include __DIR__ . '/../../footer.php'; ?>