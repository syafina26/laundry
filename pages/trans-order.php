<?php

$query = mysqli_query($config, "SELECT * FROM trans_orders c ORDER BY c.id DESC");
$transorders = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = mysqli_query($config, "DELETE FROM trans_orders WHERE id = '$id'");

  // redirect
  header("location:?page=trans-order&hapus=berhasil");
}

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Data Transaction Order</h3>
        <div class="mb-3" align="right">
          <a href="?page=tambah-trans-order" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Transaction Order
          </a>
        </div>
        <table class="table table-bordered table-striped datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Customer ID</th>
              <th>Code</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Payment</th>
              <th>Change</th>
              <th>Tax</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transorders as $key => $value): ?>
              <tr>
                <td><?php echo $key += 1 ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['order_code'] ?></td>
                <td><?php echo $value['order_end_date'] ?></td>
                <td><?php echo $value['order_status'] ?></td>
                <td><?php echo $value['order_pay'] ?></td>
                <td><?php echo $value['order_change'] ?></td>
                <td><?php echo $value['order_tax'] ?></td>
                <td><?php echo $value['order_end_date'] ?></td>
                <td><?php echo $value['order_total'] ?></td>
                <td>
                  <a class="btn btn-success" href="?page=tambah-trans-order&edit=<?php echo $value['id'] ?>">
                    <i class="bi bi-pencil"></i>
                  </a>|
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                    href="?page=trans-order&delete=<?php echo $value['id'] ?>">
                    <i class="bi bi-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>