<?php
$query = mysqli_query($config, "SELECT * FROM taxs ORDER BY id DESC");
$taxs = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $delete = mysqli_query($config, "DELETE FROM taxs WHERE id = $id");
  if ($delete) {
    header("location:?page=tax");
  }
}

?>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Data Tax</h3>
          <div class="d-flex justify-content-end mb-3 mt-2">
            <a class="btn btn-primary" href="?page=tambah-tax"><i class="bi bi-plus-circle"></i> Add Tax</a>
          </div>
          <table class="table table-bordered">
            <tr class="text-center">
              <th>No</th>
              <th>Percent</th>
              <th>Is Active</th>
              <th>Action</th>
            </tr>
            <?php foreach ($taxs as $key => $v) {
            ?>
              <tr>
                <td class="text-center"><?php echo $key + 1 ?></td>
                <td><?php echo $v['percent'] ?></td>
                <td><?php echo $v['is_active'] == 1 ? 'Active' : 'Draft' ?></td>
                <td class="text-center">
                  <a href="?page=tambah-tax&edit=<?php echo $v['id'] ?>" class="btn btn-success btn-sm"><i
                      class="bi bi-pencil"></i></a>
                  <a href="?page=tax&delete=<?php echo $v['id'] ?>"
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