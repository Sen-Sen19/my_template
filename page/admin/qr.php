<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>
<script src="plugins/js/qrcode.min.js"></script>

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

<!-- Modal Structure -->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex">
        <div id="qrCode" class="mr-3"></div>
        <div id="employeeDetails"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="downloadQRCode">Download QR</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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
            showModalWithQRCode(row);
          });
          tbody.appendChild(tr);
        });
      })
      .catch(error => console.error('Error fetching data:', error));
  });

  function showModalWithQRCode(employee) {

    const qrCodeElement = document.getElementById('qrCode');
    qrCodeElement.innerHTML = '';
    const qrCode = new QRCode(qrCodeElement, {
      text: employee.EmployeeNo,
      width: 128,
      height: 128
    });


    const employeeDetails = document.getElementById('employeeDetails');
    employeeDetails.innerHTML = `
      <p><strong>Employee No:</strong> ${employee.EmployeeNo}</p>
      <p><strong>Username:</strong> ${employee.Username}</p>
      <p><strong>Full Name:</strong> ${employee.FullName}</p>
      <p><strong>Section:</strong> ${employee.Section}</p>
      <p><strong>User Type:</strong> ${employee.UserType}</p>
    `;

   
    $('#qrModal').modal('show');

    document.getElementById('downloadQRCode').onclick = function() {
      const qrCanvas = qrCodeElement.querySelector('canvas');
      const link = document.createElement('a');
      link.href = qrCanvas.toDataURL('image/png');
      link.download = `QRCode_${employee.EmployeeNo}.png`;
      link.click();
    };
  }
</script>

<?php include 'plugins/footer.php'; ?>
