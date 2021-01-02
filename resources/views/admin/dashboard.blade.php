@extends('layouts.admin')

@section('title', 'Home Admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-tachometer"></i>
        Home Admin
    </div>


     <div class="card-body form-inline">
       <div style="width: 700px;height: 370px">
   		<canvas id="myChart"></canvas>
   	</div>
               <div class="col-xl-5 col-md-3 mb-4">
                           <div class="card border-left-primary shadow h-75 py-1">
                             <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                   <div class="h5 mb-0 font-weight-bold text-primary text-uppercase mb-1">Total Penjualan Tahun <?php echo $tahun->tahun; ?></div>
                                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalthn; ?></div>
                                 </div>
                                 <div class="col-auto">
                                   <i class="fas fa-calendar fa-1x text-gray-300"></i>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>


                         <div class="col-xl-5 col-md-3 mb-4">
                                     <div class="card border-left-primary shadow h-75 py-1">
                                       <div class="card-body">
                                         <div class="row no-gutters align-items-center">
                                           <div class="col mr-2">
                                             <div class="h5 mb-0 font-weight-bold text-primary text-uppercase mb-1">Total Penjualan Keseluruhan</div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                                           </div>
                                           <div class="col-auto">
                                             <i class="fas fa-th-list fa-1x text-gray-300"></i>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>



     </div>
</div>
@endsection

@section('scripts')

<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"],
      datasets: [{
        label: 'Penjualan Tahun <?php echo $tahun->tahun; ?>',
        data: [<?php echo $penjualan[0]; ?>, <?php echo $penjualan[1]; ?>, <?php echo $penjualan[2]; ?>,
        <?php echo $penjualan[3]; ?>, <?php echo $penjualan[4]; ?>, <?php echo $penjualan[5]; ?>,
        <?php echo $penjualan[6]; ?>, <?php echo $penjualan[7]; ?>, <?php echo $penjualan[8]; ?>,
        <?php echo $penjualan[9]; ?>, <?php echo $penjualan[10]; ?>, <?php echo $penjualan[11]; ?>],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(25, 91, 45, 0.2)',
        'rgba(103, 159, 192, 0.2)',
        'rgba(30, 56, 108, 0.2)',
        'rgba(194, 87, 122, 0.2)',
        'rgba(89, 12, 45, 0.2)',
        'rgba(201, 45, 67, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(25, 91, 45, 1)',
        'rgba(103, 159, 192, 1)',
        'rgba(30, 56, 108, 1)',
        'rgba(194, 87, 122, 1)',
        'rgba(89, 12, 45, 1)',
        'rgba(201, 45, 67, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>

@endsection
