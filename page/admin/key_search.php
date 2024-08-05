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
              <h3 class="card-title"><i class="fas fa-file-alt"></i> Display Data</h3>
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
            <div class="row mb-4">
  <div class="col-sm-3">
    <label>Employee No:</label>
    <input type="text" id="employee_no_search" class="form-control" autocomplete="off">
  </div>
  <div class="col-sm-3">
    <label>Full Name:</label>
    <input type="text" id="full_name_search" class="form-control" autocomplete="off">
  </div>
  <div class="col-sm-3">
    <label>User Type:</label>
    <select id="user_type_search" class="form-control">
      <option value="">Select User Type</option>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>
  </div>


                <div class="col-sm-3">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-primary" id="searchReqBtn" onclick="search_accounts(1, 0)">
  <i class="fas fa-search mr-2"></i>Search
</button>
</div>
                </div>
              </div>
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
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('employee_no_search').addEventListener('input', () => search_accounts(1, 0));
    document.getElementById('full_name_search').addEventListener('input', () => search_accounts(1, 0));
    document.getElementById('user_type_search').addEventListener('change', () => search_accounts(1, 0));

    // Trigger initial search to display all data on load
    search_accounts(1, 0);
  });

  function search_accounts(page, offset) {
    const employeeNo = document.getElementById('employee_no_search').value;
    const fullName = document.getElementById('full_name_search').value;
    const userType = document.getElementById('user_type_search').value;

    const params = new URLSearchParams({
      employee_no: employeeNo,
      full_name: fullName,
      user_type: userType,
      page: page,
      offset: offset
    });

    fetch('../../process/search_data.php?' + params.toString())
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
  }
</script>




<?php include 'plugins/footer.php'; ?>