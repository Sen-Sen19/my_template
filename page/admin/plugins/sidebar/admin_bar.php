<style>
.custom-sidebar {
  background-color: white;
  border-right: 2px solid #5edaea;
}

.custom-sidebar .nav-link {
  color: black;
  display: flex;
  align-items: center; 
  padding: 10px; 
}

.custom-sidebar .nav-link.active {
  background-color: #5edaea;
  color: black;
}

.custom-sidebar .nav-link.active p {
  color: white; 
}

.custom-sidebar .nav-icon {
  color: black;
  margin-right: 10px; 
}

.custom-sidebar .nav-link p {
  margin: 0; 
  line-height: 1.5;
}

.custom-sidebar .sidebar-dark-primary {
  background-color: white !important;
}

.custom-sidebar .nav-icon {
  filter: brightness(0); 
}

.custom-sidebar .nav-link.active .nav-icon {
  filter: brightness(1) invert(1); 
}
.badge-danger {
  background-color: red;
  color: white;
  font-size: 12px;
  margin-left: 10px;
  padding: 3px 7px;
  border-radius: 50%;
}


</style>


<aside class="main-sidebar custom-sidebar">
  <a href="dashboard.php" class="brand-link">
    <span class="brand-text font-weight-light">&ensp;WEB &ensp;|&ensp; Admin</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/p_user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
      <a href="view.php" class="d-block"><?=htmlspecialchars(strtoupper($_SESSION['username']));?></a>

      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
                  <a href="account.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/account.php") ? 'active' : ''; ?>">
                  <img src="../../dist/img/account.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
                  <p>Account Management</p>
                </a>
              </li>

              <li class="nav-item">
  <a href="view.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/view.php") ? 'active' : ''; ?>">
    <img src="../../dist/img/view.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
    <p>View Data 
      <!-- <span id="dataCountBadge" class="badge badge-danger"></span> -------badge notif -----------  -->
    </p>
  </a>
</li>

              <li class="nav-item">
                  <a href="edit.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/edit.php") ? 'active' : ''; ?>">
                  <img src="../../dist/img/edit.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
                  <p>Edit</p>
                </a>
              </li>

      <li class="nav-item">      
  <a href="pagination.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/pagination.php") ? 'active' : ''; ?>">      
    <img src="../../dist/img/pagination.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
    <p>Pagination</p>
  </a>  
</li>  




        <li class="nav-item">
          <a href="key_search.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/key_search.php") ? 'active' : ''; ?>">
          <img src="../../dist/img/search.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Search Key</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="load_more.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/load_more.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/load.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Load More</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="table_switching.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/table_switching.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/switch.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Table Switching</p>
        </a>
      </li>
      
      
      <li class="nav-item">
        <a href="checkbox.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/checkbox.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/checkbox.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Checkbox</p>
        </a>
      </li>
      
      


      <li class="nav-item">
        <a href="import.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/import.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/import.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Import</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="export.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/export.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/export.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Export</p>
        </a>
      </li>

      
      <li class="nav-item">
        <a href="qr.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/qr.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/qr.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>QR Code</p>
        </a>
      </li>

  
      <li class="nav-item">
        <a href="chart.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/chart.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/chart.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Chart</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="computation.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/computation.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/computation.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Computation</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="slide.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/slide.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/slide.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Slide</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="modal.php" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == "/my_template/page/admin/modal.php") ? 'active' : ''; ?>">
        <img src="../../dist/img/modal.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
          <p>Modal</p>
        </a>
      </li>

    

        <li class="nav-item">
  <a href="#" class="nav-link" data-toggle="modal" data-target="#logout_modal">
  <img src="../../dist/img/logout.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
    <p class="text" style="color:red;">Logout</p>
  </a>
</li>
      </ul>
    </nav>
  </div>
</aside>
