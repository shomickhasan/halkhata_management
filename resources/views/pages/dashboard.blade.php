@extends('templete.master')
<!---section for dainamic title----->
@section('dinamic-title','Dashboard')
@section('main-content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->
  @php

    $totalCustomer =App\Models\Customer::where('privious_total_due', '>', 0)->count();
    $totalDue =App\Models\Customer::sum('privious_total_due');
    $totalAttend = App\Models\Customer::where('status',1)->count();
    $totalPayment =App\Models\Customer::sum('payment');


  @endphp

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalPayment}}৳</h3>

              <p>মোট হালখাতা</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$totalDue}}৳</sup></h3>

              <p>মোট বাকি</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$totalAttend}}</h3>

              <p>মোট অংশগ্রহণ</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$totalCustomer}} জন</h3>

              <p>মোট কাস্টমার</p>
            </div>
            <div class="icon">
              <i class="ion ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">উপস্থিতি শতকরা</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: block;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="attendanceChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;" width="487" height="250" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var  totalCustomers = @json($totalCustomer);
        var attendedCustomers = @json( $totalAttend);
        var unattendedCustomers = totalCustomers - attendedCustomers;

        var attendedPercentage = Math.round((attendedCustomers / totalCustomers) * 100);
        var unattendedPercentage = Math.round((unattendedCustomers / totalCustomers) * 100);

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Attended', 'Unattended'],
                datasets: [{
                    data: [attendedPercentage, unattendedPercentage],
                    backgroundColor: ['#FFC107', '#DC3545']
                }]
            },
            tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var currentValue = dataset.data[tooltipItem.index];
                            var label = data.labels[tooltipItem.index];
                            return label + ': ' + currentValue + '% (' + currentValue * totalCustomers / 100 + ' customers)';
                        }
                    }
                }
        });
    });
</script>


@endpush

