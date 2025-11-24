<?php

$q_levels = mysqli_query($config, "SELECT * FROM levels");
$levels = mysqli_fetch_all($q_levels, MYSQLI_ASSOC);
// var_dump($levels)

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $q_delete = mysqli_query($config, "DELETE FROM levels WHERE id='$id'");
  header("location:?page=level");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Level</title>
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Level</h3>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-end m-2">
            <a href="?page=tambah-level" class="btn btn-primary"> Add Levels</a>
          </div>
          <table class="table table-bordered">
            <tr>
              <th>No</th>
              <th>Level</th>
              <th>Actions</th>
            </tr>
            <?php
            foreach ($levels as $key => $level) {
            ?>
              <tr>
                <td>
                  <?Php echo $key + 1 ?>
                </td>
                <td>
                  <?Php echo $level['name'] ?>
                </td>
                <td>
                  <a href="?page=tambah-level&edit=<?php echo $level['id'] ?>" class="btn btn-success">
                    <i class="bi bi-pencil"></i></a>
                  <form class="d-inline" action="?page=level&delete=<?php echo $level['id'] ?>" method="post"
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