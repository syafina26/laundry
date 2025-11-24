<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';

$level = null;

// Jika edit → ambil data level
if ($id) {
  $selectLevel = mysqli_query($config, "SELECT * FROM levels WHERE id='$id'");
  $level = mysqli_fetch_assoc($selectLevel);
}

// Simpan data baru
if (isset($_POST['simpan'])) {
  $level_name = $_POST['name'];

  mysqli_query($config, "INSERT INTO levels (name) VALUES ('$level_name')");
  header("location:?page=level");
  exit;
}

// Update data lama
if (isset($_POST['update'])) {
  $level_name = $_POST['name'];

  mysqli_query($config, "UPDATE levels SET name='$level_name' WHERE id='$id'");
  header("location:?page=level");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $id ? 'Edit Level' : 'Tambah Level' ?></title>
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3><?= $id ? 'Edit Level' : 'Tambah Level' ?></h3>
        </div>
        <div class="card-body">

          <form method="post">
            <label class="form-label">Level Name</label><br>

            <input type="text" name="name" class="form-control w-50" value="<?= $level['name'] ?? '' ?>" required><br>

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