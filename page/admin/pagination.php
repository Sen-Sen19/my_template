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
            <h3 class="card-title">  <img src="../../dist/img/pagination.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Pagination</h3>
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
              <div class="row">
                <div class="col-sm-12">
                  <nav>
                    <ul class="pagination justify-content-end" id="pagination">
                    </ul>
                  </nav>
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
  const rowsPerPage = 10;
  let currentPage = 1;
  let data = [];

  function renderTable(data, page = 1) {
    const tbody = document.getElementById('employeeTableBody');
    tbody.innerHTML = '';
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedItems = data.slice(start, end);

    paginatedItems.forEach(row => {
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
  }

  function renderPagination(totalRows, currentPage) {
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const prevLi = document.createElement('li');
    prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevLi.innerHTML = `<a class="page-link" href="#">&#x2190;</a>`;
    prevLi.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        renderTable(data, currentPage);
        renderPagination(data.length, currentPage);
      }
    });
    pagination.appendChild(prevLi);

    const currentPageLi = document.createElement('li');
    currentPageLi.className = 'page-item active';
    currentPageLi.innerHTML = `<a class="page-link" href="#">${currentPage}</a>`;
    pagination.appendChild(currentPageLi);

    const nextLi = document.createElement('li');
    nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
    nextLi.innerHTML = `<a class="page-link" href="#">&#x2192;</a>`;
    nextLi.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        renderTable(data, currentPage);
        renderPagination(data.length, currentPage);
      }
    });
    pagination.appendChild(nextLi);
  }

  fetch('../../process/view_data.php')
    .then(response => response.json())
    .then(fetchedData => {
      data = fetchedData;
      renderTable(data, currentPage);
      renderPagination(data.length, currentPage);
    })
    .catch(error => console.error('Error fetching data:', error));
</script>

<?php include 'plugins/footer.php'; ?>
