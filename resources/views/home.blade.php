@extends('layouts.app')
@section('content')
	<div class="content-wrapper pb-5 pt-3">
		<section class="content pb-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="row">
							<div class="col-md-6 col-sm-4 col-12">
								<div class="info-box bg-info-gradient">
									<span class="info-box-icon"><i class="fa fa-money"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Salary</span>
										<span class="info-box-number">{{ $salary ?? 0 }}</span>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-4 col-12">
								<div class="info-box bg-secondary-gradient">
									<span class="info-box-icon"><i class="fa fa-user-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Staff</span>
										<span class="info-box-number">{{ $staff ?? 0 }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="col-md-5 col-sm-12 col-12 mb-3 float-left">
							<div class="text-center">Jumlah Staff berdasarkan Job Grade</div>
							<canvas id="BarChartStaffJobGrade" width="200" height="200"></canvas>
						</div>
						<div class="col-md-5 col-sm-12 col-12 mb-3 float-right">
							<div class="text-center">Jumlah Staff berdasarkan Premium</div>
							<canvas id="BarChartStaffPremium" width="200" height="200"></canvas>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
	$('.alert').fadeOut(7000);
    var bar_staff_jobgrade = document.getElementById('BarChartStaffJobGrade').getContext('2d');
    var bar_staff_premium = document.getElementById('BarChartStaffPremium').getContext('2d');
    
    // Statistik Staff Job Grade

    var JobGrade = [];
    var CountJobGrade = [];
    $.get("{{ url('/home/getStaffJobGrade')}}", function(data){

        $.each(data, function(i,item){
            JobGrade.push(item.name_jobgrade);
            CountJobGrade.push(item.count);
        });

        var myChart = new Chart(bar_staff_jobgrade, 
        {
            type: 'bar',
            data: {
                labels: JobGrade,
                datasets: [{
                    label: 'Jumlah Staff',
                    data: CountJobGrade,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });

    // Statistik Staff Premium

    var Premium = [];
    var CountPremium = [];
    $.get("{{ url('/home/getStaffPremium')}}", function(data){
        $.each(data, function(i,item){
            Premium.push(item.name_premium);
            CountPremium.push(item.count);
        });
    
        var myChart = new Chart(bar_staff_premium, {

            type: 'bar',
            data: {
                labels: Premium,
                datasets: [{
                    label: 'Jumlah Staff',
                    data: CountPremium,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection