<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>
<style>
  .icon {
    width: 20px; /* Adjust the size as needed */
    height: 20px; /* Adjust the size as needed */
    cursor: pointer; /* Change the cursor to a pointer */
}

</style>
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
              <div class="col-sm-3">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-primary" id="addReqBtn" data-toggle="modal" data-target="#addModal">
  <i class="fas fa-plus mr-2"></i>Add
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
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Delete</th> 
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




<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add New Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addForm">
          <div class="form-group">
            <label for="addUsername">Username</label>
            <input type="text" class="form-control" id="addUsername" name="username" required>
          </div>
          <div class="form-group">
            <label for="addPassword">Password</label>
            <input type="text" class="form-control" id="addPassword" name="password" required>
          </div>
          <div class="form-group">
            <label for="addRole">Role</label>
            <select class="form-control" id="addRole" name="role" required>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveAddChanges">Add Account</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Account Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="form-group">
            <label for="editUsername">Username</label>
            <input type="text" class="form-control" id="editUsername" name="username">
          </div>
          <div class="form-group">
            <label for="editPassword">Password</label>
            <input type="text" class="form-control" id="editPassword" name="password">
          </div>
          <div class="form-group">
            <label for="editRole">Role</label>
            <select class="form-control" id="editRole" name="role">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
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

fetch('../../process/account_view.php')
  .then(response => response.json())
  .then(data => {
    const tbody = document.getElementById('employeeTableBody');
    tbody.innerHTML = '';
    data.forEach(row => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
      <td>${row.username}</td>
    <td>${row.password}</td>
    <td>${row.role}</td>
    <td>
        <img src="../../dist/img/delete.png" alt="Delete" class="delete-icon icon" data-username="${row.username}">
    </td>
`;

    
      tr.addEventListener('click', () => {
        document.getElementById('editUsername').value = row.username;
        document.getElementById('editPassword').value = row.password;
        document.getElementById('editRole').value = row.role;
        $('#editModal').modal('show');
      });

     
      const deleteIcon = tr.querySelector('.delete-icon');
      deleteIcon.addEventListener('click', (e) => {
        e.stopPropagation(); 
        const username = e.target.getAttribute('data-username');
        Swal.fire({
          title: 'Are you sure?',
          text: `You are about to delete the account for ${username}.`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Delete',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            deleteAccount(username);
          }
        });
      });

      tbody.appendChild(tr);
    });
    addDeleteEventListeners(); 
  })
  .catch(error => console.error('Error fetching data:', error));


function addDeleteEventListeners() {
  const deleteIcons = document.querySelectorAll('.delete-icon');
  deleteIcons.forEach(icon => {
    icon.addEventListener('click', (e) => {
      const username = e.target.getAttribute('data-username');
      Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete the account for ${username}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          deleteAccount(username);
        }
      });
    });
  });
}


function deleteAccount(username) {
  fetch('../../process/account_delete.php', { 
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ username }) 
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'The account has been deleted.',
          showConfirmButton: false,
          timer: 1500
        });
        updateTable(); 
      } else {
        console.error('Error deleting account:', result.error);
      }
    })
    .catch(error => console.error('Error deleting account:', error));
}


document.getElementById('saveChanges').addEventListener('click', () => {
  const editForm = document.getElementById('editForm');
  const formData = new FormData(editForm);

  fetch('../../process/account_edit.php', {
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
        updateTable(); 
      } else {
        console.error('Error updating data:', result.error);
      }
    })
    .catch(error => console.error('Error saving changes:', error));
});


function updateTable() {
  fetch('../../process/account_view.php')
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('employeeTableBody');
      tbody.innerHTML = '';
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
              <td>${row.username}</td>
    <td>${row.password}</td>
    <td>${row.role}</td>
    <td>
        <img src="../../dist/img/delete.png" alt="Delete" class="delete-icon icon" data-username="${row.username}">
    </td>
        `;
       
        tr.addEventListener('click', () => {
          document.getElementById('editUsername').value = row.username;
          document.getElementById('editPassword').value = row.password;
          document.getElementById('editRole').value = row.role;
          $('#editModal').modal('show');
        });

      
        const deleteIcon = tr.querySelector('.delete-icon');
        deleteIcon.addEventListener('click', (e) => {
          e.stopPropagation(); 
          const username = e.target.getAttribute('data-username');
          Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete the account for ${username}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              deleteAccount(username);
            }
          });
        });

        tbody.appendChild(tr);
      });
      addDeleteEventListeners(); 
    })
    .catch(error => console.error('Error fetching data:', error));
}


document.getElementById('saveAddChanges').addEventListener('click', () => {
  const addForm = document.getElementById('addForm');
  const formData = new FormData(addForm);

  fetch('../../process/account_add.php', { 
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        $('#addModal').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Account added successfully!',
          showConfirmButton: false,
          timer: 1500
        });
        updateTable(); 
      } else {
        console.error('Error adding account:', result.error);
      }
    })
    .catch(error => console.error('Error adding account:', error));
});

</script>


<?php include 'plugins/footer.php'; ?>