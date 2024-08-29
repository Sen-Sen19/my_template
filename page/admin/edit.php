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
            <h3 class="card-title">  <img src="../../dist/img/edit.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Edit Data</h3>
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




<!-- Modal for editing data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="form-group">
            <label for="editEmployeeNo">Employee No</label>
            <input type="text" class="form-control" id="editEmployeeNo" name="EmployeeNo" >
          </div>
          <div class="form-group">
            <label for="editUsername">Username</label>
            <input type="text" class="form-control" id="editUsername" name="Username">
          </div>
          <div class="form-group">
            <label for="editFullName">Full Name</label>
            <input type="text" class="form-control" id="editFullName" name="FullName">
          </div>
          <div class="form-group">
            <label for="editSection">Section</label>
            <input type="text" class="form-control" id="editSection" name="Section">
          </div>
          <div class="form-group">
            <label for="editUserType">User Type</label>
            <input type="text" class="form-control" id="editUserType" name="UserType">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
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
        tr.addEventListener('click', () => {
          document.getElementById('editEmployeeNo').value = row.EmployeeNo;
          document.getElementById('editUsername').value = row.Username;
          document.getElementById('editFullName').value = row.FullName;
          document.getElementById('editSection').value = row.Section;
          document.getElementById('editUserType').value = row.UserType;
          $('#editModal').modal('show');
        });
        tbody.appendChild(tr);
      });
    })
    .catch(error => console.error('Error fetching data:', error));

    
    
    
    document.getElementById('saveChanges').addEventListener('click', () => {
  const editForm = document.getElementById('editForm');
  const formData = new FormData(editForm);

  fetch('../../process/edit_data.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      $('#editModal').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data saved successfully!',
        showConfirmButton: false,
        timer: 1500
      });

      
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
            tr.addEventListener('click', () => {
              document.getElementById('editEmployeeNo').value = row.EmployeeNo;
              document.getElementById('editUsername').value = row.Username;
              document.getElementById('editFullName').value = row.FullName;
              document.getElementById('editSection').value = row.Section;
              document.getElementById('editUserType').value = row.UserType;
              $('#editModal').modal('show');
            });
            tbody.appendChild(tr);
          });
        })
        .catch(error => console.error('Error fetching data:', error));
    } else {
      console.error('Error updating data:', result.error);
    }
  })
  .catch(error => console.error('Error saving changes:', error));
});


</script>

<?php include 'plugins/footer.php'; ?>
