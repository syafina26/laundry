<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';

$service = null;

// Jika edit → ambil data service
if ($id) {
  $selectservice = mysqli_query($config, "SELECT * FROM trans_orders WHERE id='$id'");
  $service = mysqli_fetch_assoc($selectservice);
}

// Simpan data baru
if (isset($_POST['simpan'])) {
  $service_name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  mysqli_query($config, "INSERT INTO trans_orders (name, price, description) VALUES ('$service_name', '$price', '$description')");
  header("location:?page=service");
  exit;
}

// Update data lama
if (isset($_POST['update'])) {
  $service_name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  mysqli_query($config, "UPDATE trans_orders SET name='$service_name', price='$price', description='$description' WHERE id='$id'");
  header("location:?page=service");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $id ? 'Edit service' : 'Tambah service' ?></title>
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3><?= $id ? 'Edit service' : 'Tambah service' ?></h3>
        </div>
        <div class="card-body">

          <form method="post">
            <label class="form-label">Name</label><br>
            <input type="text" name="name" class="form-control w-50" value="<?= $service['name'] ?? '' ?>" required><br>

            <label class="form-label">Price</label><br>
            <input type="number" name="price" class="form-control w-50" value="<?= $service['price'] ?? '' ?>"
              required><br>

            <label class="form-label">Description</label><br>
            <input type="text" name="description" class="form-control w-50" value="<?= $service['description'] ?? '' ?>"
              required><br>

            <button class="btn btn-primary" type="submit" name="<?= $id ? 'update' : 'simpan' ?>">
              <?= $id ? 'Update' : 'Create' ?>
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>

</html>