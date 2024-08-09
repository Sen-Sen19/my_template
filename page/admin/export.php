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
            <li class="breadcrumb-item active">Display</li>
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
          <h3 class="card-title">  <img src="../../dist/img/export.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Export</h3>

  <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse">
      <i class="fas fa-minus"></i>
    </button>
    <button type="button" class="btn btn-tool" data-card-widget="maximize">
      <i class="fas fa-expand"></i>
    </button>
  </div>
  <div class="col-sm-3">
  <label>&nbsp;</label>
  <form action="../../process/export.php" method="post" id="exportForm">
    <button type="submit" class="btn btn-primary btn-block btn-sm" id="exportReqBtn">
      <!-- <i class="fas fa-plus mr-2"></i> -->
      Export
    </button>
  </form>
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
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <th>Employee No</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Section</th>
                        <th>User Type</th>
                       
                      </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                    </tbody>
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
  // Fetch employee data and populate the table
  fetch('../../process/view_data.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('employeeTableBody');
      tbody.innerHTML = '';
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${row.EmployeeNo}</td>
          <td>${row.Username}</td>
          <td>${row.FullName}</td>
          <td>${row.Section}</td>
          <td>${row.UserType}</td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(error => console.error('Error fetching data:', error));

  // Event listener for the export button
  document.getElementById('exportReqBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission
    const exportForm = document.getElementById('exportForm');
    
    // Optionally, you can add any data manipulation here before submitting

    // Submit the form
    exportForm.submit();
  });
</script>




<?php include 'plugins/footer.php'; ?>