<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Display</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="view.php">Home</a></li>
            <li class="breadcrumb-item active" id="mainTableBreadcrumb">Display</li>
            <li class="breadcrumb-item" id="detailTableBreadcrumb" style="display: none;">
              <a href="#" id="backToMainTable" style="color: #007bff;">Return</a> / 
              <span id="employeeFullName" style="color: #6e6f75;"></span>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-gray-dark card-outline">
            <div class="card-header">
            <h3 class="card-title">  <img src="../../dist/img/switch.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Table Switching</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12 col-md-9 col-9">
                  <div class="dataTables_info" id="accounts_table_info" role="status" aria-live="polite"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-bordered table-hover" id="mainTable">
                    <thead>
                      <tr>
                        <th>Employee No</th>
                        <th>Username</th>
                        <th>Full Name</th>
                      </tr>
                    </thead>
                    <tbody id="employeeTableBody"></tbody>
                  </table>
                  <table class="table table-bordered table-hover" id="detailTable" style="display: none;">
                    <thead>
                      <tr>
                        <th>Section</th>
                        <th>User Type</th>
                      </tr>
                    </thead>
                    <tbody id="detailTableBody"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  fetch('../../process/view_data.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('employeeTableBody');
      tbody.innerHTML = '';
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = 
          `<td>${row.EmployeeNo}</td>
          <td>${row.Username}</td>
          <td>${row.FullName}</td>`;
        
        tr.addEventListener('click', () => {
          showDetailTable(row);
        });

        tbody.appendChild(tr);
      });
    })
    .catch(error => console.error('Error fetching data:', error));

  function showDetailTable(row) {
    const mainTable = document.getElementById('mainTable');
    const detailTable = document.getElementById('detailTable');
    const detailTableBody = document.getElementById('detailTableBody');
    const mainTableBreadcrumb = document.getElementById('mainTableBreadcrumb');
    const detailTableBreadcrumb = document.getElementById('detailTableBreadcrumb');
    const employeeFullName = document.getElementById('employeeFullName');

    mainTable.style.display = 'none';
    detailTable.style.display = 'table';
    mainTableBreadcrumb.style.display = 'none';
    detailTableBreadcrumb.style.display = 'inline';

    employeeFullName.textContent = row.FullName;

    detailTableBody.innerHTML = 
      `<tr>
        <td>${row.Section}</td>
        <td>${row.UserType}</td>
      </tr>`;
  }

  document.getElementById('backToMainTable').addEventListener('click', () => {
    const mainTable = document.getElementById('mainTable');
    const detailTable = document.getElementById('detailTable');
    const mainTableBreadcrumb = document.getElementById('mainTableBreadcrumb');
    const detailTableBreadcrumb = document.getElementById('detailTableBreadcrumb');

    mainTable.style.display = 'table';
    detailTable.style.display = 'none';
    mainTableBreadcrumb.style.display = 'inline';
    detailTableBreadcrumb.style.display = 'none';
  });
</script>

<?php include 'plugins/footer.php'; ?>
