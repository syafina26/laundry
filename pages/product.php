<?php
$q_products = mysqli_query($koneksi, "SELECT p.*, c.category_name AS c_name FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.id ORDER BY p.id DESC");
$products = mysqli_fetch_all($q_products, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $s_photo = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id = $id");
  $row = mysqli_fetch_assoc($s_photo);
  $filePath = $row['product_photo'];
  if (file_exists($filePath)) {
    unlink($filePath);
  }

  $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id = $id");
  if ($delete) {
    header("location:?page=product");
  }
}

?>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Products</h3>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-end mb-3 mt-2">
            <a class="btn btn-primary" href="?page=tambah-product"><i class="bi bi-plus-circle"></i> Add
              Product</a>
          </div>
          <table class="table table-bordered">
            <tr class="text-center">
              <th>No</th>
              <th>Category Name</th>
              <th>Product Name</th>
              <th>Photo</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
            <?php foreach ($products as $key => $v) {
            ?>
              <tr>
                <td class="text-center"><?php echo $key + 1 ?></td>
                <td><?php echo $v['c_name'] ?></td>
                <td><?php echo $v['product_name'] ?></td>
                <td class="text-center">
                  <img class="rounded" src="<?php echo $v['product_photo'] ?>" width="115" alt="">
                </td>
                <td>Rp. <?php echo number_format($v['product_price'], 2, ',', '.') ?></td>
                <td class="text-center">
                  <a href="?page=tambah-product&edit=<?php echo $v['id'] ?>" class="btn btn-success btn-sm"><i
                      class="bi bi-pencil"></i></a>
                  <a href="?page=product&delete=<?php echo $v['id'] ?>"
                    onclick="return confirm('Are you sure you want to delete this data?')"
                    class="btn btn-warning btn-sm"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>