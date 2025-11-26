<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';

$menu = null;

// Jika edit → ambil data menu
if ($id) {
  $selectMenu = mysqli_query($config, "SELECT * FROM menus WHERE id='$id'");
  $menu = mysqli_fetch_assoc($selectMenu);
} // Simpan data baru
if (isset($_POST['simpan'])) {
  $name = $_POST['name'];
  $icon = $_POST['icon'];
  $link = $_POST['link'];
  $order = $_POST['order'];

  $insert = mysqli_query($config, "INSERT INTO menus (name, icon, link, `order`) VALUES ('$name', '$icon', '$link', '$order')");
  header("location:?page=menu");
  exit;
} // Update data lama
if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $icon = $_POST['icon'];
  $link = $_POST['link'];
  $order = $_POST['order'];

  mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', link='$link', `order`='$order' WHERE id='$id'");
  header("location:?page=menu");
  exit;
}

?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h3><?= $id ? 'Edit menu' : 'Tambah Menu' ?></h3>
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label">Name</label><br>
          <input type="text" name="name" class="form-control w-50" value="<?= $menu['name'] ?? '' ?>" required><br>

          <label class="form-label">Icon</label><br>
          <input type="text" name="icon" class="form-control w-50" value="<?= $menu['icon'] ?? '' ?>" required><br>

          <label class="form-label">Link</label><br>
          <input type="text" name="link" class="form-control w-50" value="<?= $menu['link'] ?? '' ?>" required><br>

          <label class="form-label">Order</label><br>
          <input type="text" name="order" class="form-control w-50" value="<?= $menu['order'] ?? '' ?>" required><br>

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