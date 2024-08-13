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
            <h3 class="card-title">  <img src="../../dist/img/computation.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Computation</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
              </div>
            </div>




            <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif; 
        }
       
        .container {
            max-width: 500px; 
            border: 1px solid #dee2e6;
           
            padding: 30px; 
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            margin-bottom: 40px;
        }
        .form-control-file {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff; 
        }
        .btn-primary:hover {
            background-color: #0056b3; 
            border-color: #0056b3;
        }
    </style>

<body class="bg-light">
    <div class="container mt-5">
     
        <form action="../../process/comp_import.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
  
                <input type="file" class="form-control-file" name="csv_file" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Import</button>
        </form>
    </div>



      </body>

        </div>
        </div>
      </div>
    </div>
  </section>
</div>





<?php include 'plugins/footer.php'; ?>