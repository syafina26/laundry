<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($query);

$level_id = $rowEdit['id'];

$queryMenus = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC");
$rowMenus = mysqli_fetch_all($queryMenus,MYSQLI_ASSOC);

$selectMenu = mysqli_query($config, "SELECT * FROM level_menus WHERE level_id='$level_id'");
$selectMenuIds = [];
$rowSelectMenus = mysqli_fetch_all($selectMenu,MYSQLI_ASSOC);
foreach($rowSelectMenus as $selectMenus){
    $selectMenuIds[] = $selectMenus['menu_id'];
}
if (isset($_POST['save'])) {
    $level_id = $_POST['level_id'];
    $menu_id = $_POST['menu_id'];

    mysqli_query($config, "DELETE FROM level_menus WHERE level_id ='$level_id'");
    foreach ($menu_id as $key=> $menu){
        $insert = mysqli_query($config, "INSERT INTO level_menus (menu_id, level_id) VALUES ('$menu', '$level_id')");
    }
    header("Location:?page=level&tambah=success");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card"><br>
        <div class="card-body">
          <h1><?php echo isset($_GET['edit']) ? 'Update Menu' : 'Tambah Menu' ?></h1><br>
          <form action="" method="post">
            <div class="mb-3">
              <label for="" class="form-label">Level Name *</label><br>
              <input placeholder="Enter Level Name" type="text" class="form-control w-50"
                value="<?php echo $rowEdit['name'] ?? '' ?>" readonly>
              <input type="hidden" name="level_id" value="<?php echo $rowEdit['id'] ?? '' ?>">
            </div>
            <div class="mb-3">
              <?php foreach ($rowMenus as $menu): ?>
              <label for="">
                <input type="checkbox" name="menu_id[]" value="<?php echo $menu['id'] ?>"
                  <?php echo in_array($menu['id'], $selectMenuIds) ? 'checked' : '' ?>><?php echo $menu['name'] ?>
              </label><br>
              <?php endforeach?>
            </div>
            <button type="submit" class="btn btn-primary" name="save">Save Change</button>
            <a href="?page=level" class="btn btn-warning">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>