<?php

$q_menus = mysqli_query($config, "SELECT * FROM menus ORDER BY `order` ASC");
$menus = mysqli_fetch_all($q_menus, MYSQLI_ASSOC);
// var_dump($menus)

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $q_delete = mysqli_query($config, "DELETE FROM menus WHERE id='$id'");
  header("location:?page=Menu");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Menu</h3>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-end m-2">
            <a href="?page=tambah-Menu" class="btn btn-primary"> Add Menu</a>
          </div>
          <table class="table table-bordered">
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Icon</th>
              <th>Link</th>
              <th>Order</th>
              <th>Actions</th>
            </tr>
            <?php
            foreach ($menus as $key => $Menu) {
            ?>
              <tr>
                <td>
                  <?Php echo $key + 1 ?>
                </td>
                <td>
                  <?Php echo $Menu['name'] ?>
                </td>
                <td>
                  <?Php echo $Menu['icon'] ?>
                </td>
                <td>
                  <?Php echo $Menu['link'] ?>
                </td>
                <td>
                  <?Php echo $Menu['order'] ?>
                </td>
                <td>
                  <a href="?page=tambah-Menu&edit=<?php echo $Menu['id'] ?>" class="btn btn-success">
                    <i class="bi bi-pencil"></i></a>
                  <form class="d-inline" action="?page=Menu&delete=<?php echo $Menu['id'] ?>" method="post"
                    onclick="return confirm('Apakah ingin di hapus??')">
                    <button type="submit" class="btn btn-danger">
                      <i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
            <?php
            }
            ?>
          </table>
        </div>
      </div>
    </div>

</body>

</html>