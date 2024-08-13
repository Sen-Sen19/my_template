<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<style>
  .card-shadow {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
          <div class="card card-gray-dark card-outline card-shadow">
            <div class="card-header">
              <h3 class="card-title">
                <img src="../../dist/img/chart.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;"> Chart
              </h3>

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
                <div class="col-sm-6">
                  <label for="yearSelect">Select Year:</label>
                  <select id="yearSelect" class="form-control">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
                </div>
              </div>

              <div id="chartCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div id="chart1"></div>
                  </div>
                  <div class="carousel-item">
                    <div id="chart2"></div>
                  </div>
                  <div class="carousel-item">
                    <div id="chart3"></div>
                  </div>
              
                </div>
                <a class="carousel-control-prev" href="#chartCarousel" role="button" data-slide="prev" >
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only" >Previous</span>
                </a>
                <a class="carousel-control-next" href="#chartCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'plugins/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const yearSelect = document.getElementById('yearSelect');
    let charts = [];

    yearSelect.addEventListener('change', function() {
        updateCharts(yearSelect.value);
    });

    updateCharts(yearSelect.value);

    function updateCharts(year) {
        fetch(`../../process/chart.php?year=${year}`)
            .then(response => response.json())
            .then(data => {
                const chartTypes = ['area', 'line', 'bar']; // Example chart types
                chartTypes.forEach((chartType, index) => {
                    const options = {
                        series: [{
                            name: 'Rate',
                            data: data.rates
                        }],
                        chart: {
                            type: chartType,
                            height: 450
                        },
                        title: {
                            text: 'Monthly Performance'
                        },
                        xaxis: {
                            categories: data.months
                        },
                        colors: ['#3adcf5']
                    };

                    if (charts[index]) {
                        charts[index].destroy();
                    }

                    charts[index] = new ApexCharts(document.querySelector(`#chart${index + 1}`), options);
                    charts[index].render();
                });
            });
    }
});
</script>

<!-- Include ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

