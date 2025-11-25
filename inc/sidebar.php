<?php
$level_id = $_SESSION['LEVEL_ID'] ?? '';

$queryLevelMenu = mysqli_query($config, "SELECT * FROM menus JOIN level_menus ON menus.id = level_menus.menu_id WHERE level_id ='$level_id' ORDER BY menus.id DESC");
$rowLevelMenus = mysqli_fetch_all($queryLevelMenu, MYSQLI_ASSOC)
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <?php foreach ($rowLevelMenus as $rowLevelMenu): ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo $rowLevelMenu['link'] ?>">
          <i class="<?php echo $rowLevelMenu['icon'] ?>"></i>
          <span><?php echo $rowLevelMenu['name'] ?></span>
        </a>
      </li><!-- End Dashboard Nav -->
    <?php endforeach ?>

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="?page=user">
            <i class="bi bi-circle"></i><span>User</span>
          </a>
        </li>
        <li>
          <a href="?page=level">
            <i class="bi bi-circle"></i><span>Level</span>
          </a>
        </li>
        <li>
          <a href="?page=customer">
            <i class="bi bi-circle"></i><span>Customer</span>
          </a>
        </li>
        <li>
          <a href="?page=service">
            <i class="bi bi-circle"></i><span>Service</span>
          </a>
        </li>
        <li>
          <a href="?page=menu">
            <i class="bi bi-circle"></i><span>Menu</span>
          </a>
        </li>
      </ul>
    </li>End Components Nav -->

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Transection</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="?page=pos">
            <i class="bi bi-circle"></i><span>POS</span>
          </a>
        </li>
        <li>
          <a href="forms-layouts.html">
            <i class="bi bi-circle"></i><span>Form Layouts</span>
          </a>
        </li>
        <li>
          <a href="forms-editors.html">
            <i class="bi bi-circle"></i><span>Form Editors</span>
          </a>
        </li>
        <li>
          <a href="forms-validation.html">
            <i class="bi bi-circle"></i><span>Form Validation</span>
          </a>
        </li>
      </ul>
    </li> -->

  </ul>
  <!-- End Forms Nav -->


  </ul>

</aside>