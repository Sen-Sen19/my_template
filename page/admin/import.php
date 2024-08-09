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
            <h3 class="card-title">  <img src="../../dist/img/import.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Import</h3>
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
                  <button class="btn btn-block btn-primary" id="addReqBtn" data-toggle="modal" data-target="#addModal">
  <!-- <i class="fas fa-plus mr-2"></i> -->
  Import
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
<!-- Import Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Import CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="importForm" enctype="multipart/form-data">
          <div class="form-group">
            <label for="csvFile">Choose CSV file</label>
            <input type="file" class="form-control-file" id="csvFile" name="csvFile" accept=".csv" required>
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
// Function to fetch and display employee data
function fetchEmployeeData() {
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
}

// Fetch employee data on page load
document.addEventListener('DOMContentLoaded', fetchEmployeeData);

// Event listener for import form submission
document.getElementById('importForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission

  const formData = new FormData(this); // Create a FormData object

  fetch('../../process/import.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        Swal.fire({
          title: 'Success!',
          text: 'File imported successfully!',
          icon: 'success',
          confirmButtonText: 'OK'
        });
        // Refresh the employee data displayed in the table
        fetchEmployeeData();
        // Optionally hide the modal after successful upload
        $('#addModal').modal('hide');
      } else {
        Swal.fire({
          title: 'Error!',
          text: 'Error importing file: ' + data.message,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    })
    .catch(error => {
      console.error('Error uploading file:', error);
      Swal.fire({
        title: 'Error!',
        text: 'An error occurred while uploading the file.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    });
});
</script>



<?php include 'plugins/footer.php'; ?>