<?php

//isset: tidak kosong
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM customers WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);


if (isset($_POST['update'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];


  // jika address diisi maka update address, jika tidak diisi maka address tidak diupdate
  if ($address) {
    $query = mysqli_query($config, "UPDATE customers SET name='$name', phone='$phone', address='$address' WHERE id='$id'"); //id ngambil dari parameter
  } else {
    $query = mysqli_query($config, "UPDATE customers SET name='$name', phone='$phone' WHERE id='$id'");
  }

  if ($query) {
    header("location:?page=customer&ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $query = mysqli_query($config, "INSERT INTO customers (name, phone, address) VALUES ('$name', '$phone', '$address')");
  if ($query) {
    header("location:customer.php?add=berhasil");
  };
  if ($query) {
    header("location:?page=customer&tambah=berhasil");
  }
}
?>


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">
          <?php echo isset($_GET['edit']) ? 'edit' : 'Add' ?> Customer
        </h3>
        <form action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required
              value="<?php echo $rowEdit['name'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="number" name="phone" class="form-control" placeholder="Enter Your phone" required
              value="<?php echo $rowEdit['phone'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter Your Address" required
              value="<?php echo $rowEdit['address'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <button class="btn btn-primary" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
              <?php echo isset($id) ? 'Simpan Perubahan' : 'Simpan' ?>
            </button>
            <a href="?page=customer" class="btn btn-secondary">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>