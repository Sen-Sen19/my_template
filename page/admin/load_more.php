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
            <h3 class="card-title">  <img src="../../dist/img/load.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">Load More</h3>
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


<script>
let offset = 0; 
const limit = 20; 
let loading = false;


function loadData() {
  if (loading) return; 
  loading = false;

  fetch(`../../process/load_more_data.php?offset=${offset}`)
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('employeeTableBody');

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

      if (data.length > 0) {
        offset += limit;
      } else {
        console.log('No more data to load.');
      }

      loading = false;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
      loading = false; 
    });
}


loadData(); 

window.addEventListener('scroll', () => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadData();
  }
});

</script>





<?php include 'plugins/footer.php'; ?>