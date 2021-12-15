<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Google Font: Source Sans Pro -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
          <!-- Font Awesome -->

          <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
          <!-- Ionicons -->
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Tempusdominus Bootstrap 4 -->
          <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
          <!-- iCheck -->
          <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
          <!-- JQVMap -->
          <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
          <!-- Theme style -->
          <link rel="stylesheet" href="{{ asset('plugins/adminlte.min.css') }}">
          <!-- overlayScrollbars -->
          <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
          <!-- Daterange picker -->
          <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
          <!-- summernote -->
          <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
          <!-- DataTables -->
          <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
          <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
          <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    </head>
    <body class="antialiased hold-transition sidebar-collapse">
        <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-8">
                  <!-- LINE CHART -->
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Grafik Prediksi Barang</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="col-4">
                  <!-- PIE CHART -->
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">Diagram Stock</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <div>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tabel Detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah Hari Ini</th>
                        <th>Perkiranan Jumlah Besok</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($table as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <?=$value['item_id'];?>
                                </td>
                                <td>
                                    <?=$value['current_stock'];?>
                                </td>
                                <td>
                                    <?=$value['predicted_stock'];?>
                                </td>
                                <td>
                                    <?php
                                    if ($value['status'] != "normal") {
                                        ?>
                                        <p class="text-danger"><?=$value['status'];?></p>
                                        <?php
                                    } else {
                                        ?>
                                        <p><?=$value['status'];?></p>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
          </section>
          <!-- /.content -->
        </div>
      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- ChartJS -->
      <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('plugins/adminlte.min.js') }}"></script>

      <script>
        $(function () {
          //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $('#lineChart').get(0).getContext('2d')

          var lineChartData = {
            labels  : <?=json_encode(array_keys($line['date']));?>,
            datasets: [
            {
              label               : <?=json_encode(array_keys($line["item_1"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(60,141,188, 0)',
              pointRadius          : true,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : <?=json_encode($line['item_1']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_2"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(29, 105, 49, 0)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_2']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_3"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(28, 31, 105, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#9234b9',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_3']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_4"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(85, 16, 115, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#32843a',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_4']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_5"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(107, 64, 15, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c83a96',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_5']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_6"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(70, 74, 18, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#937e82',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_6']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_7"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(75, 150, 17, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#d928c8',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_7']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_8"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(15, 94, 49, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#aeae45',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_8']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_9"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(15, 91, 92, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#1093bc',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_9']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_10"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(10, 33, 59, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#128337',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_10']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_11"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(23, 14, 117, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#00347f',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_11']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_12"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(135, 14, 60, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#284810',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_12']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_13"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(166, 15, 27, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#aaa938',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_13']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_14"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(209, 94, 27, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#843aa8',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_14']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_15"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(81, 191, 34, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#d98ae9',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_15']);?>
            },
            {
              label               : <?=json_encode(array_keys($line["item_16"]));?>,
              backgroundColor     : 'rgba(210, 214, 222, 0)',
              borderColor         : 'rgba(217, 59, 198, 1)',
              pointRadius         : true,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#39429a',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : <?=json_encode($line['item_16']);?>
            },
            ]
          }

          var lineChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                }
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                }
              }]
            }
          }

          lineChartData.datasets[0].fill = false;
          lineChartData.datasets[1].fill = false;
          lineChartOptions.datasetFill = false

          var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
          })

          //-------------
          //- PIE CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
          var pieData        = {
            labels: [
                'UnderStocking',
                'Normal',
                'Overstocking'
            ],
            datasets: [
              {
                data: [<?= $pie['understock'];?>,<?= $pie['normal'];?>,<?= $pie['overstock'];?>],
                backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
              }
            ]
          }
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
          })

          $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })
      </script>
    </body>
</html>
